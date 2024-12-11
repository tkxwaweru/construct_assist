<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderEngagementsModel extends Model{

  protected $table = 'tbl_provider_engagements';
  protected $primaryKey = 'engagement_id';
  protected $allowedFields = ['manager_id','provider_id', 'name', 'email', 'phone_number', 'role_id', 'recruitment_date','conclusion_date','active_engagement'];

}