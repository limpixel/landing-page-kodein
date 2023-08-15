<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Description;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $description = Description::where('id_lembaga',$idLembaga)->orderBy('id')->get();
        }
        return view('backend.component.description.index', compact('description'));
    }

    public function create(Request $request){
        $description = Description::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        return view('backend.component.description.create', compact(['description', 'landingPage']));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'              => 'required',
            'bgColor'              => 'required',
            'title'              => 'required',
            'description'        => 'required',
            'image'        => 'nullable|max:2048|mimes:jpg,jpeg,png',
            'position'        => 'required',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/description'), $image);
        }
        
        Description::create([
            'id_lembaga'   => $request->id_lembaga,
            'bgColor'   => $request->bgColor,
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

    public function edit($id, Request $request){
        if ($id == null) {
            return redirect()->route('backend.description')->with('error', 'The ID is empty!');
        } else {
            $description = Description::find($id);

            $domain = $request->getHttpHost();

            $landingPage = LandingPage::where('domain', $domain)->first();

            if ($description) {
                return view('backend.component.description.edit', compact(['description','landingPage']));
            } else {
                return redirect()->route('backend.description')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'image'        => 'nullable|max:2048|mimes:jpg,jpeg,png',
        ]);

        $description = Description::find($request->id);

        $image = $description->image;

        if ($request->hasFile('image')) {
            if (public_path('images/description/'. $description->image))
            unlink(public_path('images/description/'.$description->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/description'), $image);
        }

        Description::where('id', $request->id)
            ->update(([
                'id_lembaga'         => $request->id_lembaga,
                'bgColor'         => $request->bgColor,
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
