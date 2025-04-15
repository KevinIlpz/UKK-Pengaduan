<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        
        // Jumlah data laporan yang akan di-generate
        for ($i = 0; $i < 50; $i++) {
            // Menghasilkan tanggal acak di bulan Desember 2024
            $createdAt = Carbon::create(2025, 3, rand(1, 28), rand(0, 23), rand(0, 59), rand(0, 59));

            DB::table('reports')->insert([
                'user_id'      => 100, 
                'description'  => $faker->paragraph,
                'type'         => $faker->randomElement(['KEJAHATAN', 'PEMBANGUNAN', 'SOSIAL']),
                'province'     => 'JAWA BARAT',
                'regency'      => 'KABUPATEN BOGOR',
                'subdistrict'  => 'LEUWISADENG',
                'village'      => 'SADENGKOLOT',
                'image'        => null, 
                'voting'       => null, 
                'status'       => $faker->randomElement(['PROSES', 'DITOLAK', 'SELESAI']),
                'created_at'   => $createdAt,
                'updated_at'   => $createdAt,
            ]);
        }
    }
}
