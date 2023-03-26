<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LogAbsen extends Migration
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
            'absen_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'log_time' => [
                'type'           => 'TIME',
            ],
            'log_date' =>[
                'type'           => 'DATE',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('absen_id', 'karyawan_absen', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('log_absen');
    }

    public function down()
    {
        $this->forge->dropTable('log_absen');
    }
}
