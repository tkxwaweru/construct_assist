<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProfessionalRating extends Migration
{
    public function up()
    {   
        //
        $this->forge->addField([
            'professional_rating_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'professional_id' => [
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
        $this->forge->addPrimaryKey('professional_rating_id');
        $this->forge->createTable('tbl_professional_ratings');
    }

    public function down()
    {
        //
        $this->forge->dropTable('tbl_professional_ratings');
    }
}
