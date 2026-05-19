<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $table = 'refbrgy';

    public $timestamps = false;
    
    protected $fillable = [
        'brgyDesc'
    ]; 
}
