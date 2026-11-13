<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Peserta Tes Interview - BKK SMK Muhammadiyah Kandanghaur</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/dist/img/logoKotak_kecil.png') }}" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    * { font-family: 'Inter', sans-serif; }
    body { background: #f0f8ff; }
    .glass-nav { background: rgba(255,255,255,0.82); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
    .gradient-text { background: linear-gradient(135deg, #0a4b8a, #2b8cdf); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .input-custom:focus { border-color: #2b8cdf; box-shadow: 0 0 0 3px rgba(43, 140, 223, 0.15); outline: none; }
    .sky-shadow { box-shadow: 0 6px 24px rgba(11, 107, 203, 0.08); }
    .table-scroll { scrollbar-width: thin; }
    .table-scroll::-webkit-scrollbar { height: 8px; }
    .table-scroll::-webkit-scrollbar-thumb { background: #c5dcf5; border-radius: 999px; }
  </style>
</head>
<body class="min-h-screen flex flex-col">

  <nav class="glass-nav border-b border-[#dcebfa] sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16 md:h-20">
        <a href="/" class="flex items-center gap-2">
          <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="BKK Logo" class="h-11 md:h-13 w-auto object-contain" />
        </a>
        <div class="flex items-center gap-1 sm:gap-2">
          <a href="/" class="text-[#1a3f6a] hover:bg-[#e4f0fe] px-3 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition">
            <i class="fas fa-home mr-1"></i> Beranda
          </a>
          @auth
            <a href="{{ route('tes.admin') }}" class="bg-[#0b6bcb] text-white hover:bg-[#1a7fdf] px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition">
              <i class="fas fa-sliders mr-1"></i> Kelola
            </a>
          @else
            <a href="{{ route('login') }}" class="bg-[#0b6bcb] text-white hover:bg-[#1a7fdf] px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition">
              <i class="fas fa-sign-in-alt mr-1"></i> Login
            </a>
          @endauth
        </div>
      </div>
    </div>
  </nav>

  <main class="flex-1 max-w-7xl w-full mx-auto px-3 sm:px-6 lg:px-8 py-6 md:py-10">

    <div class="text-center mb-6 md:mb-8">
      <h1 class="text-xl sm:text-2xl md:text-3xl font-extrabold gradient-text tracking-tight">DAFTAR PESERTA TES INTERVIEW</h1>
      <div class="w-16 h-1 bg-gradient-to-r from-[#0b6bcb] to-[#5ba6f0] mx-auto mt-2 rounded-full"></div>
      <p class="text-sm text-[#4b6b8a] mt-3">Cari data peserta, lalu buka link interview sesuai jadwal yang tertera.</p>
    </div>

    <div class="bg-white rounded-2xl sky-shadow p-4 sm:p-5 mb-5">
      <form method="GET" action="{{ route('tes.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <div>
          <label for="no_tes" class="text-xs font-semibold text-[#4b6b8a] block mb-1">No Tes</label>
          <input type="text" id="no_tes" name="no_tes" value="{{ request('no_tes') }}" placeholder="Contoh: 0255"
                 class="input-custom w-full px-3 py-2 border border-[#d4e8fc] rounded-lg text-sm" />
        </div>
        <div>
          <label for="nama_lengkap" class="text-xs font-semibold text-[#4b6b8a] block mb-1">Nama Lengkap</label>
          <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ request('nama_lengkap') }}" placeholder="Cari nama peserta"
                 class="input-custom w-full px-3 py-2 border border-[#d4e8fc] rounded-lg text-sm" />
        </div>
        <div>
          <label for="asal_sekolah" class="text-xs font-semibold text-[#4b6b8a] block mb-1">Asal Sekolah</label>
          <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ request('asal_sekolah') }}" placeholder="Contoh: SMKN 1 GABUSWETAN"
                 class="input-custom w-full px-3 py-2 border border-[#d4e8fc] rounded-lg text-sm" />
        </div>
        <div>
          <label for="hari" class="text-xs font-semibold text-[#4b6b8a] block mb-1">Hari</label>
          <select id="hari" name="hari" class="input-custom w-full px-3 py-2 border border-[#d4e8fc] rounded-lg text-sm bg-white">
            <option value="">-- Semua Hari --</option>
            @foreach ($hariOptions as $hari)
              <option value="{{ $hari }}" @selected(request('hari') === $hari)>{{ $hari }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label for="waktu" class="text-xs font-semibold text-[#4b6b8a] block mb-1">Waktu</label>
          <select id="waktu" name="waktu" class="input-custom w-full px-3 py-2 border border-[#d4e8fc] rounded-lg text-sm bg-white">
            <option value="">-- Semua Waktu --</option>
            @foreach ($waktuOptions as $waktu)
              <option value="{{ $waktu }}" @selected(request('waktu') === $waktu)>{{ $waktu }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label for="perangkat" class="text-xs font-semibold text-[#4b6b8a] block mb-1">Perangkat</label>
          <select id="perangkat" name="perangkat" class="input-custom w-full px-3 py-2 border border-[#d4e8fc] rounded-lg text-sm bg-white">
            <option value="">-- Semua Perangkat --</option>
            @foreach ($perangkatOptions as $perangkat)
              <option value="{{ $perangkat }}" @selected(request('perangkat') === $perangkat)>{{ $perangkat }}</option>
            @endforeach
          </select>
        </div>
        <div class="lg:col-span-3 flex flex-wrap items-center gap-2 pt-1">
          <button type="submit" class="bg-[#0b6bcb] hover:bg-[#1a7fdf] text-white px-5 py-2 rounded-lg text-sm font-semibold transition">
            <i class="fas fa-magnifying-glass mr-1"></i> Cari Data
          </button>
          <a href="{{ route('tes.cari') }}" class="bg-[#e6f3ff] hover:bg-[#d6eaff] text-[#0a4b8a] px-5 py-2 rounded-lg text-sm font-semibold transition">
            <i class="fas fa-rotate-left mr-1"></i> Reset Filter
          </a>
          <span class="text-xs text-[#6b87a3] sm:ml-auto">
            Menampilkan {{ $peserta->firstItem() ?? 0 }}–{{ $peserta->lastItem() ?? 0 }} dari {{ $peserta->total() }} peserta
          </span>
        </div>
      </form>
    </div>

    @php
      $baseQuery = collect(request()->query())->except('page')->all();
      $activeSort = in_array(request('sort'), ['no_tes', 'nama_lengkap', 'asal_sekolah', 'email', 'hari', 'waktu', 'perangkat'], true)
          ? request('sort')
          : 'no_tes';
      $activeDir = strtolower((string) request('dir')) === 'desc' ? 'desc' : 'asc';
      $sortLink = fn (string $column) => route('tes.index', array_merge($baseQuery, [
          'sort' => $column,
          'dir' => ($activeSort === $column && $activeDir === 'asc') ? 'desc' : 'asc',
      ]));
      $sortIcon = fn (string $column) => $activeSort !== $column
          ? 'fa-sort'
          : ($activeDir === 'asc' ? 'fa-sort-up' : 'fa-sort-down');
    @endphp

    <div class="bg-white rounded-2xl sky-shadow overflow-hidden">
      <div class="table-scroll overflow-x-auto">
        <table class="w-full min-w-[980px] text-sm">
          <thead>
            <tr class="bg-[#e6f3ff] text-[#0a4b8a] text-xs uppercase tracking-wide">
              <th class="px-4 py-3 text-left font-bold">No</th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('no_tes') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  No Tes <i class="fas {{ $sortIcon('no_tes') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('nama_lengkap') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  Nama Lengkap <i class="fas {{ $sortIcon('nama_lengkap') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('asal_sekolah') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  Asal Sekolah <i class="fas {{ $sortIcon('asal_sekolah') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('email') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  Email <i class="fas {{ $sortIcon('email') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('hari') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  Hari <i class="fas {{ $sortIcon('hari') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('waktu') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  Waktu <i class="fas {{ $sortIcon('waktu') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">
                <a href="{{ $sortLink('perangkat') }}" class="inline-flex items-center gap-1 hover:text-[#0b6bcb]">
                  Perangkat <i class="fas {{ $sortIcon('perangkat') }} text-[10px]"></i>
                </a>
              </th>
              <th class="px-4 py-3 text-left font-bold">Link</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-[#eaf3fd]">
            @forelse ($peserta as $item)
              <tr class="hover:bg-[#f7fbff]">
                <td class="px-4 py-3 text-[#6b87a3]">{{ $peserta->firstItem() + $loop->index }}</td>
                <td class="px-4 py-3 font-semibold text-[#0a4b8a] whitespace-nowrap">{{ $item->no_tes }}</td>
                <td class="px-4 py-3 text-[#1a3f6a]">{{ $item->nama_lengkap }}</td>
                <td class="px-4 py-3 text-[#1a3f6a]">{{ $item->asal_sekolah ?? '-' }}</td>
                <td class="px-4 py-3 text-[#4b6b8a]">{{ $item->email ?? '-' }}</td>
                <td class="px-4 py-3 text-[#1a3f6a] whitespace-nowrap">{{ $item->hari ?? '-' }}</td>
                <td class="px-4 py-3 text-[#1a3f6a] whitespace-nowrap">{{ $item->waktu ?? '-' }}</td>
                <td class="px-4 py-3 text-[#1a3f6a] whitespace-nowrap">{{ $item->perangkat ?? '-' }}</td>
                <td class="px-4 py-3">
                  @if ($item->link)
                    <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center gap-1 text-[#0b6bcb] hover:text-[#1a7fdf] font-semibold hover:underline whitespace-nowrap"
                       title="{{ $item->link }}">
                      <i class="fas fa-video text-xs"></i> Buka Interview
                    </a>
                  @else
                    <span class="text-[#9db3c8]">-</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="9" class="px-4 py-12 text-center text-[#6b87a3]">
                  <i class="fas fa-inbox text-3xl mb-3 block text-[#b9d3ec]"></i>
                  Belum ada data peserta tes yang cocok dengan filter.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    @if ($peserta->hasPages())
      <div class="mt-5">
        {{ $peserta->appends(request()->query())->links('pagination::tailwind') }}
      </div>
    @endif

  </main>

  <footer class="border-t border-[#dcebfa] bg-white/70">
    <div class="max-w-7xl mx-auto px-4 py-4 text-center text-xs text-[#6b87a3]">
      &copy; {{ date('Y') }} BKK SMK Muhammadiyah Kandanghaur &middot; Halaman informasi peserta tes interview
    </div>
  </footer>

</body>
</html>
