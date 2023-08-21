<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index(Request $request){
        $domain = $request->getHttpHost();

        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->lembaga_id;
            $artikel = Artikel::where('lembaga_id',$idLembaga)->orderBy('id')->get();
        }

        return view('backend.component.artikel.index', compact('artikel'));
    }


    public function create(Request $request){
        $artikel = Artikel::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        return view('backend.component.artikel.create', compact(['artikel' ,'landingPage']));
    }

    public function create_process(Request $request) {
        $request->validate([
            'status' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image' => 'required',
            'description' => 'required',
            'content' => 'required',
            'views' => 'required',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/artikel'), $image);
        }

        Artikel::create([            
            'status' => $request->status,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $image,
            'description' => $request->description,
            'content' => $request->content,
            'views' => $request->views,
        ]);

        return redirect()->route('backend.artikel')->with('success', 'Artikel Has Been Created');
    }


}
