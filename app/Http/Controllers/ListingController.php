<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListingController extends Controller
{
    protected $posts_per_page = 50;
    use HelperTrait;

    public function index(Request $request){
        $regions = DB::table('refregion')->pluck('regDesc','regCode');
        $orderby = 'id-asc';
        $sBtn = 'sBtn2';
        $categoryname = null;
        $categories = array();
        $minmonthlypayment = null;
        $maxmonthlypayment = null;
        $maxpropertyprice = null;
        $minpropertyprice = null;
        $region = null;
        $province = null;
        $city = null;

        if(!empty(Auth::user()->region_id))
            $region = Auth::user()->region_id;

        if(!empty(Auth::user()->region_id))
            $province = Auth::user()->region_id;

        if(!empty(Auth::user()->citymun_id))
            $city = Auth::user()->citymun_id;

        $listings = Listing::with(['listingphotos' => function($query) {
                        $query->where('primaryphoto', '=',1);
                    }])->leftJoin('listingadditionalinfo as la','listings.id','=','la.listingid'); 
        if(isset($_GET['searchlisting'])){
            /*$searchwords = explode(" ",$_GET['searchlisting']);
            
            $listings = $listings->where(function($quer) use($searchwords){
                foreach($searchwords as $word)
                    $quer->orWhere('title','LIKE','%'.$word.'%');
                foreach($searchwords as $word)
                    $quer->orWhere('model','LIKE','%'.$word.'%');

            });*/
             $listings = $listings->where('title','LIKE','%'.$_GET['searchlisting'].'%');
        }
        
        if(!empty($_GET['category'])){
                $category_ids = array();
                array_push($category_ids, $_GET['category']);
                $this->getProjectTree($category_ids,$_GET['category']);
                $listings = $listings->whereIn('categoryid',$category_ids);
                $cat = Category::findOrFail($_GET['category']);
                $categoryname= $cat->name;
        }else{

            $categoryname = "All";

        }

        $orderby = 'id-desc';

        if(isset($_GET['orderby'])){
            $orderby = $_GET['orderby'];
        }

        if($orderby=='name'){
            $listings = $listings->orderBy('title','ASC');
        }elseif($orderby=='id-asc'){
            $listings = $listings->orderBy('listings.id','ASC');    
        }elseif($orderby=='updated-asc'){
            $listings = $listings->orderBy('listings.updated_at','ASC');    
        }else{
            $listings = $listings->orderBy('listings.updated_at','DESC');    

        }

        if(isset($_GET['minmonthlypayment'])  && !empty($_GET['minmonthlypayment'])){
            $minmonthlypayment = $_GET['minmonthlypayment'];
            $listings =  $listings->where(DB::raw('(CASE WHEN
                                        (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        ) 



                                        <=



                                        (CASE WHEN 



                                            (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                          THEN

                                            ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                             - reservationfee)/nummonths

                                          ELSE



                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths



                                        END)



                                        &&



                                        (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        )  <=



                                        (CASE WHEN 

                                                (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                              THEN

                                                ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        )



                                THEN



                                    (CASE WHEN 

                                            (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                          THEN

                                            ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    )



                                WHEN   

                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    <=



                                    (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        ) 



                                    &&



                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    <=



                                    (CASE WHEN 

                                            (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    )

                                THEN

                                    (CASE WHEN 



                                            (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                          THEN

                                            ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                             - reservationfee)/nummonths

                                          ELSE



                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths



                                        END)



                                WHEN

                                    (CASE WHEN 

                                            (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        <=



                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    &&



                                    (CASE WHEN 

                                          (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        <=

                                    (CASE WHEN 

                                            (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                          THEN

                                            ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        

                                THEN



                                (CASE WHEN 

                                        (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                      THEN

                                        ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                         - reservationfee)/nummonths

                                      ELSE

                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths

                                    END

                                )







                                ELSE    



                                ((listings.totalprice - 

                                        (reservationfee + 

                                            (CASE WHEN paymenttype = "Percentage"  

                                            THEN listings.totalprice * (advancedpayment / 100) 

                                            ELSE  advancedpayment 

                                            END)

                                        )

                                ))/nummonths





























                                END



                            )'),'>=',$minmonthlypayment);

        }

        if(isset($_GET['maxmonthlypayment']) && !empty($_GET['maxmonthlypayment'])){

            $maxmonthlypayment = $_GET['maxmonthlypayment'];

            $listings =  $listings->where(DB::raw('(CASE WHEN

                                        (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        ) 



                                        <=



                                        (CASE WHEN 



                                            (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                          THEN

                                            ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                             - reservationfee)/nummonths

                                          ELSE



                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths



                                        END)



                                        &&



                                        (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        )  <=



                                        (CASE WHEN 

                                                (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                              THEN

                                                ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        )



                                THEN



                                    (CASE WHEN 

                                            (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                          THEN

                                            ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    )



                                WHEN   

                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    <=



                                    (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        ) 



                                    &&



                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    <=



                                    (CASE WHEN 

                                            (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    )

                                THEN

                                    (CASE WHEN 



                                            (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                          THEN

                                            ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                             - reservationfee)/nummonths

                                          ELSE



                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths



                                        END)



                                WHEN

                                    (CASE WHEN 

                                            (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        <=



                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    &&



                                    (CASE WHEN 

                                          (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        <=

                                    (CASE WHEN 

                                            (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                          THEN

                                            ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        

                                THEN



                                (CASE WHEN 

                                        (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                      THEN

                                        ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                         - reservationfee)/nummonths

                                      ELSE

                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths

                                    END

                                )







                                ELSE    



                                ((listings.totalprice - 

                                        (reservationfee + 

                                            (CASE WHEN paymenttype = "Percentage"  

                                            THEN listings.totalprice * (advancedpayment / 100) 

                                            ELSE  advancedpayment 

                                            END)

                                        )

                                ))/nummonths





























                                END



                            )'),'<=',$maxmonthlypayment);

        }

        if(isset($_GET['minpropertyprice'])  && !empty($_GET['minpropertyprice']) ){

            $minpropertyprice = $_GET['minpropertyprice'];

            $listings =  $listings->where('totalprice','>=',$minpropertyprice);

        }

        if(isset($_GET['maxpropertyprice'])  && !empty($_GET['maxpropertyprice']) ){

            $maxpropertyprice = $_GET['maxpropertyprice'];

            $listings =  $listings->where('totalprice','<=',$maxpropertyprice);

        }

        if(isset($_GET['bedroom']) && !empty($_GET['bedroom'])){

            if($_GET['bedroom']==3)

                $listings =  $listings->where('bedroom','>=',3);

            else

                $listings =  $listings->where('bedroom','=',$_GET['bedroom']);

        }

        if(isset($_GET['bathroom']) && !empty($_GET['bathroom'])){

            if($_GET['bathroom']==3)

                $listings =  $listings->where('bathroom','>=',3);

            else

                $listings =  $listings->where('bathroom','=',$_GET['bathroom']);

        }

        if(isset($_GET['garage']) && !empty($_GET['garage'])){

            if($_GET['garage']==3)

                $listings =  $listings->where('garage','>=',3);

            else

                $listings =  $listings->where('garage','=',$_GET['garage']);

        }

        

        if(isset($_GET['region']) && !empty($_GET['region']) ){

            $region = $_GET['region'];

            $listings =  $listings->where('region','=',$region);

        }

        if(isset($_GET['province'])&& $_GET['province']!=0){

            $province = $_GET['province'];

            $listings =  $listings->where('province','=',$province);

        }

        if(isset($_GET['city'])&& $_GET['city']!=0){

            $city = $_GET['city'];  

            $listings =  $listings->where('city','=',$city);

        }

        if(isset($_GET['propertystatus']) && !empty($_GET['propertystatus']) ){

            $propertystatus = $_GET['propertystatus'];

            $listings =  $listings->where('propertystatus','=',$propertystatus);

        }

        if(isset($_GET['recommended'])&& $_GET['recommended']=='yes'){

            $listings = $listings->has('recommendlisting');

            $categoryname = "Recommended Listings";

        }

        if(isset($_GET['mylisting'])&& $_GET['mylisting']=='1'){

            $listings = $listings->where('createdby',Auth::user()->id);

            $categoryname = "My Brokerage Listings";

        }





        $listings = $listings->select('la.*','listings.*',

                    DB::raw('(CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) AS eq_bank'), //bank equity

                     DB::raw('(

                                CASE WHEN reservationfee>0 THEN

                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) 

                                ELSE

                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                END

                        ) AS balance_b'), //bank balance



                    DB::raw('(CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) AS eq_pagibig'), //pagibig equity

                    DB::raw('(

                                CASE WHEN reservationfee>0 THEN

                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) 

                                ELSE

                                    (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                END

                        ) AS balance_p'), //pagibig balance



                    DB::raw('(CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) AS eq_inhouse'),//inhouse equity

                    DB::raw('(

                                CASE WHEN reservationfee>0 THEN

                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) 

                                ELSE

                                    (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                END

                        ) AS balance_i'), //pagibig balance

                    DB::raw('(listings.totalprice - 

                                (reservationfee + 

                                    (CASE WHEN paymenttype = "Percentage"  

                                    THEN listings.totalprice * (advancedpayment / 100) 

                                    ELSE  advancedpayment 

                                    END)

                                )

                        ) AS balance_s'), //straight balance

                    DB::raw('(CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END) AS adv_pay'), //advanced payment

                    DB::raw('(CASE WHEN 



                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                              THEN

                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                 - reservationfee)/nummonths

                              ELSE



                              (

                                (

                                CASE WHEN reservationfee>0 THEN

                                    (

                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                    ) 

                                ELSE

                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                END

                                ) - reservationfee

                              ) / nummonths



                            END

                        ) AS bank_amort'), //bank amortization

                    DB::raw('(CASE WHEN 



                                (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                              THEN

                                ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                 - reservationfee)/nummonths

                              ELSE



                              (

                                (

                                CASE WHEN reservationfee>0 THEN

                                    (

                                        ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                    ) 

                                ELSE

                                    (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                END

                                ) - reservationfee

                              ) / nummonths



                            END

                        ) AS pagibig_amort'), //pagibig amortization

                        DB::raw('(CASE WHEN 



                                (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                              THEN

                                ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                 - reservationfee)/nummonths

                              ELSE



                              (

                                (

                                CASE WHEN reservationfee>0 THEN

                                    (

                                        ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                    ) 

                                ELSE

                                    (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                END

                                ) - reservationfee

                              ) / nummonths



                            END

                        ) AS inhouse_amort'), //inhouse amortization

                        DB::raw('((listings.totalprice - 

                                (reservationfee + 

                                    (CASE WHEN paymenttype = "Percentage"  

                                    THEN listings.totalprice * (advancedpayment / 100) 

                                    ELSE  advancedpayment 

                                    END)

                                )

                        ))/nummonths AS monthly_s'), //straight monthly

                        DB::raw('(CASE WHEN

                                        (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        ) 



                                        <=



                                        (CASE WHEN 



                                            (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                          THEN

                                            ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                             - reservationfee)/nummonths

                                          ELSE



                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths



                                        END)



                                        &&



                                        (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        )  <=



                                        (CASE WHEN 

                                                (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                              THEN

                                                ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        )



                                THEN



                                    (CASE WHEN 

                                            (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                          THEN

                                            ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    )



                                WHEN   

                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    <=



                                    (CASE WHEN 

                                                (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                              THEN

                                                ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                                 - reservationfee)/nummonths

                                              ELSE

                                              (

                                                (

                                                CASE WHEN reservationfee>0 THEN

                                                    (

                                                        ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                    ) 

                                                ELSE

                                                    (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                                END

                                                ) - reservationfee

                                              ) / nummonths

                                            END

                                        ) 



                                    &&



                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    <=



                                    (CASE WHEN 

                                            (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    )

                                THEN

                                    (CASE WHEN 



                                            (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                          THEN

                                            ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                             - reservationfee)/nummonths

                                          ELSE



                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths



                                        END)



                                WHEN

                                    (CASE WHEN 

                                            (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        <=



                                    (CASE WHEN 

                                        (CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) > 0

                                      THEN

                                        ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END)

                                         - reservationfee)/nummonths

                                      ELSE



                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths



                                    END)



                                    &&



                                    (CASE WHEN 

                                          (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                          THEN

                                            ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        <=

                                    (CASE WHEN 

                                            (CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) > 0

                                          THEN

                                            ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END)

                                             - reservationfee)/nummonths

                                          ELSE

                                          (

                                            (

                                            CASE WHEN reservationfee>0 THEN

                                                (

                                                    ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                                ) 

                                            ELSE

                                                (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                            END

                                            ) - reservationfee

                                          ) / nummonths

                                        END

                                    ) 

                                        

                                THEN



                                (CASE WHEN 

                                        (CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) > 0

                                      THEN

                                        ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END)

                                         - reservationfee)/nummonths

                                      ELSE

                                      (

                                        (

                                        CASE WHEN reservationfee>0 THEN

                                            (

                                                ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) - reservationfee

                                            ) 

                                        ELSE

                                            (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                                        END

                                        ) - reservationfee

                                      ) / nummonths

                                    END

                                )







                                ELSE    



                                ((listings.totalprice - 

                                        (reservationfee + 

                                            (CASE WHEN paymenttype = "Percentage"  

                                            THEN listings.totalprice * (advancedpayment / 100) 

                                            ELSE  advancedpayment 

                                            END)

                                        )

                                ))/nummonths











                                END



                            ) AS minimum_amort')

                );

        //echo $listings->get();exit;
        $listings = $listings->paginate($this->posts_per_page);

        $categoriesChoice = Category::with('children')->where('sub_category_id',0)->get();

        if(isset($_GET['sBtn'])){
            $sBtn = $_GET['sBtn'];
        }


        $form_value = $request->all();

        return view('listings.index',['listings'=>$listings,'orderby'=>$orderby,'categoryname'=>$categoryname,'regions'=>$regions,'province'=>$province,'city'=>$city,
            'minmonthlypayment' =>$minmonthlypayment, 'maxmonthlypayment'=>$maxmonthlypayment,'minpropertyprice'=>$minpropertyprice, 'maxpropertyprice'=>$maxpropertyprice,
            'region'=>$region,'categoriesChoice'=>$categoriesChoice,'sBtn'=>$sBtn]);
    }
    public function edit(Request $request, $id){

    }
}
