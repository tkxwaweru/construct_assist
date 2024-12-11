<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model{

  protected $table = 'tbl_roles';
  protected $primaryKey = 'role_id';
  protected $allowedFields = ['role_name','role_description','role_status'];

}