<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CometChat extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table = 'cometchat';
    protected $primaryKey = 'id';
    /*const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'updatedTime';*/

    protected $fillable = [
        'id', 'from', 'to','message','sent','read','direction','custom_data'
    ];

   
}
