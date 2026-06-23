<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaketLayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_paket' => 'Regular',
                'harga'      => 5000,
                'estimasi'   => '2 hari',
                'deskripsi'  => 'Paket regular untuk cucian biasa dengan harga terjangkau',
            ],
            [
                'nama_paket' => 'Express',
                'harga'      => 10000,
                'estimasi'   => '1 hari',
                'deskripsi'  => 'Paket express untuk cucian mendesak yang dikerjakan dalam 1 hari',
            ],
            [
                'nama_paket' => 'Premium',
                'harga'      => 15000,
                'estimasi'   => '1 hari',
                'deskripsi'  => 'Paket premium dengan perawatan khusus untuk bahan halus',
            ],
        ];

        $this->db->table('paket_layanan')->insertBatch($data);
    }
}
