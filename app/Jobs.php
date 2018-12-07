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
    protected $table = 'jcm_jobs';
    protected $primaryKey = 'jobId';
    const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'updatedTime';

    protected $fillable = [
        'jobId', 'userId', 'companyId','pay_id','amount','p_Category','title','jType','department','category','subCategory','careerLevel','experience','vacancies','description','skills','qualification','jobType','jobShift','minSalary','maxSalary','currency','benefits','country','city','state','expiryDate','package_start_time','status','createdTime'
    ];

   
}
