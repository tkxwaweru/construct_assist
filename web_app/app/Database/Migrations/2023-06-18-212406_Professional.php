<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Professional extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'professional_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'profession_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'verified' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'engaged' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
            'average_rating' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
        ]);
        $this->forge->addPrimaryKey('professional_id');
        $this->forge->createTable('tbl_professionals');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_professionals');
    }
}
