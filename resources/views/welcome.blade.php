<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sispala Bantalawana - SMK Negeri 1 Cileungsi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        .hero-bg {
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .btn-modern {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            transition: all 0.3s ease;
        }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(234, 88, 12, 0.3);
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 40s linear infinite;
        }
        
        .animate-marquee:hover {
            animation-play-state: paused;
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="font-sans text-gray-600 antialiased selection:bg-green-100 selection:text-green-900 bg-gray-50">

    <nav class="fixed top-0 left-0 right-0 z-50 pt-4 px-4 transition-all duration-300" id="navbar">
        <div class="container mx-auto max-w-6xl relative">
            <div class="glass-nav rounded-full px-6 py-3 flex justify-between items-center relative z-50">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="relative w-10 h-10 flex items-center justify-center">
                        <div class="absolute inset-0 bg-green-600 rounded-full opacity-20 group-hover:scale-110 transition-transform duration-300"></div>
                        <div class="relative w-10 h-10 bg-gradient-to-br from-green-600 to-emerald-800 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg group-hover:rotate-12 transition-transform duration-300">B</div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-gray-800 tracking-tight leading-none group-hover:text-green-700 transition-colors">Bantalawana</span>
                        <span class="text-[10px] uppercase tracking-widest text-gray-400 font-semibold group-hover:text-green-600 transition-colors">Sispala SMKN 1</span>
                    </div>
                </a>

                <div class="hidden md:flex items-center bg-gray-100/50 rounded-full px-1.5 py-1.5 border border-white/50 backdrop-blur-sm">
                    <a href="#tentang" class="px-5 py-2 text-sm font-medium text-gray-600 rounded-full hover:bg-white hover:text-green-700 hover:shadow-sm transition-all duration-300">Tentang</a>
                    <a href="#kegiatan" class="px-5 py-2 text-sm font-medium text-gray-600 rounded-full hover:bg-white hover:text-green-700 hover:shadow-sm transition-all duration-300">Kegiatan</a>
                    <a href="#inventaris" class="px-5 py-2 text-sm font-medium text-gray-600 rounded-full hover:bg-white hover:text-green-700 hover:shadow-sm transition-all duration-300">Inventaris</a>
                    <a href="#anggota" class="px-5 py-2 text-sm font-medium text-gray-600 rounded-full hover:bg-white hover:text-green-700 hover:shadow-sm transition-all duration-300">Anggota</a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ url('/admin') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 px-4">Dashboard</a>
                    @else
                        <a href="{{ url('/admin/login') }}" class="text-sm font-semibold text-gray-500 hover:text-green-700 transition px-2">Login</a>
                    @endauth
                    <a href="#booking" class="btn-modern text-white px-6 py-2.5 rounded-full text-sm font-semibold shadow-lg flex items-center gap-2">
                        <span>Booking</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                
                <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>

            <div id="mobile-menu" class="hidden md:hidden absolute top-full left-0 right-0 mt-3 mx-2 bg-white/95 backdrop-blur-xl rounded-3xl border border-gray-100 shadow-2xl p-6 flex flex-col gap-2 transform transition-all duration-300 origin-top scale-95 opacity-0 z-40">
                <a href="#tentang" class="block px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 font-medium">Tentang Kami</a>
                <a href="#kegiatan" class="block px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 font-medium">Kegiatan</a>
                <a href="#inventaris" class="block px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 font-medium">Inventaris</a>
                <a href="#anggota" class="block px-4 py-3 rounded-xl hover:bg-gray-50 text-gray-700 font-medium">Anggota</a>
                <hr class="border-gray-100 my-2">
                <div class="flex flex-col gap-3">
                    @auth
                        <a href="{{ url('/admin') }}" class="block w-full text-center py-3 rounded-xl bg-gray-100 text-gray-800 font-semibold">Dashboard Admin</a>
                    @else
                        <a href="{{ url('/admin/login') }}" class="block w-full text-center py-3 rounded-xl border border-gray-200 text-gray-600 font-semibold">Login Pengurus</a>
                    @endauth
                    <a href="#booking" class="block w-full text-center py-3 rounded-xl btn-modern text-white font-bold shadow-lg">Booking Alat Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-bg min-h-screen flex items-center justify-center text-center px-4 relative pt-20">
        <div class="container mx-auto max-w-5xl text-white relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-1.5 mb-6 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-xs font-medium tracking-wide text-green-50 uppercase">Open Recruitment 2026</span>
            </div>
            <h1 class="text-4xl md:text-7xl font-bold mb-6 leading-tight drop-shadow-2xl tracking-tight">
                Jelajahi Batas,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-emerald-100">Temukan Jati Diri.</span>
            </h1>
            <p class="text-base md:text-2xl mb-10 text-gray-100 max-w-3xl mx-auto font-light leading-relaxed drop-shadow-md">
                Wadah bagi siswa SMKN 1 Cileungsi untuk belajar mencintai alam, membangun karakter tangguh, dan menjunjung persaudaraan.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4 items-center w-full px-4">
                <a href="#booking" class="w-full md:w-auto bg-white text-green-900 font-bold py-4 px-8 rounded-full shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] hover:scale-105 transition duration-300 flex items-center justify-center gap-2">
                    Mulai Petualangan
                </a>
                 <a href="#kegiatan" class="w-full md:w-auto group flex items-center justify-center gap-3 px-8 py-4 rounded-full border border-white/30 hover:bg-white/10 transition duration-300 backdrop-blur-sm">
                    <span class="font-semibold">Lihat Galeri</span>
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section id="tentang" class="py-24 bg-white">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-12 md:gap-16">
            <div class="md:w-1/2 relative group w-full">
                <div class="absolute inset-0 bg-green-200 rounded-[2rem] rotate-3 group-hover:rotate-6 transition duration-500"></div>
                <img src="{{ asset('img/foto-bersama.jpg') }}" 
     alt="Tim Bantalawana" 
     class="relative rounded-[2rem] shadow-2xl object-cover h-[400px] md:h-[500px] w-full transform transition duration-500 group-hover:-translate-y-2">
            </div>
            <div class="md:w-1/2 w-full mt-8 md:mt-0">
                <span class="text-orange-600 font-bold tracking-wider text-sm uppercase mb-2 block">Tentang Kami</span>
                <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 md:mb-8 leading-tight">Membangun Karakter <br>di Alam Bebas</h2>
                
                <p class="text-base md:text-lg leading-relaxed mb-6 text-gray-600">
                    Bantalawana bukan sekadar ekstrakurikuler. Kami adalah keluarga besar yang lahir dari kecintaan terhadap alam bebas di <strong>SMK Negeri 1 Cileungsi</strong>.
                </p>
                
                <div class="grid grid-cols-2 gap-4 md:gap-6">
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition text-center md:text-left">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3 mx-auto md:mx-0 text-xl">🧭</div>
                        <h4 class="font-bold text-gray-800 text-sm md:text-base">Navigasi Darat</h4>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition text-center md:text-left">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 mb-3 mx-auto md:mx-0 text-xl">⛑️</div>
                        <h4 class="font-bold text-gray-800 text-sm md:text-base">SAR & PPGD</h4>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition text-center md:text-left">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-3 mx-auto md:mx-0 text-xl">🧗</div>
                        <h4 class="font-bold text-gray-800 text-sm md:text-base">Rock Climbing</h4>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition text-center md:text-left">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 mb-3 mx-auto md:mx-0 text-xl">🌱</div>
                        <h4 class="font-bold text-gray-800 text-sm md:text-base">Konservasi</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="kegiatan" class="py-24 bg-gray-50 relative">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-green-600 font-bold tracking-wider text-sm uppercase mb-3 block">Galeri & Berita</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Kegiatan Terbaru</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($activities ?? [] as $item)
                    <div class="group rounded-2xl overflow-hidden shadow-lg bg-white border border-gray-100 hover:shadow-2xl transition duration-300">
                        <div class="relative h-64 overflow-hidden bg-gray-100">
                            @if($item->gambar)
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition z-10"></div>
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                                    <span class="text-4xl mb-2">📷</span>
                                    <span class="text-xs font-medium uppercase tracking-wider">Gambar Tidak Tersedia</span>
                                </div>
                            @endif
                            <div class="absolute top-4 left-4 z-20 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-green-800 shadow-sm">
                                {{ $item->tanggal->format('d M Y') }}
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-green-600 transition line-clamp-2">{{ $item->judul }}</h3>
                            <p class="text-gray-500 text-sm line-clamp-3 leading-relaxed mb-4">{{ $item->deskripsi }}</p>
                            <a href="{{ route('activity.show', $item) }}" class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-800 transition gap-1">
                                Baca Selengkapnya <span>&rarr;</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">📅</div>
                        <p class="text-gray-500 font-medium">Belum ada kegiatan yang dipublikasikan.</p>
                        <p class="text-xs text-gray-400 mt-1">Admin dapat menambahkan kegiatan melalui Dashboard Admin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="inventaris" class="py-24 bg-[#0f172a] text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-500 rounded-full blur-[128px] opacity-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-500 rounded-full blur-[128px] opacity-10 pointer-events-none"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row gap-16">
                <div class="md:w-2/3">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6">Logistik & Peralatan</h2>
                    <p class="text-gray-400 mb-10 text-lg max-w-xl">
                        Klik pada kategori di bawah untuk melihat ketersediaan alat secara <span class="text-green-400 font-semibold">Real-time</span>.
                    </p>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-5">
                        <button onclick="showCategory('tenda')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-green-500/50 transition group text-left w-full relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-500/0 to-green-500/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">⛺</span>
                            <h4 class="font-bold text-base md:text-lg relative z-10">Tenda & Shelter</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2 relative z-10">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('carrier')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-orange-500/50 transition group text-left w-full relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/0 to-orange-500/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🎒</span>
                            <h4 class="font-bold text-base md:text-lg relative z-10">Tas & Carrier</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2 relative z-10">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('masak')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-blue-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🍳</span>
                            <h4 class="font-bold text-base md:text-lg">Alat Masak</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('navigasi')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-yellow-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🧭</span>
                            <h4 class="font-bold text-base md:text-lg">Navigasi</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('panjat')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-red-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🧗</span>
                            <h4 class="font-bold text-base md:text-lg">Alat Panjat</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('safety')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-purple-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">⛑️</span>
                            <h4 class="font-bold text-base md:text-lg">Safety & P3K</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>
                        
                        <button onclick="showCategory('lainnya')" class="bg-white/5 backdrop-blur-sm p-4 md:p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-gray-500/50 transition group text-left w-full relative overflow-hidden col-span-2 md:col-span-3">
                            <span class="text-3xl md:text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">📦</span>
                            <h4 class="font-bold text-base md:text-lg">Lainnya (Other)</h4>
                            <p class="text-[10px] md:text-xs text-gray-400 mt-2">Perlengkapan Tambahan &rarr;</p>
                        </button>
                    </div>
                </div>

                <div id="booking" class="md:w-1/3">
                    <div class="bg-white text-gray-800 p-8 rounded-3xl shadow-2xl relative overflow-hidden sticky top-24">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-100 rounded-full blur-3xl -mr-16 -mt-16"></div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2 relative z-10">Pinjam Alat?</h3>
                        <p class="text-gray-500 mb-8 text-sm relative z-10">Sistem booking online khusus untuk anggota aktif dan alumni.</p>
                        <div class="space-y-5 relative z-10">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-400 mb-2 tracking-wider">Peminjam</label>
                                <div class="h-12 bg-gray-50 rounded-xl border border-gray-200 flex items-center px-4 text-gray-400 text-sm">NRA / Nama Lengkap</div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-400 mb-2 tracking-wider">Tanggal</label>
                                <div class="h-12 bg-gray-50 rounded-xl border border-gray-200 flex items-center justify-between px-4 text-gray-400 text-sm">
                                    <span>Pilih Tanggal</span><span class="opacity-50">📅</span>
                                </div>
                            </div>
                            <a href="{{ url('/booking') }}" class="block w-full btn-modern text-white font-bold py-4 rounded-xl text-center shadow-lg hover:shadow-orange-500/30 transition duration-300">Buka Sistem Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section id="anggota" class="py-24 bg-white overflow-hidden">
        <div class="container mx-auto px-4 text-center mb-12">
            <span class="text-green-600 font-bold tracking-wider text-sm uppercase mb-3 block">Keluarga Besar</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Anggota Aktif & Alumni</h2>
        </div>

        <div class="relative w-full overflow-hidden py-10 bg-gray-50/50 backdrop-blur-sm border-y border-gray-200">
            <div class="absolute top-0 left-0 z-10 w-24 h-full bg-gradient-to-r from-gray-50 to-transparent pointer-events-none"></div>
            <div class="absolute top-0 right-0 z-10 w-24 h-full bg-gradient-to-l from-gray-50 to-transparent pointer-events-none"></div>

            <div class="animate-marquee flex gap-8 px-4">
                @for ($i = 0; $i < 2; $i++) 
                    @foreach($pengurus as $member)
                        <div class="w-64 flex-shrink-0 bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300 group border border-gray-100 relative">
                            <div class="w-24 h-24 mx-auto mb-4 relative">
                                <div class="absolute inset-0 bg-gradient-to-tr from-green-400 to-emerald-600 rounded-full blur opacity-20 group-hover:opacity-40 transition"></div>
                                <img src="{{ $member->avatar ? asset('storage/' . $member->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($member->nama).'&background=random' }}" 
                                     alt="{{ $member->nama }}" 
                                     class="w-full h-full object-cover rounded-full border-2 border-white shadow-sm relative z-10 bg-gray-100">
                                <div class="absolute bottom-0 right-0 z-20">
                                    @if($member->status == 'Aktif')
                                        <div class="w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center" title="Aktif"><span class="text-[10px]">🟢</span></div>
                                    @else
                                        <div class="w-6 h-6 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center" title="Alumni"><span class="text-[10px] text-white">🎓</span></div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center">
                                <h4 class="text-lg font-bold text-gray-800 line-clamp-1" title="{{ $member->nama }}">{{ $member->nama }}</h4>
                                <p class="text-xs text-gray-500 font-mono mt-1 mb-3 uppercase tracking-wide">{{ $member->generasi }}</p>
                                @if($member->status == 'Aktif')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 border border-green-200">PENGURUS AKTIF</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700 border border-blue-200">ALUMNI</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endfor
                @if($pengurus->isEmpty())
                    <div class="w-full text-center text-gray-400 italic px-10">Belum ada data anggota dengan foto profil.</div>
                @endif
            </div>
        </div>
    </section>

    <footer class="relative bg-[#0b1120] text-gray-400 py-12 border-t border-white/5 font-sans overflow-hidden">
        <div class="absolute top-0 left-1/4 w-64 h-64 bg-green-900/20 rounded-full blur-[100px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-64 h-64 bg-orange-900/10 rounded-full blur-[100px] pointer-events-none"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8 mb-12">
                <div class="lg:col-span-4 text-center lg:text-left space-y-4">
                    <div class="flex items-center justify-center lg:justify-start gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-emerald-900 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg border border-white/10">B</div>
                        <div class="flex flex-col text-left">
                            <span class="text-xl font-bold text-white tracking-tight">Bantalawana</span>
                            <span class="text-[10px] uppercase tracking-widest text-gray-500 font-semibold">SMK Negeri 1 Cileungsi</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-500 max-w-sm mx-auto lg:mx-0">
                        Mewadahi karakter tangguh, peduli lingkungan, dan menjunjung persaudaraan melalui alam bebas.
                    </p>
                </div>

                <div class="lg:col-span-8 grid grid-cols-2 md:grid-cols-3 gap-8 text-sm">
                    <div>
                        <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-xs">Jelajahi</h4>
                        <ul class="space-y-3">
                            <li><a href="#tentang" class="hover:text-green-400 transition-colors duration-200">Tentang Kami</a></li>
                            <li><a href="#kegiatan" class="hover:text-green-400 transition-colors duration-200">Galeri Kegiatan</a></li>
                            <li><a href="#inventaris" class="hover:text-green-400 transition-colors duration-200">Inventaris</a></li>
                            <li><a href="#anggota" class="hover:text-green-400 transition-colors duration-200">Struktur</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-xs">Akses</h4>
                        <ul class="space-y-3">
                            <li><a href="{{ url('/booking') }}" class="hover:text-orange-400 transition-colors duration-200">Booking Alat</a></li>
                            <li><a href="{{ url('/admin/login') }}" class="hover:text-orange-400 transition-colors duration-200">Login Pengurus</a></li>
                            <li><a href="#" class="hover:text-orange-400 transition-colors duration-200">SOP Peminjaman</a></li>
                        </ul>
                    </div>
                    <div class="col-span-2 md:col-span-1">
                        <h4 class="text-white font-bold mb-4 uppercase tracking-wider text-xs">Sekretariat</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-2">
                                <span class="text-green-500 mt-0.5">📍</span>
                                <span>SMKN 1 Cileungsi<br>Jawa Barat 16820</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="text-green-500">✉️</span>
                                <a href="mailto:info@bantalawana.org" class="hover:text-white transition">info@bantalawana.org</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs">
                <p class="text-center md:text-left">&copy; {{ date('Y') }} Sispala Bantalawana. All rights reserved.</p>
                <p class="flex items-center gap-1">Built with <span class="text-red-500 animate-pulse">❤</span> by Fahmi.</p>
            </div>
        </div>
    </footer>

    <div id="assetModal" class="fixed inset-0 z-[100] hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-md transition-opacity duration-300" onclick="closeModal()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-[#1e293b] w-full max-w-2xl rounded-3xl shadow-2xl border border-white/10 transform transition-all duration-300 scale-95 opacity-0" id="modalPanel">
                <div class="flex justify-between items-center p-6 border-b border-white/5">
                    <div>
                        <h3 class="text-2xl font-bold text-white capitalize" id="modalTitle">Kategori Alat</h3>
                        <p class="text-sm text-gray-400">Status ketersediaan alat real-time.</p>
                    </div>
                    <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-white/5 hover:bg-white/10 flex items-center justify-center text-white transition">✕</button>
                </div>
                <div class="p-6 max-h-[60vh] overflow-y-auto space-y-3 custom-scrollbar" id="modalList"></div>
                <div class="p-6 border-t border-white/5 bg-[#0f172a]/50 rounded-b-3xl flex justify-between items-center">
                    <p class="text-xs text-gray-500">*Data diperbarui otomatis dari database.</p>
                    <a href="{{ url('/booking') }}" class="text-sm font-bold text-green-400 hover:text-green-300 transition">Booking Sekarang &rarr;</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- 1. MOBILE MENU LOGIC ---
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            // Timeout kecil agar transisi opacity berjalan halus setelah display:block
            setTimeout(() => {
                mobileMenu.classList.toggle('opacity-0');
                mobileMenu.classList.toggle('scale-95');
            }, 10);
        });

        // Tutup menu saat link diklik
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => mobileMenu.classList.add('hidden'), 300);
            });
        });

        // --- 2. ASSET MODAL LOGIC ---
        const allAssets = @json($assets ?? []);

        function showCategory(categoryKey) {
            const modal = document.getElementById('assetModal');
            const panel = document.getElementById('modalPanel');
            const listContainer = document.getElementById('modalList');
            const titleEl = document.getElementById('modalTitle');

            titleEl.textContent = categoryKey.charAt(0).toUpperCase() + categoryKey.slice(1);
            listContainer.innerHTML = '';

            const filteredAssets = allAssets.filter(asset => {
                if (asset.kategori) {
                    return asset.kategori === categoryKey;
                }
                return categoryKey === 'lainnya'; 
            });

            if (filteredAssets.length === 0) {
                listContainer.innerHTML = `
                    <div class="text-center py-10 text-gray-500">
                        <p>Belum ada data alat untuk kategori ini.</p>
                    </div>
                `;
            } else {
                filteredAssets.forEach(asset => {
                    let statusBadge = '';
                    let statusClass = '';

                    if (asset.status_realtime === 'Dipinjam') {
                        statusBadge = `<span class="px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-400 text-xs font-bold border border-yellow-500/20">● Dipinjam</span>`;
                        statusClass = 'border-white/5 opacity-70';
                    } else if (asset.status_realtime === 'Rusak') {
                        statusBadge = `<span class="px-3 py-1 rounded-full bg-red-500/10 text-red-400 text-xs font-bold border border-red-500/20">● Rusak</span>`;
                        statusClass = 'border-white/5 opacity-70';
                    } else {
                        statusBadge = `<span class="px-3 py-1 rounded-full bg-green-500/10 text-green-400 text-xs font-bold border border-green-500/20">● Tersedia</span>`;
                        statusClass = 'border-white/5 hover:border-green-500/30';
                    }

                    const itemHtml = `
                        <div class="bg-white/5 p-4 rounded-xl border ${statusClass} flex justify-between items-center transition group hover:bg-white/10">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center text-lg">📦</div>
                                <div>
                                    <h4 class="font-bold text-gray-200 group-hover:text-white transition">${asset.nama_alat}</h4>
                                    <p class="text-xs text-gray-500">
    Kondisi: ${asset.status_alat || 'Baik'} • Lokasi: <span class="font-semibold text-white-300">${asset.lokasi_display}</span>
</p>
                                </div>
                            </div>
                            <div>${statusBadge}</div>
                        </div>
                    `;
                    listContainer.innerHTML += itemHtml;
                });
            }

            modal.classList.remove('hidden');
            setTimeout(() => {
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('assetModal');
            const panel = document.getElementById('modalPanel');
            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>

</body>
</html>