<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityMunController extends Controller
{
    public function selectListByProvinceIDJson(Request $request){
        if(!$request->has('province_id'))
            $province_id = 1;
        else
            $province_id = $request->province_id;

        $province = DB::table('refprovince')->where('id','=',$province_id)->select('*')->first();
        if($province==null)
            $province = DB::table('refprovince')->select('*')->first();
        $records = DB::table('refcitymun as citymun')->where('provCode','=',$province->provCode)
            ->select(
                'citymun.*',
            );
        
        $records = $records->where(function ($que) {
            $que->where('citymun.citymunDesc', 'LIKE', '%' . request('q') . '%');
        })->orderBy('citymunDesc','ASC')
        ->get();

        return $records->toJson();
    }
}
