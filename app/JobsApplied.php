<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JobsApplied extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $table = 'jcm_job_applied';
    protected $primaryKey = 'applyId';
    const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'updatedTime';

    protected $fillable = [
        'applyId', 'userId', 'jobId','applyTime','applicationStatus'
    ];

   
}
