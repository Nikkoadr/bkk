<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public static function configured(): bool
    {
        return is_string(config('midtrans.server_key')) && config('midtrans.server_key') !== '';
    }

    public static function boot(): void
    {
        Config::$serverKey = (string) config('midtrans.server_key');
        Config::$clientKey = (string) config('midtrans.client_key');
        Config::$isProduction = filter_var(config('midtrans.production_status'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public static function snapToken(string $orderId, int $grossAmount, array $customer = []): string
    {
        self::boot();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'customer_details' => $customer,
        ];

        return Snap::getSnapToken($params);
    }

    public static function validSignature(string $orderId, string $statusCode, string $grossAmount, string $signature): bool
    {
        $serverKey = (string) config('midtrans.server_key');
        $expected = hash('sha512', $orderId.$statusCode.$grossAmount.$serverKey);

        return hash_equals($expected, $signature);
    }
}
