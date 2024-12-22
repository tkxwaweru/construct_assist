<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvidersModel extends Model
{

  protected $table = 'tbl_providers';
  protected $primaryKey = 'provider_id';
  protected $allowedFields = ['user_id', 'service_id', 'county', 'company', 'certification_file', 'verified', 'reliable_reviews', 'unreliable_reviews', 'reliable'];
}
