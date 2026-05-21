<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListingPhoto extends Model
{
    protected $table = 'listingphotos';

    protected $fillable = [
        'primaryphoto','listing_id','filename','uploadby', 'status'
    ];


    public function user(){
    	return $this->belongsTo('App\User','id','uploadby');
    }
    public function listing(){
    	return $this->belongsTo('App\Listing');
    }
}
