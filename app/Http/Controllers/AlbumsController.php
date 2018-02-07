<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Albums;

class AlbumsController extends Controller
{
    public function index(){
				$albums = Albums::with('Photos')->get();
        return view('albums.index')->with('albums', $albums);
    }

    public function create(){
        return view('albums.create');
		}
		
		
	private function generateFile($request){
			// Get file name with extension
			$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
			// Get just file name
			$fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
			// Get extension of the file
			$extension = $request->file('cover_image')->getClientOriginalExtension();
			// Create new fileName
			$fileNameToStore = $fileName.'_'.time().'.'.$extension;
			// Upload Image
			$path = $request->file('cover_image')->storeAs('public/album_covers', $fileNameToStore);

			return $fileNameToStore;
	}

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999'
        ]);
				// Create album
				$album = new Albums;
				$album->name = $request->input('name');
				$album->description = $request->input('description');
				$album->cover_image = self::generateFile($request);

				$album->save();

				return redirect('/albums')->with('success', 'Album Created');
	}
	
	public function show($id){
		$album = Albums::with('Photos')->find($id);
		return view('albums.show')->with('album',$album);
	}
}
