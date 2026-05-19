<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordChangeController extends Controller
{
    public function show(Request $request){
        return view('password-change.show');
    }
}
