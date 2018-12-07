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
    protected $table = 'jcm_save_packeges';
    protected $primaryKey = 'id';
    const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'updatedTime';

    protected $fillable = [
        'id', 'user_id', 'pckg_id','cat_id','_token','type','amount','quantity','duration','paymentMode','status'
    ];

   
}
