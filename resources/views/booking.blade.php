<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Form Booking Aset</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; }
        input, select, textarea { font-size: 16px !important; } 
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
        
        <div class="bg-emerald-600 p-6 text-center">
             <h2 class="text-2xl font-bold text-white">Form Peminjaman</h2>
             <p class="text-emerald-50 text-xs mt-1">Isi data waktu pengambilan & pengembalian dengan teliti.</p>
        </div>
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-6 mt-6" role="alert">
                <p class="font-bold">Gagal Booking</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            
            <div>
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wide">Nama Peminjam</label>
                <select name="member_id" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 p-3 border focus:ring-emerald-500 h-12" required>
                    <option value="">-- Pilih Nama --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wide">Alat</label>
                <select name="asset_id" class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 p-3 border focus:ring-emerald-500 h-12" required>
                    <option value="">-- Pilih Alat --</option>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->nama_alat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Waktu Pengambilan</label>
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2">
                        <input type="date" name="tgl_mulai_date" class="block w-full rounded-lg border-gray-300 p-3 border focus:ring-emerald-500 text-sm h-12 bg-white" required>
                    </div>
                    <div class="col-span-1">
                        <select name="tgl_mulai_time" class="block w-full rounded-lg border-gray-300 bg-gray-50 p-3 border focus:ring-emerald-500 text-sm h-12" required>
                            <option value="08:00:00">08:00 Pagi</option>
                            <option value="12:00:00">12:00 Siang</option>
                            <option value="17:00:00">17:00 Sore</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wide">Rencana Pengembalian</label>
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2">
                        <input type="date" name="tgl_selesai_date" class="block w-full rounded-lg border-gray-300 p-3 border focus:ring-emerald-500 text-sm h-12 bg-white" required>
                    </div>
                    <div class="col-span-1">
                        <select name="tgl_selesai_time" class="block w-full rounded-lg border-gray-300 bg-gray-50 p-3 border focus:ring-emerald-500 text-sm h-12" required>
                            <option value="08:00:00">08:00 Pagi</option>
                            <option value="12:00:00">12:00 Siang</option>
                            <option value="17:00:00">17:00 Sore</option>
                        </select>
                    </div>
                </div>
            </div>

            <div>
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wide">Keperluan</label>
                <textarea name="keperluan" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 p-3 border focus:ring-emerald-500" placeholder="Contoh: Pendidikan Dasar..." required></textarea>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg hover:bg-emerald-700 active:scale-95 transition-all">
                    AJUKAN SEKARANG
                </button>
            </div>
            
            <div class="text-center">
                <a href="{{ url('/') }}" class="text-xs text-gray-400 font-bold hover:text-emerald-600 no-underline">
                    KEMBALI KE BERANDA
                </a>
            </div>
        </form>
    </div>
</body>
</html>