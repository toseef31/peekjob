<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Jobs extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table = 'jcm_writings';
    protected $primaryKey = 'writingId';
      const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'modifiedTime';
   

    protected $fillable = [
        'writingId', 'userId', 'title','description','citation','wIcon','status','cat_names','amount'
    ];

   
}
