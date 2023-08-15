<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Keunggulan;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class KeunggulanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $keunggulan = Keunggulan::where('id_lembaga',$idLembaga)->get();
        }
        return view('backend.component.keunggulan.index', compact('keunggulan'));
    }

    public function create(Request $request){
        $keunggulan = Keunggulan::get();
        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.keunggulan.create', compact(['keunggulan','landingPage']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lembaga' => 'required',
            'image1' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image2' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image3' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image4' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image5' => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);

        $image1 = time() . '_1.' . $request->file('image1')->extension();
        $image2 = time() . '_2.' . $request->file('image2')->extension();
        $image3 = time() . '_3.' . $request->file('image3')->extension();
        $image4 = time() . '_4.' . $request->file('image4')->extension();
        $image5 = time() . '_5.' . $request->file('image5')->extension();

        $request->file('image1')->move(public_path('images/keunggulan'), $image1);
        $request->file('image2')->move(public_path('images/keunggulan'), $image2);
        $request->file('image3')->move(public_path('images/keunggulan'), $image3);
        $request->file('image4')->move(public_path('images/keunggulan'), $image4);
        $request->file('image5')->move(public_path('images/keunggulan'), $image5);

        Keunggulan::create([
            'id_lembaga' => $request->id_lembaga,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
        ]);

        return redirect()->route('backend.keunggulan')->with('success', 'Item Created Successfully');
    }


    public function edit($id, Request $request){
        $keunggulan = Keunggulan::find($id);

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        if ($keunggulan) {
            return view('backend.component.keunggulan.edit', compact(['keunggulan','landingPage']));
        } else {
            return redirect()->route('backend.keunggulan')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request)
    {
        $request->validate([
            'id_lembaga' => 'required',
            'image1' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image2' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image3' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image4' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image5' => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);
    
        $keunggulan = Keunggulan::find($request->id);
    
        $image1 = time() . '_1.' . $request->file('image1')->extension();
        $image2 = time() . '_2.' . $request->file('image2')->extension();
        $image3 = time() . '_3.' . $request->file('image3')->extension();
        $image4 = time() . '_4.' . $request->file('image4')->extension();
        $image5 = time() . '_5.' . $request->file('image5')->extension();
    
        $request->file('image1')->move(public_path('images/keunggulan'), $image1);
        $request->file('image2')->move(public_path('images/keunggulan'), $image2);
        $request->file('image3')->move(public_path('images/keunggulan'), $image3);
        $request->file('image4')->move(public_path('images/keunggulan'), $image4);
        $request->file('image5')->move(public_path('images/keunggulan'), $image5);
    
        $keunggulan->update([
            'id_lembaga' => $request->id_lembaga,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
            'image5' => $image5,
        ]);
    
        return redirect()->route('backend.keunggulan')->with('success', 'Item Updated Successfully');
    }


    public function destroy($id){

        $keunggulan = Keunggulan::find($id);

        $keunggulan->delete(); 

        return redirect()->route('backend.keunggulan')->with('success', 'Item Deleted Successfully');
    }
}
