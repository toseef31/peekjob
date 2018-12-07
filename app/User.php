<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey = 'userId';
    protected $table = 'jcm_users';
    const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'modifiedTime';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId','secretId','companyId','firstName','lastName','email','username','password','phoneNumber','type','	status','country','city','state','addby','remember_token','profilePhoto','profileImage','about','subscribe','fbId','glId','lnId','user_status','createdTime','modifiedTime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
