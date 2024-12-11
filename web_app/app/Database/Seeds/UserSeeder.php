<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        for($i = 0; $i < 401; $i++){
           $user = $this->generateFakeUser();

           $this->db->table("tbl_users")->insert($user);
        }
    }

    private function generateFakeUser()
    {
        $fakerObject = Factory::create();

        $role_id = [
            "4"
        ];
        
        return array(
            "name" => $fakerObject->name,
            "email" => $fakerObject->email,
            "phone_number" => '07'. $fakerObject->numerify('##########'),
            "password" => $fakerObject->regexify('[A-Za-z0-9!@#$%^&*()]{60,70}'),
            "role_id" => $fakerObject->randomElement($role_id)
        );
    }
}
