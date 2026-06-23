<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order'        => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pelanggan'   => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'no_hp'            => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'id_paket'         => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'berat'            => [
                'type'       => 'DECIMAL',
                'constraint' => [5, 2],
            ],
            'total_harga'      => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'tanggal_masuk'    => [
                'type' => 'DATE',
            ],
            'tanggal_selesai'  => [
                'type' => 'DATE',
                'null' => true,
            ],
            'status'           => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'default'    => 'Proses',
            ],
            'created_at'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_order', true);
        $this->forge->addForeignKey('id_paket', 'paket_layanan', 'id_paket', 'CASCADE', 'CASCADE');
        $this->forge->createTable('orders');
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}
