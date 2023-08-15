<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Galery;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $galery = Galery::where('id_lembaga',$idLembaga)->get();
        }
        return view('backend.component.galery.index', compact('galery'));
    }

    public function create(Request $request){
        $galery = Galery::get();
        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.galery.create', compact(['galery','landingPage']));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'              => 'required',
            'image'         => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/galery'), $image);

        Galery::create([
            'id_lembaga'   => $request->id_lembaga,
            'image'   => $image,
        ]);
            // return $request;
        return redirect()->route('backend.galery')->with('success', 'Item Created Successfully');
    }

    public function edit($id, Request $request){
        $galery = Galery::find($id);

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        if ($galery) {
            return view('backend.component.galery.edit', compact(['galery','landingPage']));
        } else {
            return redirect()->route('backend.galery')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'id_lembaga'         => 'required',
            'image'         => 'nullable|max:2048|mimes:jpg,jpeg,png',
        ]);

        $galery = Galery::find($request->id);

        $image = $galery->image;

        if ($request->hasFile('image')) {
            if (public_path('images/galery/'. $galery->image))
            unlink(public_path('images/galery/'.$galery->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/galery'), $image);
        }
       
        Galery::where('id', $request->id)
            ->update(([
                'id_lembaga'         => $request->id_lembaga,
                'image' => $image,
            ]));

        return redirect()->route('backend.galery')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $galery = Galery::find($id);

        $galery->delete(); 

        return redirect()->route('backend.galery')->with('success', 'Item Deleted Successfully');
    }
}
