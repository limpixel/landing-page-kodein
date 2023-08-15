<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $testimony = Testimony::where('id_lembaga',$idLembaga)->get();
        }
        return view('backend.component.testimony.index', compact('testimony'));
    }

    public function create(Request $request){
        $testimony = Testimony::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.testimony.create', compact(['testimony','landingPage']));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'              => 'required',
            'image'        => 'required|max:2048|mimes:jpg,jpeg,png',
            'name'              => 'required',
            'description'              => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/testimoni'), $image);
        }

        Testimony::create([
            'id_lembaga'   => $request->id_lembaga,
            'image'   => $image,
            'name'   => $request->name,
            'description'   => $request->description,
        ]);
            // return $request;
        return redirect()->route('backend.testimony')->with('success', 'Item Created Successfully');
    }

    public function edit($id, Request $request){
        $testimony = Testimony::find($id);

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        if ($testimony) {
            return view('backend.component.testimony.edit', compact(['testimony','landingPage']));
        } else {
            return redirect()->route('backend.testimony')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'id_lembaga'         => 'required',
            'image'        => 'nullable|max:2048|mimes:jpg,jpeg,png',
            'name'         => 'required',
            'description'         => 'required',
        ]);

        $testimony = Testimony::find($request->id);

        $image = $testimony->image;

        if ($request->hasFile('image')) {
            if (public_path('images/testimony/'. $testimony->image))
            unlink(public_path('images/testimony/'.$testimony->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/testimony'), $image);
        }

        Testimony::where('id', $request->id)
            ->update(([
                'id_lembaga'         => $request->id_lembaga,
                'image' => $image,
                'name'         => $request->name,
                'description'         => $request->description,
            ]));

        return redirect()->route('backend.testimony')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $testimony = Testimony::find($id);

        $testimony->delete();

        return redirect()->route('backend.testimony')->with('success', 'Item Deleted Successfully');
    }
}
