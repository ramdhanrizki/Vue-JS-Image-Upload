<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\FileUpload;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('page.upload.index');
    }

    public function store(Request $request)
    {
        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.'.explode('/',explode(':',substr($image,0,strpos($image,';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/').$name);
            
            $image = new FileUpload(); 
            $image->image_name = $name; 
            $image->save();
            return response()->json(['success'=>true,'message'=>'Berhasil Upload Gambar','result'=>[]],200);    
        }
    }
}
