<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class BiayaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $biaya = Biaya::where('id_lembaga',$idLembaga)->get();
        }
        return view('backend.component.biaya.index', compact('biaya'));
    }

    public function create(Request $request){
        $biaya = Biaya::get();
        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.biaya.create', compact(['biaya','landingPage']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lembaga' => 'required',
            'image1' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image2' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image3' => 'required|max:2048|mimes:jpg,jpeg,png',
            'image4' => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);

        $image1 = time() . '_1.' . $request->file('image1')->extension();
        $image2 = time() . '_2.' . $request->file('image2')->extension();
        $image3 = time() . '_3.' . $request->file('image3')->extension();
        $image4 = time() . '_4.' . $request->file('image4')->extension();

        $request->file('image1')->move(public_path('images/biaya'), $image1);
        $request->file('image2')->move(public_path('images/biaya'), $image2);
        $request->file('image3')->move(public_path('images/biaya'), $image3);
        $request->file('image4')->move(public_path('images/biaya'), $image4);

        Biaya::create([
            'id_lembaga' => $request->id_lembaga,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
        ]);

        return redirect()->route('backend.biaya')->with('success', 'Item Created Successfully');
    }


    public function edit($id, Request $request){
        $biaya = Biaya::find($id);

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        if ($biaya) {
            return view('backend.component.biaya.edit', compact(['biaya','landingPage']));
        } else {
            return redirect()->route('backend.biaya')->with('error', "The #ID {$id} not found in Database!");
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
        ]);
    
        $biaya = Biaya::find($request->id);
    
        $image1 = time() . '_1.' . $request->file('image1')->extension();
        $image2 = time() . '_2.' . $request->file('image2')->extension();
        $image3 = time() . '_3.' . $request->file('image3')->extension();
        $image4 = time() . '_4.' . $request->file('image4')->extension();
    
        $request->file('image1')->move(public_path('images/biaya'), $image1);
        $request->file('image2')->move(public_path('images/biaya'), $image2);
        $request->file('image3')->move(public_path('images/biaya'), $image3);
        $request->file('image4')->move(public_path('images/biaya'), $image4);
    
        $biaya->update([
            'id_lembaga' => $request->id_lembaga,
            'image1' => $image1,
            'image2' => $image2,
            'image3' => $image3,
            'image4' => $image4,
        ]);
    
        return redirect()->route('backend.biaya')->with('success', 'Item Updated Successfully');
    }


    public function destroy($id){

        $biaya = Biaya::find($id);

        $biaya->delete(); 

        return redirect()->route('backend.biaya')->with('success', 'Item Deleted Successfully');
    }
}
