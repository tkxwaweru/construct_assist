<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProfessionalSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Fetch all users with role_id = 3 (professionals)
        $query = $db->table('tbl_users')
            ->select('user_id')
            ->where('role_id', 3)
            ->get();
        $users = $query->getResultArray();

        $fakerObject = Factory::create();

        // List of Kenyan counties
        $counties = [
            "Nairobi",
            "Mombasa",
            "Kisumu",
            "Nakuru",
            "Eldoret",
            "Thika",
            "Nyeri",
            "Meru",
            "Kakamega",
            "Embu",
            "Kericho",
            "Bomet",
            "Garissa",
            "Isiolo",
            "Machakos",
            "Kitui",
            "Narok",
            "Kilifi",
            "Malindi",
            "Naivasha",
            "Kiambu",
            "Voi",
            "Wajir",
            "Mandera",
            "Marsabit",
            "Samburu",
            "Turkana",
            "Lodwar",
            "Migori",
            "Homa Bay",
            "Siaya",
            "Busia",
            "Tana River",
            "Taita-Taveta",
            "Kisii",
            "Nyamira",
            "Bungoma",
            "West Pokot",
            "Trans Nzoia",
            "Uasin Gishu",
            "Laikipia",
            "Nandi",
            "Baringo",
            "Elgeyo-Marakwet",
            "Lamu",
            "Kwale"
        ];

        foreach ($users as $user) {
            $userId = $user['user_id'];

            // Generate random reliable and unreliable reviews
            $reliableReviews = $fakerObject->numberBetween(0, 35);
            $unreliableReviews = $fakerObject->numberBetween(0, 35);
            $isReliable = $reliableReviews > $unreliableReviews ? 1 : 0;

            // Prepare the professional data
            $professional = [
                "user_id" => $userId,
                "profession_id" => $fakerObject->numberBetween(1, 13),
                "county" => $fakerObject->randomElement($counties),
                "company" => $fakerObject->company,
                "certification_file" => base64_encode(file_get_contents(base_url('pdf/certificate.pdf'))),
                "verified" => 1,
                "reliable_reviews" => $reliableReviews,
                "unreliable_reviews" => $unreliableReviews,
                "reliable" => $isReliable
            ];

            // Insert into tbl_professionals
            $this->db->table("tbl_professionals")->insert($professional);
        }
    }
}
