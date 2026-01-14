<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $activity->judul }} - Sispala Bantalawana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <nav class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 transition-all">
        <div class="container mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ url('/') }}" class="group flex items-center gap-2 font-bold text-lg text-gray-700 hover:text-green-700 transition">
                <span class="bg-gray-100 group-hover:bg-green-100 p-2 rounded-full transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </span>
                <span>Kembali</span>
            </a>
            <span class="text-xs font-bold uppercase tracking-widest text-green-600 bg-green-50 px-3 py-1 rounded-full border border-green-100">
                Berita
            </span>
        </div>
    </nav>

    <main class="container mx-auto px-4 md:px-6 py-8 max-w-4xl">
        
        <header class="mb-8 text-center">
            <div class="inline-flex items-center gap-2 bg-white border border-gray-200 text-gray-500 px-4 py-1.5 rounded-full text-xs font-semibold mb-6 shadow-sm">
                <span>📅</span> {{ $activity->tanggal->format('d F Y') }}
            </div>
            
            <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold text-gray-900 leading-snug md:leading-tight mb-4">
                {{ $activity->judul }}
            </h1>
        </header>

        <div class="rounded-2xl md:rounded-3xl overflow-hidden shadow-xl mb-10 border border-gray-100 bg-gray-200 relative group">
            @if($activity->gambar)
                <img src="{{ asset('storage/' . $activity->gambar) }}" 
                     alt="{{ $activity->judul }}" 
                     class="w-full h-64 md:h-[500px] object-cover transition duration-700 hover:scale-105">
            @else
                <div class="w-full h-64 md:h-[400px] flex flex-col items-center justify-center text-gray-400">
                    <span class="text-5xl mb-3">📰</span>
                    <span class="text-sm font-medium">Tidak ada gambar</span>
                </div>
            @endif
        </div>

        <article class="prose prose-lg prose-green mx-auto bg-white p-6 md:p-12 rounded-2xl md:rounded-3xl shadow-sm border border-gray-100 text-gray-600 leading-loose text-justify">
            {!! nl2br(e($activity->deskripsi)) !!}
        </article>

        @if(isset($otherActivities) && $otherActivities->count() > 0)
            <div class="mt-16 pt-10 border-t border-gray-200">
                <div class="flex justify-between items-end mb-6 px-1">
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900">Berita Lainnya</h3>
                    <div class="text-xs text-gray-400 flex items-center gap-1">
                        Geser <span class="md:hidden">&larr; &rarr;</span>
                    </div>
                </div>
                
                <div class="flex overflow-x-auto snap-x snap-mandatory gap-4 md:gap-6 pb-6 -mx-4 px-4 md:mx-0 md:px-0 scroll-smooth hide-scrollbar">
                    
                    @foreach($otherActivities as $other)
                        <a href="{{ route('activity.show', $other) }}" 
                           class="snap-center flex-shrink-0 w-[80vw] md:w-[320px] group block bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300">
                            
                            <div class="h-40 md:h-48 overflow-hidden relative bg-gray-100">
                                @if($other->gambar)
                                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition z-10"></div>
                                    <img src="{{ asset('storage/' . $other->gambar) }}" 
                                         alt="{{ $other->judul }}" 
                                         class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                                        📷 No Image
                                    </div>
                                @endif
                                
                                <div class="absolute top-2 left-2 z-20 bg-white/90 backdrop-blur-md px-2 py-1 rounded-lg text-[10px] font-bold text-green-800 shadow-sm">
                                    {{ $other->tanggal->format('d M') }}
                                </div>
                            </div>

                            <div class="p-4 md:p-5">
                                <h4 class="font-bold text-base md:text-lg text-gray-800 leading-snug group-hover:text-green-700 transition line-clamp-2 mb-2">
                                    {{ $other->judul }}
                                </h4>
                                <p class="text-xs md:text-sm text-gray-500 line-clamp-2 leading-relaxed">
                                    {{ Str::limit($other->deskripsi, 70) }}
                                </p>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        @endif

        <div class="mt-12 mb-8 text-center">
            <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-2 text-sm font-semibold text-gray-500 hover:text-green-700 transition px-6 py-3 rounded-full hover:bg-gray-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Kembali ke Beranda
            </a>
            <p class="text-xs text-gray-300 mt-4">&copy; {{ date('Y') }} Sispala Bantalawana</p>
        </div>

    </main>

</body>
</html>