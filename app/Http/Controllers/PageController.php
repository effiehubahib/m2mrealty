<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function properties()
    {
        return view('pages.properties');
    }

    public function agents()
    {
        return view('pages.agents');
    }

    public function developments()
    {
        return view('pages.developments');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }


}
