<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionalRatingsModel extends Model
{

  protected $table = 'tbl_professional_reviews';
  protected $primaryKey = 'professional_rating_id';
  protected $allowedFields = ['professional_id', 'review_text', 'review_sentiment', 'reviewed_on'];
}
