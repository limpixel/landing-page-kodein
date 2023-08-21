<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request){

        $domain = $request->getHttpHost();
        
        if ($landingPage = LandingPage::where('domain', $domain)->first()) {
            $idLembaga = $landingPage->id_lembaga;
            $categories = Categories::where('id_lembaga',$idLembaga)->orderBy('id')->get();
        }

        return view('backend.component.categories.index', compact('categories'));
    }

    public function create(Request $request){

        $categories = Categories::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();


        return view('backend.component.categories.create', compact(['categories' ,'landingPage']));
    }

    public function create_process(Request $request){
        $request->validate([
            'id_lembaga' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ]);

        Categories::create([
            'id_lembaga' => $request->id_lembaga,
            'name' => $request->name,
            'slug' => $request->slug
        ]);

        return redirect()->route('backend.categories')->with('success', 'Categories has Been Created');
    }

    public function edit($id, Request $request){
        if ($id == null) {
            return redirect()->route('backend.categories')->with('error', 'The ID is empty!');
        } else {
            $categories = Categories::find($id);

            $domain = $request->getHttpHost();

            $landingPage = LandingPage::where('domain', $domain)->first();

            if ($categories) {
                return view('backend.component.categories.edit', compact(['categories','landingPage']));
            } else {
                return redirect()->route('backend.categories')->with('error', "The #ID {$id} not found in Database!");
            }
        }
    }


    public function edit_process(Request $request){
        $request->validate([
            'id_lembaga' => 'required',
            'name' => 'required',
            'slug' => 'required',
        ]);

        $categories = Categories::find($request->id);


        Categories::where('id', $request->id)
            ->update(([
                'id_lembaga' => $request->id_lembaga,
                'name' => $request->name,
                'slug' => $request->slug
            ]));

        return redirect()->route('backend.categories')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){
        $categories = Categories::find($id);

        $categories->delete();

        return redirect()->route('backend.categories')->with('success', 'Item Deleted Successfully');
    }

    
}
