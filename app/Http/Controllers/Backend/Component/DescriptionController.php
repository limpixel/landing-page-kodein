<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $description = Description::get();
        return view('backend.component.description.index', compact('description'));
    }

    public function create(){
        $description = Description::get();
        return view('backend.component.description.create', compact('description'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'title'              => 'required',
            'description'        => 'required',
            'position'        => 'required',
        ]);

        if (Description::find('image') != null) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/description'), $image);
        } else {
            $image = null;
        }
        
       

        Description::create([
            'title'   => $request->title,
            'description'   => $request->description,
            'link'   => $request->link,
            'image'   => $image,
            'video'   => $request->video,
            'position'   => $request->position,
        ]);
            // return $request;
        return redirect()->route('backend.description')->with('success', 'Item Created Successfully');
    }

    public function edit($id){
        if ($id == null) {
            return redirect()->route('backend.description')->with('error', 'The ID is empty!');
        } else {
            $description = Description::find($id);

            if ($description) {
                return view('backend.component.description.edit', compact('description'));
            } else {
                return redirect()->route('backend.description')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'title'         => 'required',
            'description'         => 'required',
            'image'         => 'max:2048|mimes:jpg,jpeg,png',
            'position'         => 'required',
        ]);

        $description = Description::find($request->id);

        if (Description::find('image') != null) {
            if (public_path('images/description/'. $description->image))
            unlink(public_path('images/description/'.$description->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/description'), $image);
        } else {
            $image = null;
        }
       

        Description::where('id', $request->id)
            ->update(([
                'title'         => $request->title,
                'description'   => $request->description,
                'link'   => $request->link,
                'image' => $image,
                'video'         => $request->video,
                'position'         => $request->position,
            ]));

        return redirect()->route('backend.description')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $description = Description::find($id);

        $description->delete();

        return redirect()->route('backend.description')->with('success', 'Item Deleted Successfully');
    }
}
