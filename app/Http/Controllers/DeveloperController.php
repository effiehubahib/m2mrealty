<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    public function index(Request $request)
    {
        $paginate = $request->get('paginate', 50);
        $developers = Developer::paginate($paginate);

        return view('developers.index', compact('developers'));
    }

    public function create(Request $request)
    {

        return view('developers.create');
    }

    public function edit(Request $request, int $id)
    {
        $developer = Developer::findOrFail($id);

        return view('developers.edit', compact('developer'));
    }

    public function update(Request $request, $id)
    {
        $developer = Developer::findOrFail($id);
        if ($developer) {
            $file = $request->file('uploadfile');
            $filename = null;
            $unique_name = null;
            if ($request->hasFile('uploadfile') && $request->file('uploadfile')->isValid()) {
                $destinationPath = storage_path('developers'); // upload path

                if (! File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }

                $filename = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();

                $unique_name = time().'.'.bin2hex(random_bytes(4)).'.'.$fileExtension;

                $completeURL = env('APP_URL').DIRECTORY_SEPARATOR.$destinationPath.DIRECTORY_SEPARATOR.$unique_name;
                $file->move($destinationPath, $unique_name);

                $developer->uniquename = $unique_name;
                $developer->filename = $filename;

            }
            $developer->title = $request->title;
            $developer->description = $request->description;
            $developer->save();

            return redirect()->route('developers.index')->with('success', 'Downloadable has been successfully updated.');
        } else {
            return redirect()->back()->with('warning', 'No developer found.');
        }
    }

    public function destroyFile(Request $request, $id)
    {
        $developer = Downloadable::findOrFail($id);
        if ($developer) {
            $filepath = storage_path('developers'.DIRECTORY_SEPARATOR.$developer->uniquename);
            if (File::exists($filepath)) {
                File::delete($filepath);
            }
            $developer->uniquename = null;
            $developer->save();
        }

        return redirect()->back()->with('success', 'File successfuly deleted.');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'developername' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'facebooklink' => 'nullable|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'contactperson' => 'nullable|string|max:255',
            'contactnumber' => 'nullable|string|max:50',
            'mobilenumber' => 'nullable|string|max:50',
            'telephonenumber' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'status' => 'nullable|in:0,1',
        ]);

        $fileName = null;
        if ($request->hasFile('logo')) {
            $uploadDir = public_path('uploads/images/developers');
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $ext = $request->file('logo')->getClientOriginalExtension();
            $fileName = uniqid('dev_', true).'.'.$ext;
            $request->file('logo')->move($uploadDir, $fileName);
        }

        Developer::create([
            'developername' => $request->developername,
            'website' => $request->website,
            'facebooklink' => $request->facebooklink,
            'contactperson' => $request->contactperson,
            'contactnumber' => $request->contactnumber,
            'mobilenumber' => $request->mobilenumber,
            'telephonenumber' => $request->telephonenumber,
            'email' => $request->email,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'status' => $request->input('status', 0),
            'address' => $request->address,
            'logo' => $fileName,
            'createdby' => Auth::id(),
        ]);

        return redirect()->route('developers.index')->with('success', 'New developer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function dontUpdate($id)
    {
        $updatedeveloper = UpdateDeveloper::find($id);
        $updatedeveloper->delete();

        return redirect()->route('developer.index')->with('success', 'Developer update is cancelled');
    }

    public function show($id)
    {
        $developer = Developer::with('listings')->findOrFail($id);
        $listings = Listing::with(['listingphotos' => function ($query) {

            $query->where('primaryphoto', '=', 1);

        }])->leftJoin('listingadditionalinfo as la', 'listings.id', '=', 'la.listingid');

        $listings = $listings->where('developerid', $developer->id);

        $listings = $listings->select('la.*', 'listings.*',

            DB::raw('(CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) AS eq_bank'), // bank equity

            DB::raw('(

                        CASE WHEN reservationfee>0 THEN

                            ((listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) 

                        ELSE

                            (listings.totalprice - ((CASE WHEN equitytypebank = "Percentage" THEN listings.totalprice * (equitybank / 100) ELSE  equitybank END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                        END

                ) AS balance_b'), // bank balance

            DB::raw('(CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) AS eq_pagibig'), // pagibig equity

            DB::raw('(

                        CASE WHEN reservationfee>0 THEN

                            ((listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) 

                        ELSE

                            (listings.totalprice - ((CASE WHEN equitytypepagibig = "Percentage" THEN listings.totalprice * (equitypagibig / 100) ELSE  equitypagibig END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                        END

                ) AS balance_p'), // pagibig balance

            DB::raw('(CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) AS eq_inhouse'),// inhouse equity

            DB::raw('(

                        CASE WHEN reservationfee>0 THEN

                            ((listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))) 

                        ELSE

                            (listings.totalprice - ((CASE WHEN equitytypeinhouse = "Percentage" THEN listings.totalprice * (equityinhouse / 100) ELSE  equityinhouse END) + (CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END)))

                        END

                ) AS balance_i'), // pagibig balance

            DB::raw('(listings.totalprice - 

                        (reservationfee + 

                            (CASE WHEN paymenttype = "Percentage"  

                            THEN listings.totalprice * (advancedpayment / 100) 

                            ELSE  advancedpayment 

                            END)

                        )

                ) AS balance_s'), // straight balance

            DB::raw('(CASE WHEN paymenttype = "Percentage" THEN listings.totalprice * (advancedpayment / 100) ELSE  advancedpayment END) AS adv_pay'), // advanced payment

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

                ) AS bank_amort'), // bank amortization

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

                ) AS pagibig_amort'), // pagibig amortization

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

                ) AS inhouse_amort'), // inhouse amortization

            DB::raw('((listings.totalprice - 

                        (reservationfee + 

                            (CASE WHEN paymenttype = "Percentage"  

                            THEN listings.totalprice * (advancedpayment / 100) 

                            ELSE  advancedpayment 

                            END)

                        )

                ))/nummonths AS monthly_s'), // straight monthly

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

        )->get();

        return view('developer.show', compact('developer','listings'));
    }
}
