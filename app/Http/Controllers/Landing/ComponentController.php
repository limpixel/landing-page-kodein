<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Models\landing\Component;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Landing\ComponentContent;
use App\Models\landing\ComponentType;

class ComponentController extends Controller
{
    public function index($componentid) {
        $componentid = str_replace("component-", "", $componentid);
        $component = Component::where('id', $componentid)->first();
        $component_type = Component::where('id', $componentid)->first()->component_type_id;
        $contents = ComponentContent::where('component_id', $componentid)->get();

        $data = [
            "component_id" => $componentid,
            "componentTitle" => $component->title,
            "componentType" => $component_type,
            "contents" => $contents
        ];

        return view('landing.component', $data);
    }

    public function add_component(Request $request) {
        $highestOrder = Component::orderBy('order','DESC')->first();
        
        if($highestOrder){
            $order = $highestOrder->order;
        }else {$order = 0;}
        $componentCode = ComponentType::where('id', $request->component_type)->first();
        Component::create([
            'title' => $request->name,
            'component_type_id' => $request->component_type,
            'order' => $order + 1,
            'code' => $componentCode->start_code . $componentCode->end_code
        ]);
    }

    public function move_component(Request $request) {
        $components = $request->component;
        // DB::transaction(function () use ($components) {
            // Mendapatkan semua data dari tabel
            $data = Component::orderBy('order')->get();
        
            // Melakukan iterasi pada setiap data dan mengupdate nilai dengan menggunakan nilai array baru
            foreach ($data as $index => $item) {
                $item->order = $components[$index];
                $item->save();
            }
        // });
    }

    public function get_content(Request $request)
    {
        $content = ComponentContent::where('id', $request->id)->first();

        echo json_encode([
            'content' => $content,
        ]);
    }

    public function create_content(Request $request) {

        $id = $request->id;

        $component_type = Component::where('id', $id)->first()->component_type_id;

        if($request->image) {

            $image = time() . '.' . $request->image->extension();
            if($component_type == 5) {
                $request->image->move(public_path('images/carousel'), $image);
            }elseif($component_type == 3) {
                $request->image->move(public_path('images/galery'), $image);
            }elseif($component_type == 1) {
                $request->image->move(public_path('images/image-hero'), $image);
            }

            $data = ComponentContent::create([
                'component_id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'image' => $image,
                'embed_link' => $request->embed_link,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ]);
        }else {
            $data = ComponentContent::create([
                'component_id' => $id,
                'title' => $request->title,
                'description' => $request->description,
                'embed_link' => $request->embed_link,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ]);
        }

        if($data) {
            echo json_encode(['status' => 'success']);
            $this->update_component($id);
        }
    }

    public function edit_content(Request $request) {

        $id = $request->id;

        $content = ComponentContent::find($request->id);
        $component_type = Component::where('id', $content->component_id)->first()->component_type_id;

        if($request->image) {

            $image = time() . '.' . $request->image->extension();
            if($component_type == 5) {
                if (public_path('images/carousel/'. $content->image))
                unlink(public_path('images/carousel/'.$content->image));
                $request->image->move(public_path('images/carousel'), $image);
            }elseif($component_type == 3) {
                if (public_path('images/galery/'. $content->image))
                unlink(public_path('images/galery/'.$content->image));
                $request->image->move(public_path('images/galery'), $image);
            }elseif($component_type == 1) {
                if (public_path('images/image-hero/'. $content->image))
                unlink(public_path('images/image-hero/'.$content->image));
                $request->image->move(public_path('images/image-hero'), $image);
            }

            $data = ComponentContent::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $image,
                'embed_link' => $request->embed_link,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ]);
        }else {
            $data = ComponentContent::where('id', $id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'embed_link' => $request->embed_link,
                'button_text' => $request->button_text,
                'button_link' => $request->button_link,
            ]);
        }

        if($data) {
            echo json_encode(['status' => 'success']);
            $this->update_component($content->component_id);
        }
    }

    public function update_component($id) {
        $contents = ComponentContent::where('component_id', $id)->get();
        $component = Component::where('id', $id)->first();
        $componentType = ComponentType::where('id', $component->component_type_id)->first();

        $htmlCode = '';

        if($component->component_type_id == 1) {
            $htmlCode .= '<section class="w3l-index3 bg-orange" id="about">
            <div class="midd-w3 py-4">
                <div class="container py-lg-5 py-md-3">
                    <div class="row align-items-center">';
            
            foreach($contents as $content) {
                $htmlCode .= '<div class="col-lg-6 mt-4">
                <img src="'. asset('images/image-hero/' . $content->image). '" alt=""
                    class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
            </div>
            <div class="col-lg-6 col-sm-12">
                <h1 class="mb-2 title text-right">'. $content->title .'</h1>
                <p class="sub text-right">'. $content->description .'</p>
            </div>';
            }

            $htmlCode .= '</div>
                    </div>
                </div>
            </section>';
        }elseif($component->component_type_id == 3) {
            $htmlCode .= '<section class="w3l-index3 bg-blue">
            <div class="blog py-4" id="services">
                <div class="container py-lg-5 py-md-3">
                    <h1 class="mb-4 text-center title"> Galeri <span>Aktifitas di</span> KODEIN</h1>
                    <div class="row justify-content-center">
                        <div class="col-md-12 ">
                            <div class="owl-two owl-carousel owl-theme">';
            
            foreach($contents as $content) {
                $htmlCode .= '<div class="item">
                <img src="'.asset('images/galery/' . $content->image).'" alt=""
                    class="radius-image w-100 shadow" style="height: 300px; object-fit: cover;">
            </div>';
            }                        

            $htmlCode .= '</div>
                        </div>
                    </div>
                    <div class="text-more mt-5">
                        <p class="pt-3 sample text-center">
                            <a href="services.html">View All Activity <span class="pl-2 fa fa-long-arrow-right"></span></a>
                        </p>
                    </div>
                </div>
            </div>
            </section>
            <!-- //home page services section -->';
        }elseif($component->component_type_id == 4) {
            $htmlCode .= '<section class="w3l-index3 bg-orange" id="clients">
            <!-- /grids -->
            <div class="cusrtomer-layout py-4">
                <div class="container py-lg-5 py-md-4">
                    <h1 class="mb-4 text-center title"> Testimoni <span>Pembelajaran di</span> KODEIN</h1>
                    <!-- /grids -->
                    <div class="testimonial-width">
                        <div id="owl-demo1" class="owl-carousel owl-theme mb-4">';
            
            foreach($contents as $content) {
                $htmlCode .= '<div class="item">
                <div class="testimonial-content">
                    <div class="testimonial">
                        <blockquote>
                            <q>'. $content->description .'</q>
                        </blockquote>
                        <div class="testi-des">
                            <div class="test-img"><img src="'. asset('images/testimony/') .'" class="img-fluid" alt="">
                            </div>
                            <div class="peopl align-self">
                                <p>'. $content->title .'</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
            }

            $htmlCode .= '</div>
                        </div>
                    </div>
                    <!-- /grids -->
                </div>
                <!-- //grids -->
            </section>
            <!-- //testimonials -->';

        }elseif($component->component_type_id == 5) {
            $htmlCode .= '<section id="home" class="w3l-index3">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">';
            foreach($contents as $key => $content){
                $htmlCode .= '<li data-target="#carouselExampleIndicators" data-slide-to="'.$key.'" ' . ($key == 0 ? 'class="active"' : '') . '></li>';
            }
            $htmlCode .= '    
            </ol>
            <div class="carousel-inner">
            ';
            foreach($contents as $key  => $content) {
                $htmlCode .= '              
                <div class="carousel-item '. ($key == 0 ? 'active' : "") .'">
                    <img class="d-block w-100" src="'.asset('images/carousel/' . $content->image).'"
                        style="max-height: 500px; max-width: 100%; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>'.$content->title.'</h3>
                        <p>...</p>
                    </div>
                </div>';
            }

            $htmlCode .= '          </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"
                          style="max-height: 600px">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                      </a>
                  </div>
              </section>';
        }elseif($component->component_type_id == 6) {
            $htmlCode .= '  <section id="home" class="w3l-index3 bg-orange">
            <div class="midd-w3 py-4">
                <div class="container py-lg-5 py-md-3">
                    <div class="row align-items-center">';

            foreach($contents as $content) {
                $htmlCode .= '<div class="col-lg-6">
                <iframe src="'. $content->embed_link .'"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;"></iframe>
              </div>
              <div class="col-lg-6 col-sm-12">
                    <h1 class="mb-2 title">'. $content->title .'</h1>
                    <p class="sub mb-2">'. $content->description .'</p>
                    <div class="text-right">
                        <a href="'. $content->button_link .'" class="btn btn-primary btn-style">'. $content->button_text .'</a>
                    </div>
                </div>';
            }


            $htmlCode .= '</div>
            </div>
        </div>
      </section>';
        }elseif($component->component_type_id == 7) {
            $htmlCode .= '<section class="w3l-index3 bg-orange" id="home">
            <div class="midd-w3 py-4">
              <div class="container py-lg-5 py-md-3">
                  <h1 class="mb-4 title text-center"> Lokasi <span>Sekolah</span> KODEIN</h1>';

            foreach($contents as $content) {
                $htmlCode .= '<div class="row justify-content-center mb-4">
                <iframe
                    src="'.$content->embed_link.'"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="radius-image shadow"></iframe>
            </div>
            <div class="text-center">
                <p class="mb-4">'. $content->description .'</p>
            </div>';
            }


            $htmlCode .= '</div>
            </div>
          </section>';
        }

        Component::where('id', $id)->update([
            'code' => $htmlCode,
        ]);
    }
}
