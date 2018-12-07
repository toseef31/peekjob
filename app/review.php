<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
	protected $table = 'jcm_companyreview';
    protected $primaryKey = 'review_id';
    const CREATED_AT = 'created_date';
    const UPDATED_AT = 'updated_date';
}
