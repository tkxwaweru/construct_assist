<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{

  protected $table = 'tbl_users';
  protected $primaryKey = 'user_id';
  protected $allowedFields = ['name','email','phone_number','password','role_id', 'registered_on', 'updated_at','account_status'];

}