<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Form Booking Aset - Sispala Bantalawana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .hero-bg {
            background-image: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-modern {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            transition: all 0.3s ease;
        }
        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(234, 88, 12, 0.5);
        }

        input, select, textarea { transition: all 0.2s; }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>

<body class="hero-bg min-h-screen flex flex-col items-center justify-center p-4 md:p-8 antialiased text-gray-700">

    <nav class="fixed top-0 left-0 right-0 z-50 pt-4 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="bg-white/90 backdrop-blur-md rounded-full px-6 py-3 flex justify-between items-center shadow-lg border border-white/50">
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-600 to-emerald-800 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">B</div>
                    <span class="font-bold text-gray-800 tracking-tight group-hover:text-green-700 transition">Bantalawana</span>
                </a>
                <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-500 hover:text-green-700 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="hidden md:inline">Kembali</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="w-full max-w-2xl mt-20 relative z-10">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-lg">Form Peminjaman Alat</h1>
            <p class="text-gray-200 text-sm md:text-base font-light opacity-90">Lengkapi data di bawah ini untuk mengajukan peminjaman aset.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-500/90 backdrop-blur-sm border-l-4 border-white text-white p-4 rounded-xl shadow-lg mb-6 animate-pulse flex items-start gap-3">
                <span class="text-xl">⚠️</span>
                <div>
                    <p class="font-bold">Gagal Booking</p>
                    <p class="text-sm opacity-90">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="glass-card rounded-3xl shadow-2xl overflow-visible relative">
            
            <form action="{{ route('booking.store') }}" method="POST" class="p-6 md:p-10 space-y-6 relative z-10" id="bookingForm">
                @csrf
                
                <div class="relative">
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">Nama Peminjam</label>
                    <div class="relative">
                        <input type="text" id="member_search" class="block w-full rounded-xl border-gray-200 bg-gray-50/50 p-3.5 pl-10 text-sm font-medium text-gray-700 focus:bg-white placeholder-gray-400" placeholder="Ketik nama anggota..." autocomplete="off">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div id="valid_check" class="hidden absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-green-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <input type="text" name="member_id" id="member_id" required class="absolute bottom-0 left-1/2 w-1 h-1 opacity-0 -z-10" oninvalid="this.setCustomValidity('Silakan pilih nama anggota yang valid dari daftar pencarian.')" oninput="this.setCustomValidity('')">
                    <div id="member_dropdown" class="hidden absolute z-50 w-full bg-white mt-1 rounded-xl shadow-xl border border-gray-100 max-h-60 overflow-y-auto custom-scrollbar"></div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <div class="flex justify-between items-end mb-2 ml-1">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Daftar Alat (Max 4)</label>
                        <button type="button" id="addAssetBtn" class="text-xs font-bold text-green-600 hover:text-green-800 flex items-center gap-1 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Alat
                        </button>
                    </div>

                    <div id="assetContainer" class="space-y-3">
                        <div class="asset-row relative flex items-center gap-2">
                            <div class="relative w-full">
                                <select name="asset_ids[]" class="block w-full rounded-xl border-gray-200 bg-gray-50/50 p-3.5 text-sm font-medium text-gray-700 appearance-none focus:bg-white" required>
                                    <option value="" disabled selected>-- Pilih Alat 1 --</option>
                                    @foreach($assets->groupBy('kategori') as $kategori => $items)
                                        <optgroup label="{{ $kategori ? strtoupper($kategori) : 'LAINNYA' }}">
                                            @foreach($items as $asset)
                                                <option value="{{ $asset->id }}">{{ $asset->nama_alat }} ({{ $asset->status_alat }})</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <button type="button" class="remove-btn hidden p-3 text-red-400 hover:text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-green-600 uppercase tracking-wider ml-1">Waktu Pengambilan</label>
                        <div class="flex gap-2">
                            <input type="date" name="tgl_mulai_date" class="w-2/3 rounded-xl border-gray-200 bg-gray-50/50 p-3 text-sm" required>
                            <select name="tgl_mulai_time" class="w-1/3 rounded-xl border-gray-200 bg-gray-50/50 p-3 text-sm" required>
                                <option value="08:00:00">08:00</option>
                                <option value="12:00:00">12:00</option>
                                <option value="17:00:00">17:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-orange-600 uppercase tracking-wider ml-1">Rencana Kembali</label>
                        <div class="flex gap-2">
                            <input type="date" name="tgl_selesai_date" class="w-2/3 rounded-xl border-gray-200 bg-gray-50/50 p-3 text-sm" required>
                            <select name="tgl_selesai_time" class="w-1/3 rounded-xl border-gray-200 bg-gray-50/50 p-3 text-sm" required>
                                <option value="08:00:00">08:00</option>
                                <option value="12:00:00">12:00</option>
                                <option value="17:00:00">17:00</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">Keperluan / Keterangan</label>
                    <textarea name="keperluan" rows="3" class="block w-full rounded-xl border-gray-200 bg-gray-50/50 p-4 text-sm focus:bg-white resize-none" placeholder="Jelaskan tujuan peminjaman alat ini..." required></textarea>
                </div>

                <div id="availabilityError" class="hidden mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm transition-all duration-300">
                    <div class="flex items-start">
                    <div class="py-1"><svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
                    <div>
                    <p class="font-bold">Jadwal Bentrok!</p>
                    <p class="text-sm" id="availabilityErrorMessage">Pesan error akan muncul di sini...</p>
                    </div>
    </div>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full btn-modern text-white font-bold py-4 rounded-xl shadow-xl flex items-center justify-center gap-2 group" id="submitBtn">
                        <span>AJUKAN PEMINJAMAN</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-4">Pastikan data sudah benar sebelum mengajukan.</p>
                </div>
            </form>
        </div>

        <div class="text-center mt-8 text-gray-400 text-xs">
            &copy; {{ date('Y') }} Sispala Bantalawana. All rights reserved.
        </div>
    </div>

    <script>
        // --- 1. SEARCH MEMBER (SAMA SEPERTI SEBELUMNYA) ---
        const allMembers = @json($members); 
        const searchInput = document.getElementById('member_search');
        const hiddenInput = document.getElementById('member_id');
        const dropdown = document.getElementById('member_dropdown');
        const validCheck = document.getElementById('valid_check');

        searchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase();
            hiddenInput.value = "";
            validCheck.classList.add('hidden');
            hiddenInput.setCustomValidity("");
            dropdown.innerHTML = ''; 

            if (keyword.length === 0) {
                dropdown.classList.add('hidden');
                return;
            }

            const filtered = allMembers.filter(member => member.nama.toLowerCase().includes(keyword));

            if (filtered.length > 0) {
                dropdown.classList.remove('hidden');
                filtered.forEach(member => {
                    const item = document.createElement('div');
                    item.className = "px-4 py-3 cursor-pointer hover:bg-green-50 hover:text-green-700 transition border-b border-gray-50 last:border-0 text-sm";
                    item.innerHTML = `<div class="font-bold">${member.nama}</div><div class="text-xs text-gray-400">${member.generasi || 'Anggota'}</div>`;
                    item.addEventListener('click', () => {
                        searchInput.value = member.nama; 
                        hiddenInput.value = member.id;   
                        dropdown.classList.add('hidden'); 
                        validCheck.classList.remove('hidden'); 
                    });
                    dropdown.appendChild(item);
                });
            } else {
                dropdown.classList.remove('hidden');
                dropdown.innerHTML = `<div class="px-4 py-3 text-xs text-gray-400 italic text-center">Nama tidak ditemukan</div>`;
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });

        // --- 2. DYNAMIC ASSET ROWS (BARU) ---
        const container = document.getElementById('assetContainer');
        const addBtn = document.getElementById('addAssetBtn');
        const maxRows = 4;

        // Ambil HTML dari row pertama untuk dijadikan template
        // Kita kloning row pertama tapi bersihkan value-nya
        const firstRow = container.querySelector('.asset-row');
        const template = firstRow.cloneNode(true);
        // Pastikan tombol hapus terlihat di template kloningan
        template.querySelector('.remove-btn').classList.remove('hidden');
        template.querySelector('select').value = ""; // Reset pilihan

        addBtn.addEventListener('click', () => {
            const currentRows = container.querySelectorAll('.asset-row').length;
            if (currentRows < maxRows) {
                const newRow = template.cloneNode(true);
                
                // Tambahkan event listener untuk tombol hapus di row baru
                newRow.querySelector('.remove-btn').addEventListener('click', function() {
                    this.closest('.asset-row').remove();
                    updateAddButton();
                });

                container.appendChild(newRow);
            }
            updateAddButton();
        });

        function updateAddButton() {
            const currentRows = container.querySelectorAll('.asset-row').length;
            if (currentRows >= maxRows) {
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
                addBtn.innerText = 'Maksimal 4 Alat';
            } else {
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                addBtn.innerHTML = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg> Tambah Alat`;
            }
        }

        // --- 3. VALIDASI SUBMIT ---
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            if (!hiddenInput.value) {
                e.preventDefault();
                hiddenInput.setCustomValidity("Wajib memilih nama anggota dari daftar yang muncul.");
                hiddenInput.reportValidity();
            }
        });

        // --- 4. REAL-TIME AVAILABILITY CHECKER ---
    const submitBtn = document.getElementById('submitBtn');
    const errorBox = document.getElementById('availabilityError');
    const errorMessage = document.getElementById('availabilityErrorMessage');

    // Kumpulkan semua input yang mempengaruhi jadwal
    function getBookingInputs() {
        return {
            tgl_mulai_date: document.querySelector('input[name="tgl_mulai_date"]').value,
            tgl_mulai_time: document.querySelector('select[name="tgl_mulai_time"]').value,
            tgl_selesai_date: document.querySelector('input[name="tgl_selesai_date"]').value,
            tgl_selesai_time: document.querySelector('select[name="tgl_selesai_time"]').value,
            // Ambil semua asset_id dari dropdown dynamic row
            asset_ids: Array.from(document.querySelectorAll('select[name="asset_ids[]"]'))
                            .map(select => select.value)
                            .filter(val => val !== "") // Hanya yang sudah dipilih
        };
    }

    // Fungsi Pengecekan ke Server
    async function checkAvailability() {
        const data = getBookingInputs();

        // Jangan cek kalau tanggal / alat belum dipilih
        if (!data.tgl_mulai_date || !data.tgl_selesai_date || data.asset_ids.length === 0) {
            hideError();
            return;
        }

        try {
            // Tampilkan loading di tombol (opsional UX)
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="animate-pulse">Mengecek Jadwal...</span>';
            submitBtn.disabled = true;

            const response = await fetch('{{ route("booking.check") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            // Kembalikan tombol
            submitBtn.innerHTML = originalText;

            if (result.available === false) {
                // JIKA BENTROK
                showError(result.message);
                submitBtn.disabled = true; // Matikan tombol
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                // JIKA AMAN
                hideError();
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

        } catch (error) {
            console.error('Error checking availability:', error);
        }
    }

    function showError(msg) {
        errorMessage.innerText = msg;
        errorBox.classList.remove('hidden');
    }

    function hideError() {
        errorBox.classList.add('hidden');
    }

    // --- PASANG LISTENER (PENGAWAS) ---
    // Setiap kali user ubah tanggal/waktu, jalankan cek
    const dateInputs = document.querySelectorAll('input[type="date"], select[name$="_time"]');
    dateInputs.forEach(input => {
        input.addEventListener('change', checkAvailability);
    });

    // Setiap kali user ubah/tambah alat, jalankan cek
    // Kita gunakan 'change' pada container agar mendeteksi select baru juga
    document.getElementById('assetContainer').addEventListener('change', function(e) {
        if (e.target.tagName === 'SELECT') {
            checkAvailability();
        }
    });

    // Panggil sekali saat load (kali aja form keisi otomatis browser)
    checkAvailability();
    </script>

</body>
</html>