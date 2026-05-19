<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function selectListByRegionIDJson(Request $request){
        if(!$request->has('region_id'))
            $region_id = 1;
        else
            $region_id = $request->region_id;

        $region = DB::table('refregion')->where('id','=',$region_id)->select('*')->first();
        if($region==null)
            $region = DB::table('refregion')->select('*')->first();
        $records = DB::table('refprovince as province')->where('regCode','=',$region->regCode)
            ->select(
                'province.*',
            );
        
        $records = $records->where(function ($que) {
            $que->where('province.provDesc', 'LIKE', '%' . request('q') . '%');
        })->orderBy('provDesc','ASC')
        ->get();

        return $records->toJson();
    }
    public function selectProvincesListJson(Request $request)
    {
        $records = DB::table('refprovince as province')
            ->select(
                'province.*',
            );
        
        $records = $records->where(function ($que) {
            $que->where('province.provDesc', 'LIKE', '%' . request('q') . '%');
        })->orderBy('provDesc','ASC')
        ->paginate(10);

        return $records->toJson();
    }
  
}
