<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CalonKaryawan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=>[
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nik'=>[
                'type'       => 'INT',
                'constraint' => 10,
            ],
            'nama'=>[
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'alamat'=>[
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'jenis_kelamin' => [
                'type' => 'ENUM("LAKI-LAKI","PEREMPUAN")'
            ],
            'tempat_lahir'=>[
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'tanggal_lahir'=>[
                'type'       => 'DATE'
            ],
            'agama'=>[
                'type' => 'ENUM("ISLAM","KATOLIK","KRISTEN","HINDU","BUDHA","KHONGHUCU")'
            ],
            'pendidikan'=>[
                'type' => 'ENUM("SD","SMP","SMA/SMK","D I","D II","D III","D IV/S I")'
            ],
            'no_telp'=>[
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'email'=>[
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique'     => true,
            ],
            'created_at'    =>[
                'type'      => 'datetime', 
                'null'      => true
            ],
            'updated_at'    =>[
                'type'      => 'datetime',
                'null'      => true,
            ],
            'deleted_at'    =>[
                'type' => 'datetime',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('calon_karyawan');
    }

    public function down()
    {
        $this->forge->dropTable('calon_karyawan');
    }
}
