<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model{

  protected $table = 'tbl_services';
  protected $primaryKey = 'service_id';
  protected $allowedFields = ['service_name','service_description', 'service_status'];

}