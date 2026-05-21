<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index(Request $request){
        $paginate = $request->get('paginate', 50);
        $developers = Developer::paginate($paginate);

        return view('developers.index',compact('developers'));
    }
    public function create(Request $request){

        return view('developers.create');
    }
    public function edit(Request $request, int $id){
        $developer = Developer::findOrFail($id);
        return view('developers.edit',compact('developer'));
    }
    public function update(Request $request, $id){
        $developer = Developer::findOrFail($id);
        if($developer){
            $file = $request->file('uploadfile');
            $filename = null;
            $unique_name = null;
            if ($request->hasFile('uploadfile') && $request->file('uploadfile')->isValid()) {
                    $destinationPath = storage_path('developers'); // upload path

                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }

                    $filename = $file->getClientOriginalName();
                    $fileExtension = $file->getClientOriginalExtension();
                    
                    $unique_name = time() . '.' . bin2hex(random_bytes(4)).'.'.$fileExtension;
                    
                    $completeURL = env('APP_URL').DIRECTORY_SEPARATOR.$destinationPath.DIRECTORY_SEPARATOR.$unique_name;
                    $file->move($destinationPath,$unique_name);
                    
                    $developer->uniquename = $unique_name;
                    $developer->filename = $filename;
                    
            } 
            $developer->title = $request->title;
            $developer->description = $request->description;
            $developer->save();
            return redirect()->route('developers.index')->with('success','Downloadable has been successfully updated.');
        }else{
             return redirect()->back()->with('warning','No developer found.');
        }
    }
    public function destroyFile(Request $request, $id){
        $developer = Downloadable::findOrFail($id);
        if($developer){
            $filepath = storage_path('developers'.DIRECTORY_SEPARATOR.$developer->uniquename);
                if(File::exists($filepath)){
                    File::delete($filepath);
            }
            $developer->uniquename=null;
            $developer->save();
        }
        return redirect()->back()->with('success','File successfuly deleted.');
    }
}
