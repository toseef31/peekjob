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
    protected $table = 'jcm_upskills';
    protected $primaryKey = 'skillId';
    const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'modifiedTime';
   

    protected $fillable = [
        'skillId', 'status'
    ];

   
}
