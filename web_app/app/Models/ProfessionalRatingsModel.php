<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessionalRatingsModel extends Model
{

  protected $table = 'tbl_professional_reviews';
  protected $primaryKey = 'professional_rating_id';
  protected $allowedFields = ['professionals_user_id', 'review_text', 'review_sentiment', 'reviewers_user_id', 'active_appeal', 'reviewed_on'];
}
