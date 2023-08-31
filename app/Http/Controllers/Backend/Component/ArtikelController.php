<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Categories;
use App\Models\LandingPage;
use App\Models\Lembaga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArtikelController extends Controller
{
    public function index(Request $request){
        $domain = $request->getHttpHost();

        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $artikel = Artikel::where('id_lembaga',$idLembaga)->orderBy('id')->get();
        }

        return view('backend.component.artikel.index', compact('artikel'));
    }


    public function create(Request $request){
        $artikel = Artikel::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();

        $categories = Categories::get();

        $lembaga = Lembaga::get();

        return view('backend.component.artikel.create', compact(['artikel' ,'landingPage', 'categories', 'lembaga']));
    }

    public function create_process(Request $request) {
        $request->validate([
            'status' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'id_lembaga' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image'        => 'nullable|max:2048|mimes:jpg,jpeg,png',
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
            'id_lembaga' => $request->id_lembaga,         
            'title' => $request->title,
            'slug' => $request->slug,
            'image' => $image,
            'description' => $request->description,
            'content' => $request->content,
            'views' => $request->views,
        ]);


        return redirect()->route('backend.artikel')->with('success', 'Artikel Has Been Created');
    }

    public function edit($id, Request $request){
        if ($id == null) {
            return redirect()->route('backend.artikel')->with('error', 'The ID is empty!');
        } else {
            $artikel = Artikel::find($id);

            $getArtikel = Artikel::get();

            $domain = $request->getHttpHost();
            
            $categories = Categories::get();

            $lembaga = Lembaga::get();

            $landingPage = LandingPage::where('domain', $domain)->first();

            if ($artikel) {
                return view('backend.component.artikel.edit', compact(['artikel','landingPage', 'lembaga', 'categories', 'getArtikel']));
            } else {
                return redirect()->route('backend.artikel')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }

    public function edit_process($id ,Request $request){
        request()->validate([
            'image'        => 'nullable|max:2048|mimes:jpg,jpeg,png',
        ]);

        $artikel = Artikel::find($id);

        $image = $artikel->image;

        if ($request->hasFile('image')) {
            if (public_path('images/artikel/'. $artikel->image))
            unlink(public_path('images/artikel/'.$artikel->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/artikel'), $image);
        }

        Artikel::where('id', $request->id)
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

        return redirect()->route('backend.artikel')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $artikel = Artikel::find($id);

        $artikel->delete();

        return redirect()->route('backend.artikel')->with('success', 'Item Deleted Successfully');
    }


}
