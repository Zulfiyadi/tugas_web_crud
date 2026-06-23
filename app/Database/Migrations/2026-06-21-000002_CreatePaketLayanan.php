<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaketLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_paket'   => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_paket' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'harga'      => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'estimasi'   => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'deskripsi'  => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_paket', true);
        $this->forge->createTable('paket_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('paket_layanan');
    }
}
