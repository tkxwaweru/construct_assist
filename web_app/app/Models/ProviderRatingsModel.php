<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderRatingsModel extends Model{

  protected $table = 'tbl_provider_ratings';
  protected $primaryKey = 'provider_rating_id';
  protected $allowedFields = ['provider_id','score','comment','rated_on'];

}