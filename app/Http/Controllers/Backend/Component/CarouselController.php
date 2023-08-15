<?php

namespace App\Http\Controllers\Backend\Component;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $domain = $request->getHttpHost();
        
        $landingPage = LandingPage::where('domain', $domain)->first();
        $idLembaga = $landingPage->id_lembaga;
        $carousel = Carousel::where('id_lembaga',$idLembaga)->get();
    
        return view('backend.component.carousel.index', compact('carousel'));
    }

    public function create(Request $request){
        $carousel = Carousel::get();

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
        return view('backend.component.carousel.create', compact(['carousel','landingPage']));
    }

    public function store(Request $request)
    {
        request()->validate([
            'id_lembaga'         => 'required',
            'title'              => 'required',
            'image'         => 'required|max:2048|mimes:jpg,jpeg,png',
        ]);

        $image = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/carousel'), $image);
        
        Carousel::create([
            'id_lembaga'   => $request->id_lembaga,
            'title'   => $request->title,
            'buttonText1'   => $request->buttonText1,
            'buttonLink1'   => $request->buttonLink1,
            'buttonText2'   => $request->buttonText2,
            'buttonLink2'   => $request->buttonLink2,
            'image'   => $image,
        ]);
            // return $request;
        return redirect()->route('backend.carousel')->with('success', 'Item Created Successfully');
    }

    public function edit($id, Request $request){
        $carousel = Carousel::find($id);

        $domain = $request->getHttpHost();

        $landingPage = LandingPage::where('domain', $domain)->first();
    
        if ($carousel) {
            return view('backend.component.carousel.edit', compact(['carousel','landingPage']));
        } else {
            return redirect()->route('backend.carousel')->with('error', "The #ID {$id} not found in Database!");
        }
    }

    public function edit_process(Request $request){
        $carousel = Carousel::find($request->id);

        $image = $carousel->image;

        if ($request->hasFile('image')) {
            if (public_path('images/carousel/'. $carousel->image))
            unlink(public_path('images/carousel/'.$carousel->image));

            $image = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/carousel'), $image);
        }

        Carousel::where('id', $request->id)
            ->update(([
                'id_lembaga'         => $request->id_lembaga,
                'title'         => $request->title,
                'buttonText1'   => $request->buttonText1,
                'buttonLink1'   => $request->buttonLink1,
                'buttonText2'   => $request->buttonText2,
                'buttonLink2'   => $request->buttonLink2,
                'image' => $image,
            ]));

        return redirect()->route('backend.carousel')->with('success', 'Item Edited Successfully');
    }

    public function destroy($id){

        $carousel = Carousel::find($id);

        $carousel->delete();

        return redirect()->route('backend.carousel')->with('success', 'Item Deleted Successfully');
    }
}
