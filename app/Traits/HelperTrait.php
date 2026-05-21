<?php

namespace App\Traits;

use App\Models\Category;
use App\Services\HolidayService;
use Auth;
use Carbon\Carbon;
use DB;
use File;


trait HelperTrait {
    public static function getProjectTree(&$project_ids,$root){
       
        $subcategories = Category::where('sub_category_id',$root)->get();//with('children')->
        
        if($subcategories->isNotEmpty()){
            foreach($subcategories as $singlecategory){
                $project_ids[] = $singlecategory->id;
                self::getProjectTree($project_ids,$singlecategory->id);
            }
        }
        

    }
	public static function getAgeArray()
    {
		$age = array(''=>'Any');
        for($ctr = 18; $ctr <= 50; $ctr++){
            $age[$ctr] = $ctr;
        }

        return $age;
    }
    public static function getDaysArray()
    {
        for($dayNum = 1; $dayNum <= 31; $dayNum++){
            $days[str_pad($dayNum, 2, '0', STR_PAD_LEFT)] = $dayNum;
        }

        return $days;
    }
	
    public static function getYearsArray()
    {
        $thisYear = date('Y', time())-17;

        for($yearNum = $thisYear; $yearNum >= 1910; $yearNum--){
            $years[$yearNum] = $yearNum;
        }

        return $years;
    }

	public static function getMonthsArray()
    {
        for($monthNum = 1; $monthNum <= 12; $monthNum++){
        	$monthname = date('m', mktime(0, 0, 0, $monthNum, 1));
            $months[$monthname] = date('F', mktime(0, 0, 0, $monthNum, 1));
        }

        return $months;
    }
    public static function getGenderArray()
    {
       

       $gender = array(''=>'Any','Female'=>'Female','Male'=>'Male');

        return $gender;
    }
    public static function getSourcesArray()
    {

        $sources = array(''=>'Any');

        foreach(Config::get('constants.sourcechoices') as $source)
        	$sources[$source] = $source;

        return $sources;
    }
    public static function getdateTypeArray() {
		$choice =  array('0' => 'Weekly',
                         '1' => 'Monthly',
                         '2' => 'Quarterly',
                         '3' => 'Yearly',
                        ) ;
		return $choice;
	}
    public static function getStatQuarter()
	{
		$req =  array(	1 => '1st Quarter',
						2 => '2nd Quarter',
						3 => '3rd Quarter',
						4 => '4th Quarter',
                       );
		return $req;
	}
    public static function getCurrentQuarter(){
         $n = date('n');
         if($n < 4){
              return 1;
         } elseif($n > 3 && $n <7){
              return 2;
         } elseif($n >6 && $n < 10){
              return 3;
         } elseif($n >9){
              return 4;
         }
    }
    public static function sun_week_range($date) {
        $ts = strtotime($date);
        $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
        return array(date('Y-m-d', $start),
                     date('Y-m-d', strtotime('next saturday', $start)));
    }

    public static function week_number($date=null, $rollover="Sunday")
    {
      if($date==null)
      $date=date("Y-m-d");
    
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }
    public static function getStatYears()
    {
        $thisYear = date('Y');
        $startyear = 2014;
        for($yearNum = $thisYear; $yearNum >= $startyear; $yearNum--){
            $years[$yearNum] = $yearNum;
        }

        return $years;
    }
    public static function createDateRangeArray($strDateFrom,$strDateTo) {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange=array();

        $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
        $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

        if ($iDateTo>=$iDateFrom)
        {
            array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo)
            {
                $iDateFrom+=86400; // add 24 hours
                array_push($aryRange,date('Y-m-d',$iDateFrom));
            }
        }
        return $aryRange;
    }

    public static function get_sub_org($parentid) {
       $top = User::where('id',$parentid)->select('id',DB::raw("CONCAT(firstname,' ',' ',lastname) as agentname" ) ,'sponsorid','jobposition')->first();
        //print_r($top);exit;
        $users = User::where('sponsorid',$parentid)->where('verified',1)->where('status',1)->get();
        //print_r($users);exit;
        /*$rows[] = array('v' => (int) $top->id, 'f' => (string) '<a href="#">'. $top->agentname.'<div style="color:red; font-style:italic">'.$top->jobposition.'</div></a>',$top->sponsorid,$top->jobposition);*/

        $rows = array();
        $rows[] = $top;

        //print_r($rows);exit;
        /*print_r($temp);
        echo"<br/><br/><br/>";
        echo json_encode($temp);exit;*/
        //$temp[] = array('f' => (string) '<a href="#">'. $top->firstname.' '.); 
        //$rows[] = $temp;
        //print_r($rows);exit;
        

        if($users!=null){
            
            foreach($users as $member){
                
                //echo"M:".$member->id;exit;
                $b = Helper::get_sub_org($member->id); 
                //print_r($b);exit;
                $rows = array_merge($rows,$b);
                //print_r($rows);exit;
            }

        }
        
        return $rows;
    }
    public static function get_upline(&$upline,$sponsorid) {

        $sponsor = User::where('id',$sponsorid)->select('id','firstname','lastname','jobposition','sponsorid','marriedto')->first();
        
        if($sponsor->count()>0 )
        {
            $upline[] = $sponsor;
            if($sponsor->sponsorid!=0){
                $users = User::where('id',$sponsor->sponsorid)->select('id','firstname','lastname','jobposition','sponsorid','marriedto')->first();
                if($users->count()>0 ){
                    $upline[] = $users;
                   if($users->sponsorid!=0){
                        Helper::get_upline($upline,$users->sponsorid); 
                    }
                }
            }
        }
    }
    public static function getUplineToBroker(&$upline,$sponsorid,$brokerfound=false,$salesdirectorfound=false){
        $sponsor = User::where('id',$sponsorid)->select('id','firstname','lastname','jobposition','sponsorid','marriedto')->first();

        if($sponsor->count()>0 && $brokerfound==false)
        {
            
            

            if( $sponsor->jobposition <=6 && $salesdirectorfound==false){
                //add sponsor to upline
                $upline[] = $sponsor;
            }

            //check if Broker
            if($sponsor->jobposition==7){
                $upline[] = $sponsor;
                $brokerfound = true;

            }
            
            //check if Sales Director
            if($sponsor->jobposition==6)
                $salesdirectorfound=true;

            if($sponsor->sponsorid!=0){
                Helper::getUplineToBroker($upline,$sponsor->sponsorid,$brokerfound,$salesdirectorfound); 
            }

            /*if($sponsor->sponsorid!=0){
                $users = User::where('id',$sponsor->sponsorid)->where('jobposition','<=',7)->select('id','firstname','lastname','jobposition','sponsorid','marriedto')->first();
                if(count($users)>0 && $brokerfound==false){
                    if($users->jobposition==6)
                    {
                        if($salesdirectorfound==false){
                            $upline[] = $users;
                            $salesdirectorfound=true;
                            echo "USER:".$users->firstname."-".$salesdirectorfound;exit;
                        }    

                    }else{
                        $upline[] = $users;
                    }
                    
                   
                }
            }*/
        }
    }
    public static function getDownlineRoyalty(&$royaltyReceiver, $employeeid){

        $downagent = User::where('sponsorid',$employeeid)->select('id','firstname','lastname','jobposition')->get();
        
        if($downagent->count()>0 )
        {
            foreach($downagent as $agent){
                if(in_array($agent->jobposition,[6,7]))
                    $royaltyReceiver[] = $agent;
                $users = User::where('sponsorid',$agent->id)->select('id','firstname','lastname','jobposition')->get();
                
                if($users->count()>0 ){
                    foreach($users as $user){
                        if(in_array($agent->jobposition,[6,7]))
                            $royaltyReceiver[] = $user;
                        Helper::getDownlineRoyalty($royaltyReceiver,$user->id); 
                    }
                }
            }
        }
    }
    public static function getDownline(&$downline, $employeeid){
        $downagent = User::where('sponsorid',$employeeid)->select('id','firstname','lastname')->get();
        
        if($downagent->count()>0 )
        {
            foreach($downagent as $agent){
                $downline[] = $agent;
                $users = User::where('sponsorid',$agent->id)->select('id','firstname','lastname')->get();
                if($users->count()>0 ){
                    foreach($users as $user){
                        $downline[] = $user;
                        Helper::getDownline($downline,$user->id); 
                    }
                }
            }
        }
    }
    public static function get_uplineBrokerage(&$upline,$sponsorid) {

        $sponsor = User::where('id',$sponsorid)->select('id','firstname','lastname','jobposition','sponsorid','marriedto')->first();
        
        if($sponsor->count()>0 && $sponsorid!=1)
        {
            $upline[] = $sponsor;
            if($sponsor->sponsorid!=1){
                
                $users = User::where('id',$sponsor->sponsorid)->select('id','firstname','lastname','jobposition','sponsorid','marriedto')->first();
                if($users->count()>0 ){
                    $upline[] = $users;
                   if($sponsor->sponsorid!=1){
                        Helper::get_uplineBrokerage($upline,$users->sponsorid); 
                    }
                }
            }
        }
    }
    public static function removePartnerInUpline(&$upline, $marriedto){
        //if upline married with agent who sold the listing
        for($i = ($upline!=null)-1; $i >= 0; $i--){
            if($upline[$i]["id"] == $marriedto){
                unset($upline[$i]);
            }
        }

    }
    public static function removeSpouseInArray(&$arr){

        foreach($arr as $subKey1 => $subArray1){
            foreach($arr as $subKey2 =>$subArray2){
                if($subArray1['id']!=$subArray2['id']){
                    if($subArray2['marriedto'] == $subArray1['id']){
                        unset($arr[$subKey2]);
                    }
                }
            }
        }
    }
    
    //get all categories where listing belongs 
    public static function get_listing_categories($child){
        $rows = array();
        $rows[] = $child;
        if($child!=0){
            $parent = Category::where('id',$child)->select('sub_category_id')->first();
           
            $rows[] = $parent->sub_category_id;
            if($parent->count()>0){
                $next_row = Helper::get_listing_categories($parent->sub_category_id);
                $rows = array_merge($rows,$next_row);
            }

        }
        return $rows;
    }
    public static function get_sub_category($child){
        $rows = array();
        if($child!=0){
            $parent = Category::where('id',$child)->select('name','sub_category_id','id')->first();
           
            $rows[] = array('name'=>$parent->name,'id'=>$parent->id);
            if(($parent->count())>0){
                $next_row = Helper::get_sub_category($parent->sub_category_id);
                $rows = array_merge($rows,$next_row);
            }

        }

        return $rows;
    }
    public static function checkProjectSales($userid){
        $total = Income::where('agentid',$userid)->select(DB::raw('sum(totalprice) as personalsales'))->where('incometype','=','Project')->first();
        
        return $total->personalsales;
    }
}