<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MemberSeeder extends Seeder
{
    public function run(): void


    {
            $this->call(MemberSeeder::class);
        // Reset tabel dulu biar tidak duplikat
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('members')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $now = Carbon::now();

        $members = [
            // FOUNDER
            ['nama' => 'Santibi', 'generasi' => 'Founder', 'status' => 'Alumni', 'nomor_hp' => '085813902419'],

            // PELOPOR
            ['nama' => 'Adi Pratama', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => '123123235'],
            ['nama' => 'Aepudin', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Dandi', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'M. Suratman', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Gerry', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Kristin', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Eha', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Andika Rmdh', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Asep', 'generasi' => 'Perintis Rimba (Pelopor)', 'status' => 'Alumni', 'nomor_hp' => null],

            // PERINTIS
            ['nama' => 'Ibnu', 'generasi' => 'Air Belantara (Perintis)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Lia', 'generasi' => 'Air Belantara (Perintis)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Aisyah', 'generasi' => 'Air Belantara (Perintis)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Indah', 'generasi' => 'Air Belantara (Perintis)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Vivi', 'generasi' => 'Air Belantara (Perintis)', 'status' => 'Alumni', 'nomor_hp' => null],

            // ANGKATAN 1
            ['nama' => 'Muhammad Rizkiawan', 'generasi' => 'Benih Pohon (1)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Rd.Cakra Lingga Firdaus', 'generasi' => 'Benih Pohon (1)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Fauzan Duhri Yudistira', 'generasi' => 'Benih Pohon (1)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Elika Sahlia', 'generasi' => 'Benih Pohon (1)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Dafa Alfarizi', 'generasi' => 'Benih Pohon (1)', 'status' => 'Alumni', 'nomor_hp' => null],

            // ANGKATAN 2
            ['nama' => 'Muhammad Fahmi Fadhillah', 'generasi' => 'Tunas Muda (2)', 'status' => 'Alumni', 'nomor_hp' => '082260940279'],
            ['nama' => 'Astria Sinaga', 'generasi' => 'Tunas Muda (2)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Regita Rahmawati', 'generasi' => 'Tunas Muda (2)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Muhammad Fajri Iman Fathoni', 'generasi' => 'Tunas Muda (2)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Mochammad Reijah Priadi', 'generasi' => 'Tunas Muda (2)', 'status' => 'Alumni', 'nomor_hp' => null],
            ['nama' => 'Faisal Ahmad Hadi', 'generasi' => 'Tunas Muda (2)', 'status' => 'Alumni', 'nomor_hp' => null],

            // ANGKATAN 7 (AKTIF)
            ['nama' => 'Shindi Rindyani', 'generasi' => 'Bintang Rimba (7)', 'status' => 'Aktif', 'nomor_hp' => '081239129412'],
            ['nama' => 'Amelia Putri', 'generasi' => 'Bintang Rimba (7)', 'status' => 'Aktif', 'nomor_hp' => null],
            // ... (Tambahkan sisa data lain jika perlu dengan format sama) ...
        ];

        // Masukkan Timestamp otomatis
        foreach ($members as &$member) {
            $member['created_at'] = $now;
            $member['updated_at'] = $now;
        }

        DB::table('members')->insert($members);
    }
}