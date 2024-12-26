<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionalEngagementsModel extends Model{

  protected $table = 'tbl_professional_engagements';
  protected $primaryKey = 'engagement_id';
  protected $allowedFields = ['manager_id','professionals_user_id', 'name', 'email', 'phone_number', 'role_id','recruitment-date','conclusion_date','active_engagement'];

}