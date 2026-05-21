<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name','sub_category_id','description'
    ];

    protected $casts = [
        'is_project' => 'boolean',
    ];

    public function listings()  
	{
	    return $this->belongsToMany('App\Listing');
	}
	
	public function parent()  
	{
	    return $this->belongsTo(self::class, 'sub_category_id');
	}

	public function children()  
	{
	    return $this->hasMany(self::class, 'sub_category_id');
	}
	public function getisProject()
	{
	    if ($this->sub_category_id==5)
	    	return true;
	    elseif($this->sub_category_id==6)
	    	return false;
	    else{
	    	return $this->parent->getisProject();
	    }
	}
}
