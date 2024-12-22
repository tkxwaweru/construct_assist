<?php

namespace App\Models;

use CodeIgniter\Model;

class ProviderRatingsModel extends Model
{

  protected $table = 'tbl_provider_reviews';
  protected $primaryKey = 'provider_rating_id';
  protected $allowedFields = ['provider_id', 'review_text', 'review_sentiment', 'reviewed_on'];
}
