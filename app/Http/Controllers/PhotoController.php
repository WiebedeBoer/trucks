<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Photo;

class PhotoController extends Controller
{
	//index 
    public function index()
    {            	
        $photos = Photo::paginate(50);  
        return view('photo.index', compact('photos'));    
    }
	  
    //show
    public function show($id)
    { 
        $photo = Photo::with('trucks')->where('photo_id', $id)->firstOrFail(); 
        return view('photo.show', compact('photo'));
    }

	//edit
    public function edit($id)
    {  
        $photo = Photo::with('trucks')->where('photo_id', $id)->firstOrFail();  
        return view('photo.edit', compact('photo','categories'));
    }

	//create
    public function create()
    {  
        $photo = new Photo();        
        return view('photo.create', compact('photo','categories'));
    }

	//update function
    public function update(Request $request, $id)
    {  
        $data = request()->validate([
            'photo_name' => 'required|min:2',
            'photo_url' => 'nullable|url',
            'description' => 'nullable'
        ]);
        Photo::where('photo_id',$id)->update($data);
        return redirect('/photo')->with('message', 'Succesvol gewijzigd');
    }

    //store function
    public function store()
    {
        $data = request()->validate([
            'photo_name' => 'required|min:2',
            'photo_url' => 'nullable|url',
            'description' => 'nullable'
        ]);
        $photo = new Photo();       
        $photo->photo_name = request('photo_name');
        $photo->photo_url = request('photo_url');
        $photo->description = request('description');
        $photo->save(); 
        //return
        return redirect('/photo')->with('message', 'Succesvol ingevoerd ');
    }

	//delete function
    public function destroy($id)
    {  
        //delete
        $photo = Photo::findOrFail($id);
        $photo->delete();
        //return
        return redirect('/photo')->with('message', 'Succesvol verwijderd');
    }
}
