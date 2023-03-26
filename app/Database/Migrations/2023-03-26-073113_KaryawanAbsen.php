<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KaryawanAbsen extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'karyawan_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tanggal' => [
                'type'           => 'DATE',
            ],
            'status' =>[
                'type'           => 'ENUM',
                'constraint'     => "'MASUK','ALFA','SAKIT','IZIN','LIBUR','WFA'",
                'default'        => 'MASUK'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('karyawan_id', 'karyawan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('karyawan_absen');
    }

    public function down()
    {
        $this->forge->dropTable('karyawan_absen');
    }
}
