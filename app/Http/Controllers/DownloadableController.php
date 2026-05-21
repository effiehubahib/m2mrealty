<?php

namespace App\Http\Controllers;

use App\Models\Downloadable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DownloadableController extends Controller
{
    public function index(Request $request){
        $paginate = $request->page?? 15;
        $downloadables = Downloadable::paginate($paginate);

        return view('downloadables.index',compact('downloadables'));
    }
    public function create(Request $request){

        return view('downloadables.create');
    }
    public function edit(Request $request, int $id){
        $downloadable = Downloadable::findOrFail($id);
        return view('downloadables.edit',compact('downloadable'));
    }
    public function update(Request $request, $id){
        $downloadable = Downloadable::findOrFail($id);
        if($downloadable){
            $file = $request->file('uploadfile');
            $filename = null;
            $unique_name = null;
            if ($request->hasFile('uploadfile') && $request->file('uploadfile')->isValid()) {
                    $destinationPath = storage_path('downloadables'); // upload path

                    if(!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, $mode = 0777, true, true);
                    }

                    $filename = $file->getClientOriginalName();
                    $fileExtension = $file->getClientOriginalExtension();
                    
                    $unique_name = time() . '.' . bin2hex(random_bytes(4)).'.'.$fileExtension;
                    
                    $completeURL = env('APP_URL').DIRECTORY_SEPARATOR.$destinationPath.DIRECTORY_SEPARATOR.$unique_name;
                    $file->move($destinationPath,$unique_name);
                    
                    $downloadable->uniquename = $unique_name;
                    $downloadable->filename = $filename;
                    
            } 
            $downloadable->title = $request->title;
            $downloadable->description = $request->description;
            $downloadable->save();
            return redirect()->route('downloadables.index')->with('success','Downloadable has been successfully updated.');
        }else{
             return redirect()->back()->with('warning','No downloadable found.');
        }
    }
    public function destroyFile(Request $request, $id){
        $downloadable = Downloadable::findOrFail($id);
        if($downloadable){
            $filepath = storage_path('downloadables'.DIRECTORY_SEPARATOR.$downloadable->uniquename);
                if(File::exists($filepath)){
                    File::delete($filepath);
            }
            $downloadable->uniquename=null;
            $downloadable->save();
        }
        return redirect()->back()->with('success','File successfuly deleted.');
    }
    public function store(Request $request){
        $file = $request->file('uploadfile');
        $filename = null;
        $unique_name = null;
        if ($request->hasFile('uploadfile') && $request->file('uploadfile')->isValid()) {
                $destinationPath = storage_path('downloadables'); // upload path

                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }

                $filename = $file->getClientOriginalName();
                $fileExtension = $file->getClientOriginalExtension();
                
                $unique_name = time() . '.' . bin2hex(random_bytes(4)).'.'.$fileExtension;
                
                $completeURL = env('APP_URL').DIRECTORY_SEPARATOR.$destinationPath.DIRECTORY_SEPARATOR.$unique_name;
                $file->move($destinationPath,$unique_name);
                
                $downloadable = Downloadable::create([
                        'title' => $request['title'],
                        'description' => $request['description'],
                        'uniquename' => $unique_name,
                        'filename' =>$filename,
                        'created_by'=>Auth::user()->id,
                        'status'=>1,

                ]);

                return redirect()->route('downloadables.index')->with('success','New Downloadable has been successfully created');
        }
        
         return redirect()->back()
                    ->withErrors()
                    ->withInput();

        
    }
    
    public function openFile(Request $request, string $file){
	        	$filepath = storage_path('downloadables'.DIRECTORY_SEPARATOR.$file);
	        	if(File::exists($filepath)){
	        		$extension = File::extension($filepath);
	        		if($extension=='pdf')
						return response()->download($filepath);
					else
						return response()->download(storage_path('downloadables'.DIRECTORY_SEPARATOR.$file));
				}else{
					echo "File not found!";
				}
    }
    public function destroy(Request $request, int $id)
    {
        $downloadable = Downloadable::findOrFail($id);

        $destinationPath = storage_path('downloadables'.DIRECTORY_SEPARATOR.$downloadable->unique_name); // upload path
        
        if(File::exists($destinationPath)) {
            File::delete($destinationPath);
        }
        $downloadable = Downloadable::findOrFail($id);
        $downloadable->delete();
        return redirect()->route('downloadables.index')->with('success','File successfully deleted!');
    }
}
