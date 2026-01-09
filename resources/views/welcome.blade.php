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
        
        /* WEB3 / MODERN STYLES */
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        
        .hero-bg {
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
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
            box-shadow: 0 10px 20px -10px rgba(234, 88, 12, 0.5);
        }

        /* ANIMASI SCROLLING (MARQUEE) */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .animate-marquee {
            display: flex;
            width: max-content; /* Penting agar memanjang ke samping */
            animation: marquee 40s linear infinite; /* Kecepatan animasi */
        }
        
        .animate-marquee:hover {
            animation-play-state: paused;
        }

        /* Scrollbar cantik untuk modal */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(255, 255, 255, 0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
    </style>
</head>
<body class="font-sans text-gray-600 antialiased selection:bg-green-100 selection:text-green-900">

    <nav class="fixed top-0 left-0 right-0 z-50 pt-4 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="glass-nav rounded-full px-6 py-3 flex justify-between items-center transition-all duration-300 hover:bg-white/80">
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

                <div class="hidden md:flex items-center bg-gray-100/50 rounded-full px-1.5 py-1.5 border border-white/50">
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
                        <span>Booking Alat</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
                
                 <button class="md:hidden p-2 text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </div>
    </nav>

    <section class="hero-bg h-screen flex items-center justify-center text-center px-4 relative pt-20">
        <div class="container mx-auto max-w-5xl text-white relative z-10">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-4 py-1.5 mb-6 animate-fade-in-up">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-xs font-medium tracking-wide text-green-50 uppercase">Open Recruitment 2026</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight drop-shadow-2xl tracking-tight">
                Jelajahi Batas,<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-emerald-100">Temukan Jati Diri.</span>
            </h1>
            <p class="text-lg md:text-2xl mb-10 text-gray-100 max-w-3xl mx-auto font-light leading-relaxed drop-shadow-md">
                Wadah bagi siswa SMKN 1 Cileungsi untuk belajar mencintai alam, membangun karakter tangguh, dan menjunjung persaudaraan.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4 items-center">
                <a href="#booking" class="bg-white text-green-900 font-bold py-4 px-8 rounded-full shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)] hover:scale-105 transition duration-300 flex items-center gap-2">
                    Mulai Petualangan
                </a>
                 <a href="#kegiatan" class="group flex items-center gap-3 px-8 py-4 rounded-full border border-white/30 hover:bg-white/10 transition duration-300 backdrop-blur-sm">
                    <span class="font-semibold">Lihat Galeri</span>
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white group-hover:text-black transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section id="tentang" class="py-24 bg-white">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center gap-16">
            <div class="md:w-1/2 relative group">
                <div class="absolute inset-0 bg-green-200 rounded-[2rem] rotate-3 group-hover:rotate-6 transition duration-500"></div>
                <img src="https://images.unsplash.com/photo-1526772662000-3f88f107f5d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tim Bantalawana" class="relative rounded-[2rem] shadow-2xl object-cover h-[500px] w-full transform transition duration-500 group-hover:-translate-y-2">
            </div>
            <div class="md:w-1/2">
                <span class="text-orange-600 font-bold tracking-wider text-sm uppercase mb-2 block">Tentang Kami</span>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8 leading-tight">Membangun Karakter <br>di Alam Bebas</h2>
                
                <p class="text-lg leading-relaxed mb-6 text-gray-600">
                    Bantalawana bukan sekadar ekstrakurikuler. Kami adalah keluarga besar yang lahir dari kecintaan terhadap alam bebas di <strong>SMK Negeri 1 Cileungsi</strong>.
                </p>
                <p class="text-lg leading-relaxed mb-8 text-gray-600">
                    Kami percaya bahwa alam adalah guru terbaik untuk mengajarkan kepemimpinan, kerjasama tim, dan kerendahan hati.
                </p>
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600 mb-3 text-xl">🧭</div>
                        <h4 class="font-bold text-gray-800">Navigasi Darat</h4>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 mb-3 text-xl">⛑️</div>
                        <h4 class="font-bold text-gray-800">SAR & PPGD</h4>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mb-3 text-xl">🧗</div>
                        <h4 class="font-bold text-gray-800">Rock Climbing</h4>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 hover:border-green-200 transition">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 mb-3 text-xl">🌱</div>
                        <h4 class="font-bold text-gray-800">Konservasi</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="inventaris" class="py-24 bg-[#0f172a] text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-green-500 rounded-full blur-[128px] opacity-20 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-orange-500 rounded-full blur-[128px] opacity-10 pointer-events-none"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row gap-16">
                <div class="md:w-2/3">
                    <h2 class="text-4xl font-bold mb-6">Logistik & Peralatan</h2>
                    <p class="text-gray-400 mb-10 text-lg max-w-xl">
                        Klik pada kategori di bawah untuk melihat ketersediaan alat secara <span class="text-green-400 font-semibold">Real-time</span>.
                    </p>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
                        <button onclick="showCategory('tenda')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-green-500/50 transition group text-left w-full relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-green-500/0 to-green-500/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">⛺</span>
                            <h4 class="font-bold text-lg relative z-10">Tenda & Shelter</h4>
                            <p class="text-xs text-gray-400 mt-2 relative z-10">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('carrier')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-orange-500/50 transition group text-left w-full relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-500/0 to-orange-500/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🎒</span>
                            <h4 class="font-bold text-lg relative z-10">Tas & Carrier</h4>
                            <p class="text-xs text-gray-400 mt-2 relative z-10">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('masak')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-blue-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🍳</span>
                            <h4 class="font-bold text-lg">Alat Masak</h4>
                            <p class="text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('navigasi')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-yellow-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🧭</span>
                            <h4 class="font-bold text-lg">Navigasi</h4>
                            <p class="text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('panjat')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-red-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">🧗</span>
                            <h4 class="font-bold text-lg">Alat Panjat</h4>
                            <p class="text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>

                        <button onclick="showCategory('safety')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-purple-500/50 transition group text-left w-full relative overflow-hidden">
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">⛑️</span>
                            <h4 class="font-bold text-lg">Safety & P3K</h4>
                            <p class="text-xs text-gray-400 mt-2">Cek Ketersediaan &rarr;</p>
                        </button>
                        
                        <button onclick="showCategory('lainnya')" class="bg-white/5 backdrop-blur-sm p-6 rounded-2xl border border-white/10 hover:bg-white/10 hover:border-gray-500/50 transition group text-left w-full relative overflow-hidden col-span-2 md:col-span-3">
                            <span class="text-4xl mb-4 block group-hover:scale-110 transition duration-300 transform origin-left">📦</span>
                            <h4 class="font-bold text-lg">Lainnya (Other)</h4>
                            <p class="text-xs text-gray-400 mt-2">Perlengkapan Tambahan &rarr;</p>
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
    
    <section id="anggota" class="py-24 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4 text-center mb-12">
            <span class="text-green-600 font-bold tracking-wider text-sm uppercase mb-3 block">Keluarga Besar</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Anggota Aktif & Alumni</h2>
        </div>

        <div class="relative w-full overflow-hidden py-10 bg-white/50 backdrop-blur-sm border-y border-gray-200">
            
            <div class="absolute top-0 left-0 z-10 w-24 h-full bg-gradient-to-r from-gray-50 to-transparent pointer-events-none"></div>
            <div class="absolute top-0 right-0 z-10 w-24 h-full bg-gradient-to-l from-gray-50 to-transparent pointer-events-none"></div>

            <div class="animate-marquee flex gap-8 px-4">
                
                {{-- KITA LOOPING 2 KALI AGAR EFEKNYA INFINITE --}}
                @for ($i = 0; $i < 2; $i++) 
                    @foreach($pengurus as $member)
                        <div class="w-64 flex-shrink-0 bg-white p-6 rounded-2xl shadow-md hover:shadow-xl transition duration-300 group border border-gray-100 relative">
                            
                            <div class="w-24 h-24 mx-auto mb-4 relative">
                                <div class="absolute inset-0 bg-gradient-to-tr from-green-400 to-emerald-600 rounded-full blur opacity-20 group-hover:opacity-40 transition">
                                    
                                </div>
                                <img src="{{ $member->avatar ? asset('storage/' . $member->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($member->nama).'&background=random' }}" 
                                     alt="{{ $member->nama }}" 
                                     class="w-full h-full object-cover rounded-full border-2 border-white shadow-sm relative z-10">
                                
                                <div class="absolute bottom-0 right-0 z-20">
                                    @if($member->status == 'Aktif')
                                        <div class="w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center" title="Aktif">
                                            <span class="text-[10px]">🟢</span>
                                        </div>
                                    @else
                                        <div class="w-6 h-6 bg-blue-500 rounded-full border-2 border-white flex items-center justify-center" title="Alumni">
                                            <span class="text-[10px] text-white">🎓</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                <h4 class="text-lg font-bold text-gray-800 line-clamp-1" title="{{ $member->nama }}">
                                    {{ $member->nama }}
                                </h4>
                                <p class="text-xs text-gray-500 font-mono mt-1 mb-3 uppercase tracking-wide">
                                    {{ $member->generasi }}
                                </p>

                                @if($member->status == 'Aktif')
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-green-100 text-green-700 border border-green-200">
                                        PENGURUS AKTIF
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-blue-100 text-blue-700 border border-blue-200">
                                        ALUMNI
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endfor

                @if($pengurus->isEmpty())
                    <div class="w-full text-center text-gray-400 italic px-10">
                        Belum ada data anggota dengan foto profil.
                    </div>
                @endif

            </div>
        </div>
    </section>

    <footer class="relative bg-[#0b1120] text-gray-400 py-16 border-t border-white/5 overflow-hidden font-sans">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-green-900/20 rounded-full blur-[128px] pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-orange-900/10 rounded-full blur-[128px] pointer-events-none"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-emerald-900 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg border border-white/10">B</div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold text-white tracking-tight">Bantalawana</span>
                            <span class="text-[10px] uppercase tracking-widest text-gray-500 font-semibold">SMK Negeri 1 Cileungsi</span>
                        </div>
                    </div>
                    <p class="text-sm leading-relaxed text-gray-500">
                        Wadah pembentukan karakter siswa yang tangguh, peduli lingkungan, dan menjunjung tinggi nilai persaudaraan melalui kegiatan alam bebas.
                    </p>
                </div>
                </div>
            <div class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs text-gray-600 text-center md:text-left">
                    &copy; {{ date('Y') }} Sispala Bantalawana. Built with <span class="text-red-500">❤</span> by Fahmi (Alumni).
                </p>
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
        const allAssets = @json($assets ?? []);

        function showCategory(categoryKey) {
            const modal = document.getElementById('assetModal');
            const panel = document.getElementById('modalPanel');
            const listContainer = document.getElementById('modalList');
            const titleEl = document.getElementById('modalTitle');

            // 1. Set Title
            titleEl.textContent = categoryKey.charAt(0).toUpperCase() + categoryKey.slice(1);
            listContainer.innerHTML = '';

            // 2. FILTER ASSETS (Bagian ini yang sebelumnya hilang)
            const filteredAssets = allAssets.filter(asset => {
                if (asset.kategori) {
                    return asset.kategori === categoryKey;
                }
                return categoryKey === 'lainnya'; 
            });

            // 3. Render
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

                    // LOGIKA STATUS REAL-TIME
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
                                    <p class="text-xs text-gray-500">Kondisi: ${asset.status_alat || 'Baik'} • Lokasi: ${asset.posisi_awal || 'Gudang'}</p>
                                </div>
                            </div>
                            <div>${statusBadge}</div>
                        </div>
                    `;
                    listContainer.innerHTML += itemHtml;
                });
            }

            // 4. Show Modal
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