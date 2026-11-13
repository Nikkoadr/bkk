<?php

namespace App\Http\Controllers;

use App\Models\PesertaTes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class TesController extends Controller
{
    /**
     * Kolom yang dipakai pada tabel, form, dan import.
     */
    private const FIELDS = [
        'no_tes',
        'nama_lengkap',
        'asal_sekolah',
        'email',
        'hari',
        'waktu',
        'perangkat',
        'link',
    ];

    /**
     * Kolom yang boleh dipakai untuk sorting.
     */
    private const SORTABLE = [
        'no_tes',
        'nama_lengkap',
        'asal_sekolah',
        'email',
        'hari',
        'waktu',
        'perangkat',
    ];

    /**
     * Alias header spreadsheet -> nama kolom database.
     */
    private const HEADER_ALIASES = [
        'no_tes' => 'no_tes',
        'notest' => 'no_tes',
        'nomor_tes' => 'no_tes',
        'no' => 'no_tes',
        'nama_lengkap' => 'nama_lengkap',
        'nama' => 'nama_lengkap',
        'name' => 'nama_lengkap',
        'asal_sekolah' => 'asal_sekolah',
        'asal' => 'asal_sekolah',
        'sekolah' => 'asal_sekolah',
        'school' => 'asal_sekolah',
        'email' => 'email',
        'e_mail' => 'email',
        'hari' => 'hari',
        'day' => 'hari',
        'waktu' => 'waktu',
        'jam' => 'waktu',
        'time' => 'waktu',
        'perangkat' => 'perangkat',
        'device' => 'perangkat',
        'komputer' => 'perangkat',
        'pc' => 'perangkat',
        'link' => 'link',
        'link_interview' => 'link',
        'url' => 'link',
        'interview' => 'link',
    ];

    /**
     * Halaman publik: daftar peserta tes + link interview.
     */
    public function index(Request $request): View
    {
        $peserta = $this->filtered($request)->paginate(25);

        return view('tes.index', [
            'peserta' => $peserta,
            'hariOptions' => $this->distinctValues('hari'),
            'waktuOptions' => $this->distinctValues('waktu'),
            'perangkatOptions' => $this->distinctValues('perangkat'),
        ]);
    }

    /**
     * Halaman admin: daftar peserta tes dengan filter dan CRUD.
     */
    public function adminIndex(Request $request): View
    {
        $peserta = $this->filtered($request)->paginate(25);

        return view('admin.tes', [
            'peserta' => $peserta,
            'hariOptions' => $this->distinctValues('hari'),
            'waktuOptions' => $this->distinctValues('waktu'),
            'perangkatOptions' => $this->distinctValues('perangkat'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        PesertaTes::create($this->validated($request));

        return redirect()->route('tes.admin')->with('success', 'Peserta tes berhasil ditambahkan.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $peserta = PesertaTes::findOrFail($id);
        $peserta->update($this->validated($request, $peserta->id));

        return redirect()->route('tes.admin')->with('success', 'Peserta tes berhasil diperbarui.');
    }

    public function destroy(int $id): RedirectResponse
    {
        PesertaTes::findOrFail($id)->delete();

        return redirect()->route('tes.admin')->with('success', 'Peserta tes berhasil dihapus.');
    }

    /**
     * Hapus beberapa peserta tes sekaligus dari checkbox tabel.
     */
    public function bulkDestroy(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'distinct', 'exists:peserta_tes,id'],
        ]);

        $deleted = PesertaTes::whereIn('id', $validated['ids'])->delete();

        return redirect()->route('tes.admin')->with('success', $deleted.' peserta tes berhasil dihapus.');
    }

    /**
     * Import peserta tes dari file Excel/CSV dengan urutan kolom seperti tabel:
     * no_tes, nama_lengkap, asal_sekolah, email, hari, waktu, perangkat, link.
     */
    public function import(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv,txt', 'max:10240'],
        ]);

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());
        $path = $file->getRealPath();

        try {
            if (in_array($extension, ['csv', 'txt'], true)) {
                $reader = new Csv;
                $reader->setInputEncoding('UTF-8');
                $reader->setDelimiter(',');
            } else {
                $reader = IOFactory::createReaderForFile($path);
            }

            $reader->setReadDataOnly(true);
            $rows = $reader->load($path)->getActiveSheet()->toArray(null, true, false, false);
        } catch (\Throwable $e) {
            report($e);

            return back()->with('error', 'File tidak dapat dibaca. Pastikan format Excel/CSV sesuai.');
        }

        if (count($rows) > 5001) {
            return back()->with('error', 'Maksimal 5000 baris per import. Pecah file menjadi beberapa bagian.');
        }

        $columnMap = $this->headerMap($rows[0] ?? []);
        $startRow = $columnMap === null ? 0 : 1;
        if ($columnMap === null) {
            $columnMap = array_combine(range(0, count(self::FIELDS) - 1), self::FIELDS);
        }

        $records = [];
        $skipped = 0;

        foreach (array_slice($rows, $startRow) as $row) {
            $data = [];
            foreach (self::FIELDS as $field) {
                $index = array_search($field, $columnMap, true);
                $data[$field] = $this->cellValue($index === false ? null : ($row[$index] ?? null));
            }

            if (implode('', $data) === '') {
                continue;
            }

            if ($data['no_tes'] === '' || $data['nama_lengkap'] === '') {
                $skipped++;

                continue;
            }

            foreach (['asal_sekolah', 'email', 'hari', 'waktu', 'perangkat', 'link'] as $optional) {
                $data[$optional] = $data[$optional] === '' ? null : $data[$optional];
            }

            $records[$data['no_tes']] = $data;
        }

        if ($records === []) {
            return back()->with('error', 'Tidak ada baris valid yang bisa diimport. Periksa kembali isi file.');
        }

        $created = 0;
        $updated = 0;

        DB::transaction(function () use ($records, &$created, &$updated) {
            foreach ($records as $data) {
                $peserta = PesertaTes::updateOrCreate(['no_tes' => $data['no_tes']], $data);
                $peserta->wasRecentlyCreated ? $created++ : $updated++;
            }
        });

        $message = "Import selesai: {$created} baris ditambahkan, {$updated} baris diperbarui.";
        if ($skipped > 0) {
            $message .= " {$skipped} baris dilewati karena no tes/nama lengkap kosong.";
        }

        return redirect()->route('tes.admin')->with('success', $message);
    }

    /**
     * Query dengan seluruh filter operator.
     */
    private function filtered(Request $request)
    {
        $query = PesertaTes::query();

        foreach (['no_tes', 'nama_lengkap', 'asal_sekolah'] as $field) {
            if ($request->filled($field)) {
                $query->where($field, 'like', '%'.$request->input($field).'%');
            }
        }

        foreach (['hari', 'waktu', 'perangkat'] as $field) {
            if ($request->filled($field)) {
                $query->where($field, $request->input($field));
            }
        }

        $sort = $request->input('sort');
        $sort = in_array($sort, self::SORTABLE, true) ? $sort : 'no_tes';
        $direction = strtolower((string) $request->input('dir')) === 'desc' ? 'desc' : 'asc';

        return $query->orderBy($sort, $direction);
    }

    /**
     * Nilai unik untuk dropdown filter.
     */
    private function distinctValues(string $column): array
    {
        return PesertaTes::query()
            ->select($column)
            ->whereNotNull($column)
            ->where($column, '!=', '')
            ->distinct()
            ->orderBy($column)
            ->pluck($column)
            ->all();
    }

    /**
     * Validasi data form tambah/edit.
     */
    private function validated(Request $request, ?int $ignoreId = null): array
    {
        $unique = 'unique:peserta_tes,no_tes'.($ignoreId ? ','.$ignoreId : '');

        $validated = $request->validate([
            'no_tes' => ['required', 'string', 'max:50', $unique],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'asal_sekolah' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'hari' => ['nullable', 'string', 'max:50'],
            'waktu' => ['nullable', 'string', 'max:50'],
            'perangkat' => ['nullable', 'string', 'max:50'],
            'link' => ['nullable', 'url', 'max:2048'],
        ]);

        return array_map(
            fn ($value) => is_string($value) ? trim($value) : $value,
            $validated
        );
    }

    /**
     * Deteksi baris header dan petakan index kolom -> nama field.
     *
     * @return array<int, string>|null
     */
    private function headerMap(array $firstRow): ?array
    {
        $map = [];

        foreach ($firstRow as $index => $value) {
            $normalized = preg_replace('/[^a-z0-9]+/', '_', strtolower($this->cellValue($value)));
            $normalized = trim((string) $normalized, '_');

            if ($normalized !== '' && isset(self::HEADER_ALIASES[$normalized])) {
                $map[$index] = self::HEADER_ALIASES[$normalized];
            }
        }

        return count($map) >= 3 ? $map : null;
    }

    /**
     * Normalisasi nilai sel menjadi string tanpa spasi berlebih.
     */
    private function cellValue(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        if (is_float($value) && floor($value) === $value) {
            return (string) (int) $value;
        }

        $value = preg_replace('/^\x{FEFF}/u', '', (string) $value);

        return trim(preg_replace('/\s+/u', ' ', $value));
    }
}
