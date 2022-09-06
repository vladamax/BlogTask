<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function upload(Request $request){

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);

        $fileUpload = new FileUpload;

        if($request->file()) {
            $file_name = time().'_'.$request->file->getClientOriginalName();
            $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');

            $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
            $fileUpload->path = '/storage/' . $file_path;
            $fileUpload->save();

            return Redirect::back()->withErrors('Successfully Edited' , 'message');


        }
    }
}
