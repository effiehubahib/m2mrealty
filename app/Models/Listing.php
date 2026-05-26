<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'developer_id', 'propertytype', 'title', 'slug', 'address', 'region_id', 'province_id', 'city_id', 'barangay', 'totalprice', 'monthlyamortization', 'lotarea', 'floorarea', 'bedroom', 'bathroom', 'categoryid', 'model',
        'garage', 'propertystatus', 'latitude', 'longitude', 'description', 'samplecomputation', 'youtubeurl', 'status', 'createdby', 'modifiedby', 'meta_keywords',
    ];

    public function updatelisting()
    {
        return $this->hasOne(UpdateListing::class, 'listingid');
    }

    public function listingadditionalinfo()
    {
        return $this->hasOne('App\ListingAdditionalinfo', 'listingid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function developer()
    {
        return $this->belongsTo('App\Developer', 'developerid', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'categoryid', 'id');
    }

    public function listingphotos()
    {
        return $this->hasMany(ListingPhoto::class);
    }

    public function regionmodel()
    {
        return $this->belongsTo('App\Region', 'region_id', 'regCode');
    }

    public function provincemodel()
    {
        return $this->belongsTo('App\Province', 'province_id', 'provCode');
    }

    public function citymodel()
    {
        return $this->belongsTo('App\City', 'citymun_id', 'citymunCode');
    }

    public function barangaymodel()
    {
        return $this->belongsTo('App\Barangay', 'barangay', 'brgyCode');
    }

    public function recommendlisting()
    {
        return $this->hasOne('App\RecommendListing', 'listingid');
    }

    public function spotcashoptions()
    {
        return $this->hasMany('App\Spotcashoption', 'listingid');
    }

    public function spotdownpaymentoptions()
    {
        return $this->hasMany('App\Spotdownpaymentoption', 'listingid');
    }
}
