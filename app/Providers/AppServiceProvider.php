<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }

        // Hanya admin dan operator BKK yang boleh membuka daftar peserta tes interview.
        Gate::define('akses-tes', function (User $user): bool {
            return (int) $user->id_role === 1
                || $user->email === 'operator_bkk@smkmuhkandanghaur.sch.id';
        });
    }
}
