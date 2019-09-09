<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileEntry;
use Illuminate\Support\Facades\Input;
use Storage; 
use File;
use Auth;
use Response;

class FileEntriesController extends Controller
{
    //Function to upload the data of file and create a local storage
    public function uploadFil(Request $request){
        $file = Input::file('file');
        $filename = $file->getClientOriginalName();

        $path = hash( 'sha256', time());

        if(Storage::disk('uploads')->put($path.'/'.$filename,  File::get($file))) {
            $input['filename'] = $filename;
            $input['mime'] = $file->getClientMimeType();
            $input['path'] = $path;
            $input['size'] = $file->getClientSize();
            $input['user_id'] = Auth::id();
            $file = FileEntry::create($input);

            return response()->json([
                'success' => true,
                'id' => $file->id
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);
    }



    //function to get the files
    public function getFiles() {
        $files = FileEntry::all();
        return $files;
    }

    //Function to het the id of the actual user
    public function getIdUse(){
        $user = Auth::id();
        return $user;
    }


    //function to eliminate the files
    public function destroy($id, $path)
    {
        $file = FileEntry::findOrFail($id);

        if (Storage::disk('uploads')->exists('/' .$path ."/" . $file->filename)) {
            if (Storage::disk('uploads')->delete('/' .$path ."/" . $file->filename)) {
                return response()->json($file->delete());
            }
        }

        return response()->json(false);
    }

    //Function to download the files
    public function download($path, $file) {
        $path = storage_path().'/files/uploads/'.$path.'/'.$file;
        if(file_exists($path)) {
            return Response::download($path);
        }
    }
}
