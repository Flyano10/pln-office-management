<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kontrak;
use App\Models\Gedung;
use Illuminate\Support\Facades\DB;

class KontrakSeeder extends Seeder
{
    public function run()
    {
        // Create some Gedung first if none exist
        if (Gedung::count() == 0) {
            DB::table('gedungs')->insert([
                ['nama' => 'Gedung A', 'alamat' => 'Jl. Merdeka No.1', 'created_at' => now(), 'updated_at' => now()],
                ['nama' => 'Gedung B', 'alamat' => 'Jl. Sudirman No.2', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        $gedung = Gedung::first();

        // Create sample Kontrak data
        Kontrak::create([
            'nama_perjanjian' => 'Kontrak Pemeliharaan Gedung A',
            'no_perjanjian_pihak1' => 'Pihak1-001',
            'no_perjanjian_pihak2' => 'Pihak2-001',
            'tanggal_mulai' => now()->subMonths(6),
            'tanggal_selesai' => now()->addMonths(6),
            'sbu' => 'SBU1',
            'ruang_lingkup' => 'Lingkup 1',
            'asset_owner' => 'Owner 1',
            'peruntukan' => 'Kantor SBU',
            'alamat' => 'Jl. Merdeka No.1',
            'status' => 'berjalan',
            'gedung_id' => $gedung->id,
        ]);

        Kontrak::create([
            'nama_perjanjian' => 'Kontrak Pembangunan Gedung B',
            'no_perjanjian_pihak1' => 'Pihak1-002',
            'no_perjanjian_pihak2' => 'Pihak2-002',
            'tanggal_mulai' => now()->subMonths(3),
            'tanggal_selesai' => now()->addMonths(9),
            'sbu' => 'SBU2',
            'ruang_lingkup' => 'Lingkup 2',
            'asset_owner' => 'Owner 2',
            'peruntukan' => 'Kantor KP',
            'alamat' => 'Jl. Sudirman No.2',
            'status' => 'berjalan',
            'gedung_id' => $gedung->id,
        ]);
    }
}
