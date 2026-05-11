<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function show($slug)
    {
        // If using a database:
        // $property = Property::where('slug', $slug)->firstOrFail();

        // For now, just return a view (you can pass data later)
        return view('pages.property-detail', compact('slug'));
    }
}
