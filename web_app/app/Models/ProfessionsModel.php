<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionsModel extends Model{

  protected $table = 'tbl_professions';
  protected $primaryKey = 'profession_id';
  protected $allowedFields = ['profession_name','profession_description','profession_status'];

}