<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Service extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'service_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'service_name' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'service_description' => [
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'service_status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
        ]);
        $this->forge->addPrimaryKey('service_id');
        $this->forge->createTable('tbl_services');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_services');
    }
}
