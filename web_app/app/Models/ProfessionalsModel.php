<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionalsModel extends Model
{

  protected $table = 'tbl_professionals';
  protected $primaryKey = 'professional_id';
  protected $allowedFields = ['user_id', 'profession_id', 'county', 'company', 'certification_file', 'verified', 'reliable_reviews', 'unreliable_reviews', 'reliable'];
}
