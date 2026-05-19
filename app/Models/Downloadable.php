<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Downloadable extends Model
{
     protected $fillable = [
        'title','status','description','uniquename','created_by','filename',
    ];


    public function user(){
    	return $this->belongsTo('App\User','id','created_by');
    }

}
