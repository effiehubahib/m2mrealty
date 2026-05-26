<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    protected $table = 'developers';

    protected $fillable = [
        'createdby', 'developername', 'address', 'logo', 'website', 'contactperson', 'contactnumber', 'email', 'latitude', 'longitude',
        'description', 'facebooklink', 'status', 'createdby', 'modifiedby', 'logo', 'telephonenumber', 'mobilenumber',
    ];

    public function updatedeveloper()
    {
        return $this->hasOne('App\UpdateDeveloper', 'developerid');
    }

    public function getSlugAttribute()
    {
        return str_slug($this->attributes['developername'])->slug;
    }

    public function creator()
    {
        return $this->belongsTo('App\User', 'id', 'createdby');
    }

    public function updateby()
    {
        return $this->belongsTo('App\User', 'id', 'modifiedby');
    }

    public function listings()
    {
        return $this->hasMany('App\Listing', 'developerid');
    }
}
