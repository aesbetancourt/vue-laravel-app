<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileEntry;
use Illuminate\Support\Facades\Input;
use Storage; 
use File;
use Auth;

class FileEntriesController extends Controller
{
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

    public function index() {
        $files = FileEntry::all();

        $user = Auth::id();
        
        return view('files.index', compact('files','user'));
    }

    public function getFiles() {
        $files = FileEntry::all();
        return $files;
    }

    public function getIdUse(){
        $user = Auth::id();
        return $user;
    }

    public function create() {
        return view('files.create');
    }

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
}
