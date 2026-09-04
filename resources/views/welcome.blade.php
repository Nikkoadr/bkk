<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
  <title>BKK SMK Muhammadiyah Kandanghaur</title>
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome 6 (Free) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Google Font: Inter -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap" rel="stylesheet" />
  <style>
    * { font-family: 'Inter', sans-serif; }
    body { background: #f0f8ff; } /* soft sky blue */
    .glass-nav { background: rgba(255,255,255,0.78); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); }
    .card-hover { transition: all 0.25s ease; }
    .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 35px -10px rgba(0, 80, 180, 0.12); }
    .btn-primary-custom { background: #0b6bcb; transition: all 0.2s; } /* sky blue primary */
    .btn-primary-custom:hover { background: #1a7fdf; transform: scale(1.02); }
    .gradient-text { background: linear-gradient(135deg, #0a4b8a, #2b8cdf); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .input-custom:focus { border-color: #2b8cdf; box-shadow: 0 0 0 3px rgba(43, 140, 223, 0.15); }
    .sky-border { border-color: #d4e8fc; }
    .sky-bg-soft { background: #e6f3ff; }
    .sky-shadow { box-shadow: 0 6px 24px rgba(11, 107, 203, 0.08); }
    .brand-image { height: 52px; width: auto; max-height: 52px; object-fit: contain; }
    /* mobile friendly tweaks */
    @media (max-width: 480px) {
      .brand-image { height: 44px; max-height: 44px; }
    }
  </style>
</head>
<body>

  <div class="min-h-screen flex flex-col">

    <!-- ====== NAVBAR ====== -->
    <nav class="glass-nav border-b border-[#dcebfa] sticky top-0 z-50 shadow-sm">
      <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 md:h-20">
          <!-- Logo -->
          <a href="/" class="flex items-center gap-2 flex-shrink-0">
            <!-- logo asli dari asset -->
            <img src="{{ asset('assets/dist/img/logobkk.png') }}" alt="BKK Logo" class="brand-image" />
            <span class="text-[#0a4b8a] font-bold text-base sm:text-lg hidden xs:inline-block">BKK SMK</span>
          </a>
          <!-- Right links: login/register (mobile friendly) -->
          <div class="flex items-center gap-1 sm:gap-2">
            @if (Route::has('login'))
              @auth
                <a href="{{ route('home') }}" class="text-[#1a3f6a] hover:bg-[#e4f0fe] px-3 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition whitespace-nowrap"><i class="fas fa-home mr-1"></i> <span class="hidden xs:inline">Home</span></a>
              @else
                <a href="{{ route('login') }}" class="text-[#1a3f6a] hover:bg-[#e4f0fe] px-3 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition whitespace-nowrap"><i class="fas fa-sign-in-alt mr-1"></i> <span class="hidden xs:inline">Login</span></a>
                @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="bg-[#0b6bcb] text-white hover:bg-[#1a7fdf] px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold transition shadow-md shadow-[#0b6bcb]/20 whitespace-nowrap"><i class="fas fa-user-plus mr-1"></i> <span class="hidden xs:inline">Register</span></a>
                @endif
              @endauth
            @endif
          </div>
        </div>
      </div>
    </nav>

    <!-- ====== MAIN CONTENT ====== -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-3 sm:px-6 lg:px-8 py-6 md:py-10">

      <!-- Header -->
      <div class="text-center mb-6 md:mb-10">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold gradient-text tracking-tight">LOWONGAN PEKERJAAN</h1>
        <div class="w-16 h-1 bg-gradient-to-r from-[#0b6bcb] to-[#5ba6f0] mx-auto mt-2 rounded-full"></div>
      </div>

      <!-- Notifikasi (mobile friendly) -->
      @if (session('notif'))
        <div class="bg-blue-50 border-l-4 border-[#0b6bcb] text-[#0a4b8a] p-3 rounded-2xl mb-5 shadow-sm flex items-start sm:items-center text-sm"><i class="fas fa-info-circle text-[#0b6bcb] mr-3 text-lg mt-0.5"></i>{{ session('notif') }}</div>
      @endif
      @if (session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-3 rounded-2xl mb-5 shadow-sm flex items-start sm:items-center text-sm"><i class="fas fa-check-circle text-emerald-500 mr-3 text-lg mt-0.5"></i>{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-3 rounded-2xl mb-5 shadow-sm flex items-start sm:items-center text-sm"><i class="fas fa-exclamation-circle text-rose-500 mr-3 text-lg mt-0.5"></i>{{ session('error') }}</div>
      @endif

      <!-- Card Lowongan -->
      <div class="bg-white/80 backdrop-blur-sm rounded-3xl shadow-xl sky-shadow border border-[#dcebfa] overflow-hidden">
        @php
          $loker_aktif = $loker->where('status_loker', 'aktif');
        @endphp

        @if($loker_aktif->isEmpty())
          <div class="py-12 md:py-16 text-center px-4">
            <i class="fas fa-cloud-sun text-5xl text-[#8bbcef] mb-4"></i>
            <h3 class="text-xl md:text-2xl font-light text-[#2a6b9e]"><b class="font-bold">LOWONGAN KERJA BELUM TERSEDIA</b></h3>
            <p class="text-[#5a8ab5] text-sm mt-2">Pantau terus media sosial kami untuk info terbaru</p>
          </div>
        @else
          <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
              @foreach ($loker_aktif as $data)
                <div class="card-hover bg-white rounded-2xl border border-[#dcebfa] shadow-sm overflow-hidden flex flex-col">
                  <!-- Header card -->
                  <div class="px-4 sm:px-5 pt-4 pb-2 border-b border-[#eaf3fc] flex items-center gap-2 text-[#2a6b9e] text-xs sm:text-sm font-semibold">
                    <i class="fas fa-building text-[#0b6bcb]"></i> Nama Perusahaan
                  </div>
                  <!-- Body -->
                  <div class="px-4 sm:px-5 py-3 sm:py-4 flex-1">
                    <h5 class="text-lg sm:text-xl font-bold text-[#0a4b8a]">{{ $data->nama_loker }}</h5>
                    <p class="text-[#1f5b8a] font-medium mt-0.5 text-sm sm:text-base"><i class="fas fa-briefcase mr-1.5 text-[#0b6bcb]"></i> Posisi: {{ $data->posisi }}</p>

                    <!-- Sosial Media: hanya IG, FB, TikTok (semua @smkmuhkandanghaur) -->
                    <div class="mt-4 grid grid-cols-2 gap-1.5 text-xs sm:text-sm">
                      <div class="flex items-center gap-1.5">
                        <i class="fab fa-instagram text-[#C13584] text-base sm:text-lg"></i>
                        <a target="_blank" href="https://www.instagram.com/smkmuhkandanghaur/" class="text-[#0b6bcb] font-medium hover:underline truncate">@smkmuhkandanghaur</a>
                      </div>
                      <div class="flex items-center gap-1.5">
                        <i class="fab fa-facebook text-[#1877F2] text-base sm:text-lg"></i>
                        <a target="_blank" href="https://www.facebook.com/smkmuhkandanghaur" class="text-[#0b6bcb] font-medium hover:underline truncate">@smkmuhkandanghaur</a>
                      </div>
                      <div class="flex items-center gap-1.5 col-span-2">
                        <i class="fab fa-tiktok text-base sm:text-lg"></i>
                        <a target="_blank" href="https://www.tiktok.com/@smkmuhkandanghaur" class="text-[#0b6bcb] font-medium hover:underline truncate">@smkmuhkandanghaur</a>
                      </div>
                    </div>
                  </div>
                  <!-- Footer -->
                  <div class="bg-[#f5faff] px-4 sm:px-5 py-3 border-t border-[#dcebfa] flex flex-wrap items-center justify-between gap-2">
                    <p class="text-[#1f5b8a] text-xs sm:text-sm italic opacity-80"><i class="fas fa-arrow-right text-[#0b6bcb] mr-1"></i> @smkmuhkandanghaur</p>
                    <form action="form_daftar" method="POST">
                      @csrf
                      <input type="hidden" name="id_loker" value="{{ $data->id_loker }}">
                      <button class="btn-primary-custom text-white px-4 sm:px-5 py-1.5 sm:py-2 rounded-full text-xs sm:text-sm font-semibold shadow-md shadow-[#0b6bcb]/15 flex items-center gap-2">
                        <i class="fas fa-user"></i> Daftar
                      </button>
                    </form>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <!-- Form Cari Kode Pendaftaran -->
      <div class="mt-6 md:mt-8 max-w-2xl mx-auto">
        <form action="/cari" method="POST" class="flex items-center gap-1.5 sm:gap-2 bg-white/70 backdrop-blur p-1 rounded-full shadow-md border border-[#dcebfa]">
          @csrf
          <input type="text" name="code_pendaftaran" class="flex-1 px-4 sm:px-5 py-2.5 sm:py-3 bg-transparent border-0 focus:ring-0 text-[#1a3f6a] placeholder:text-[#8ab4df] outline-none input-custom rounded-full text-sm sm:text-base" placeholder="🔍 Masukkan kode pendaftaran..." />
          <button type="submit" class="btn-primary-custom text-white px-5 sm:px-6 py-2.5 sm:py-3 rounded-full text-xs sm:text-sm font-semibold flex items-center gap-2 shadow-md shadow-[#0b6bcb]/10">
            <i class="fas fa-search"></i> <span class="hidden xs:inline">Cari</span>
          </button>
        </form>
      </div>

    </main>

    <!-- ====== FOOTER ====== -->
    <footer class="bg-white/80 backdrop-blur-sm border-t border-[#dcebfa] mt-8 md:mt-12">
      <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8 py-4 md:py-5 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs sm:text-sm text-[#1a3f6a]">
        <div class="flex items-center gap-2 flex-wrap justify-center text-center sm:text-left">
          <span><i class="far fa-copyright mr-1"></i> 2024-2025</span>
          <a href="https://bkk.smkmuhkandanghaur.sch.id" class="font-semibold text-[#0b6bcb] hover:underline">Nikko Adrian</a>
          <span class="hidden xs:inline">·</span>
          <span class="text-xs">All rights reserved.</span>
        </div>
        <div class="flex items-center gap-3 text-[#0b6bcb]">
          <span class="text-[10px] sm:text-xs font-medium text-[#1a3f6a]">Ikuti kami</span>
          <a target="_blank" href="https://www.instagram.com/smkmuhkandanghaur/" class="hover:text-[#C13584] transition"><i class="fab fa-instagram text-base sm:text-lg"></i></a>
          <a target="_blank" href="https://www.facebook.com/smkmuhkandanghaur" class="hover:text-[#1877F2] transition"><i class="fab fa-facebook text-base sm:text-lg"></i></a>
          <a target="_blank" href="https://www.tiktok.com/@smkmuhkandanghaur" class="hover:text-black transition"><i class="fab fa-tiktok text-base sm:text-lg"></i></a>
          <span class="text-[10px] sm:text-xs font-medium text-[#1a3f6a] hidden xs:inline">@smkmuhkandanghaur</span>
        </div>
      </div>
    </footer>

  </div>

</body>
</html>