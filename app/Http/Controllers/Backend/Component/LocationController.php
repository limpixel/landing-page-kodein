<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $location = Location::where('id_lembaga',$idLembaga)->get();
        }
        return view('backend.component.location.index', compact('location'));
    }

    public function create(Request $request){
        $location = Location::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.location.create', compact(['location','landingPage']));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'         => 'required',
            'map'              => 'required',
            'description'              => 'required',
            'image1'         => 'nullable|max:2048|mimes:jpg,jpeg,png',
            'image2'         => 'nullable|max:2048|mimes:jpg,jpeg,png',
            'image3'         => 'nullable|max:2048|mimes:jpg,jpeg,png',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/map'), $image);
        }
        
        Location::create([
            'id_lembaga'   => $request->id_lembaga,
            'map'   => $request->map,
            'description'   => $request->description,
            'buttonText1'   => $request->buttonText1,
            'buttonLink1'   => $request->buttonLink1,
            'buttonText2'   => $request->buttonText2,
            'buttonLink2'   => $request->buttonLink2,
            'image1'   => $image,
            'image2'   => $image,
            'image3'   => $image,
        ]);
            // return $request;
        return redirect()->route('backend.location')->with('success', 'Item Created Successfully');
    }

    public function edit($id){
        $location = Location::find($id);
    
        if ($location) {
            return view('backend.component.location.edit', compact('location'));
        } else {
            return redirect()->route('backend.location')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'id_lembaga'         => 'required',
            'title'         => 'required',
            'image'         => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);

        $location = Location::find($request->id);

        $image1 = $location->image1;
        $image2 = $location->image2;
        $image3 = $location->image3;

        if ($request->hasFile('image')) {
            if (public_path('images/map/'. $location->image1))
            unlink(public_path('images/map/'.$location->image1));
            $image1 = time() . '.' . $request->image1->extension();
            $request->image1->move(public_path('images/map'), $image1);

            if (public_path('images/map/'. $location->image2))
            unlink(public_path('images/map/'.$location->image2));
            $image2 = time() . '.' . $request->image2->extension();
            $request->image2->move(public_path('images/map'), $image2);

            if (public_path('images/map/'. $location->image3))
            unlink(public_path('images/map/'.$location->image3));
            $image3 = time() . '.' . $request->image3->extension();
            $request->image3->move(public_path('images/map'), $image3);
        }

        Location::where('id', $request->id)
            ->update(([
                'id_lembaga'         => $request->id_lembaga,
                'title'         => $request->title,
                'buttonText1'   => $request->buttonText1,
                'buttonLink1'   => $request->buttonLink1,
                'buttonText2'   => $request->buttonText2,
                'buttonLink2'   => $request->buttonLink2,
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3,
            ]));

        return redirect()->route('backend.location')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $location = Location::find($id);

        $location->delete();

        return redirect()->route('backend.location')->with('success', 'Item Deleted Successfully');
    }
}
