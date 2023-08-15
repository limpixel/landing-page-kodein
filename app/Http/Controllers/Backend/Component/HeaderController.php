<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Header;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class HeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        $landingPage = LandingPage::where('domain', $domain)->first();
        $idLembaga = $landingPage->id_lembaga;
        $header = Header::where('id_lembaga',$idLembaga)->get();
    
        return view('backend.component.header.index', compact('header'));
    }

    public function create(Request $request){
        $header = Header::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.header.create', compact(['header','landingPage']));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'         => 'required',
            'buttonText'              => 'required',
            'buttonLink'              => 'required',
        ]);
        
        Header::create([
            'id_lembaga'   => $request->id_lembaga,
            'buttonText'   => $request->buttonText,
            'buttonLink'   => $request->buttonLink,
        ]);
            // return $request;
        return redirect()->route('backend.header')->with('success', 'Item Created Successfully');
    }

    public function edit($id, Request $request){
        $header = Header::find($id);

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
    
        if ($header) {
            return view('backend.component.header.edit', compact(['header','landingPage']));
        } else {
            return redirect()->route('backend.header')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        request()->validate([
            'id_lembaga'         => 'required',
            'buttonText'              => 'required',
            'buttonLink'              => 'required',
        ]);

        Header::where('id', $request->id)
            ->update(([
                'id_lembaga'         => $request->id_lembaga,
                'buttonText'   => $request->buttonText,
                'buttonLink'   => $request->buttonLink,
            ]));

        return redirect()->route('backend.header')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $header = Header::find($id);

        $header->delete();

        return redirect()->route('backend.header')->with('success', 'Item Deleted Successfully');
    }
}
