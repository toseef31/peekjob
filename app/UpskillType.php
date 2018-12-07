<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UpskillType extends Model
{
	use Notifiable;
	protected $primaryKey = 'upskillid';
	  protected $fillable = [
        'upskillid','name'
    ];
	protected $table = 'jcm_upskilltype';
    //
}
