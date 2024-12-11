<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProviderRating extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'provider_rating_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'provider_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'score' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'comment' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
        ]);
        $this->forge->addPrimaryKey('provider_rating_id');
        $this->forge->createTable('tbl_provider_ratings');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_provider_ratings');
    }
}
