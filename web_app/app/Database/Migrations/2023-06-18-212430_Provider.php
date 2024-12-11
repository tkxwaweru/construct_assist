<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Provider extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'provider_id' => [
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
            'service_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'company' => [
                'type' => 'VARCHAR',
                'constraint' => 40
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 200
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
        $this->forge->addPrimaryKey('provider_id');
        $this->forge->createTable('tbl_providers');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_providers');
    }
}
