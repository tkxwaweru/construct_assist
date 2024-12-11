<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Profession extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'profession_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'profession_name' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'profession_description' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'profession_status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
        ]);
        $this->forge->addPrimaryKey('profession_id');
        $this->forge->createTable('tbl_professions');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_professions');
    }
}

