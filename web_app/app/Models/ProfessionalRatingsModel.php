<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionalRatingsModel extends Model{

  protected $table = 'tbl_professional_ratings';
  protected $primaryKey = 'professional_rating_id';
  protected $allowedFields = ['professional_id','score','comment','rated_on'];

}