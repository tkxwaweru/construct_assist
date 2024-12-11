<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 60 
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 40
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 25
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'account_status' => [
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            ],
        ]);
        $this->forge->addPrimaryKey('user_id');
        $this->forge->createTable('tbl_users');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_users');
    }
}
