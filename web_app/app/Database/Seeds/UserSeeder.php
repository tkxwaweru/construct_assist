<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < 1000; $i++) { // Change loop limit to 1000
            $user = $this->generateFakeUser();

            $this->db->table("tbl_users")->insert($user);
        }
    }

    private function generateFakeUser()
    {
        $fakerObject = Factory::create();

        return array(
            "name" => $fakerObject->name,
            "email" => $fakerObject->email,
            "phone_number" => '07' . $fakerObject->numerify('########'),
            "password" => $fakerObject->regexify('[A-Za-z0-9!@#$%^&*()]{60,70}'),
            "role_id" => $fakerObject->randomElement([2, 3, 4]) // Random role_id
        );
    }
}
