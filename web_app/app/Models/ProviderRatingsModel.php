<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderRatingsModel extends Model
{

  protected $table = 'tbl_provider_reviews';
  protected $primaryKey = 'provider_rating_id';
  protected $allowedFields = ['providers_user_id', 'review_text', 'review_sentiment', 'reviewers_user_id', 'active_appeal', 'reviewed_on'];
}
