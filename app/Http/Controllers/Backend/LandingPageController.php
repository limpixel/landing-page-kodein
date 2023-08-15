<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $landingPage = LandingPage::where('id_lembaga',$idLembaga)->orderBy('id')->get();
        }
        return view('backend.management.landing.index', compact('landingPage'));
    }

    public function create(){
        $landingPage = LandingPage::get();
        return view('backend.management.landing.create', compact('landingPage'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'              => 'required',
            'domain'              => 'required',
        ]);
        
        LandingPage::create([
            'id_lembaga'   => $request->id_lembaga,
            'domain'   => $request->domain,
            'whatsapp'   => $request->whatsapp,
            'instagram'   => $request->instagram,
            'facebook'   => $request->facebook,
            'youtube'   => $request->youtube,
        ]);
            // return $request;
        return redirect()->route('backend.lembaga')->with('success', 'Item Created Successfully');
    }

    public function edit($id, Request $request){
        $landingPage = LandingPage::find($id);
        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
    
        if ($landingPage) {
            return view('backend.management.landing.edit', compact('landingPage', 'domain'));
        } else {
            return redirect()->route('backend.landing')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'logo'        => 'nullable|max:2048|mimes:jpg,jpeg,png',
        ]);

        $landingPage = LandingPage::find($request->id);

        $logo = $landingPage->logo;

        if ($request->hasFile('logo')) {
            if ($landingPage->logo && file_exists(public_path('images/logo/'. $landingPage->logo))) {
                unlink(public_path('images/logo/'.$landingPage->logo));
            }
    
            $logo = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/logo'), $logo);
        } else {
            $logo = $landingPage->logo;
        }

        LandingPage::where('id', $request->id)
            ->update(([
                'id_lembaga'   => $request->id_lembaga,
                'domain'   => $request->domain,
                'logo'   => $logo,
                'whatsapp'   => $request->whatsapp,
                'instagram'   => $request->instagram,
                'facebook'   => $request->facebook,
                'youtube'   => $request->youtube,
            ]));

        return redirect()->route('backend.landing')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $landingPage = LandingPage::find($id);

        $landingPage->delete();

        return redirect()->route('backend.landing')->with('success', 'Item Deleted Successfully');
    }
}
