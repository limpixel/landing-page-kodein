  @extends('layouts.frontend')

  @section('js')
  <script>
      $('.carousel').carousel()
  </script>
  @endsection

  @section('content')

  <section id="home" class="w3l-index3">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach ($carousel as $key => $item)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" @if ($key == 0) class="active" @endif></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach ($carousel as $key => $item)
          <div class="carousel-item @if ($key == 0) active @endif">
            <img class="d-block w-100" src="{{ asset('images/carousel') . '/' . $item->image }}" alt="Slide {{ $key + 1 }}"
              style="height: 450px; max-width: 100%; object-fit: cover;">
            <div class="carousel-caption d-md-block">
              <h3>{{ $item->title }}</h3>
              <div class="row justify-content-center">
                <div class="m-2">
                  <a href="{{ $item->buttonLink1 }}" class="btn btn-success btn-style">{{ $item->buttonText1 }}</a>
                  <a href="{{ $item->buttonLink2 }}" class="btn btn-warning btn-style">{{ $item->buttonText2 }}</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="max-height: 600px">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  
  <!-- //home page about section -->


  <!-- banner section -->
  @foreach ($description as $item)
  <section id="home" class="w3l-index3"  style="background: {{ $item->bgColor }}">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                @if ($item->position == "Left")
                    <div class="col-lg-6">
                        @if ($item->video != null)
                        <iframe src="{{ $item->video }}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen class="radius-image gambar shadow w-100"
                            style="height: 300px; object-fit: cover;"></iframe>
                        @else
                        <img src="{{ asset('images/description') . '/' . $item->image }}" alt=""
                            class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <h1 class="mb-2 title"> {!! $item->title !!}</h1>
                        <p class="sub mb-2">{!! $item->description !!}</p>
                        @if ($item->link != null)
                            <div class="text-right">
                                <a href="{{ $item->link }}"
                                    class="btn btn-primary btn-style">Daftar</a>
                            </div>
                        @endif
                    </div>
                @elseif ($item->position == "Right")
                    <div class="col-lg-6 col-sm-12">
                        <h1 class="mb-2 title"> {!! $item->title !!}</h1>
                        <p class="sub mb-2">{!! $item->description !!}</p>
                        @if ($item->link != null)
                            <div class="text-right">
                                <a href="{{ $item->link }}"
                                    class="btn btn-primary btn-style">Daftar</a>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        @if ($item->video != null)
                        <iframe src="{{ $item->video }}" title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen class="radius-image gambar shadow w-100"
                            style="height: 300px; object-fit: cover;"></iframe>
                        @else
                        <img src="{{ asset('images/description') . '/' . $item->image }}" alt=""
                            class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                        @endif
                    </div>
                @elseif ($item->position == "Bottom")                    
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 text-center">
                            <h1 class="mb-2 title">{!! $item->title !!}</h1>
                            <p class="sub mb-2">{!! $item->description !!}</p>
                            @if ($item->link != null)
                                <div class="text-right">
                                    <a href="{{ $item->link }}" class="btn btn-primary btn-style">Daftar</a>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 text-center mt-4">
                            @if ($item->video != null)
                            <iframe src="{{ $item->video }}" title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="radius-image gambar shadow w-100"
                                style="height: 300px; object-fit: cover;"></iframe>
                            @else
                            <img src="{{ asset('images/description') . '/' . $item->image }}" alt=""
                                class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                @elseif ($item->position == "Top")                    
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 text-center">
                            @if ($item->video != null)
                            <iframe src="{{ $item->video }}" title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen class="radius-image gambar shadow w-100"
                                style="height: 300px; object-fit: cover;"></iframe>
                            @else
                            <img src="{{ asset('images/description') . '/' . $item->image }}" alt=""
                                class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                            @endif
                        </div>
                        <div class="col-12 text-center mt-4">
                            <h1 class="mb-2 title">{!! $item->title !!}</h1>
                            <p class="sub mb-2">{!! $item->description !!}</p>
                            @if ($item->link != null)
                                <div class="text-right">
                                    <a href="{{ $item->link }}" class="btn btn-primary btn-style">Daftar</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                  
              </div>
          </div>
      </div>
  </section>
  @endforeach
  <!-- //banner section -->

  <section id="home" class="w3l-index3 bg-orange">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <h1 class="mb-2 title text-center"> Keunggulan <span>Pembelajaran di </span> Pesantren Koding!</h1>
              <div class="row justify-content-center">
                  <div class="col-lg-2 mt-4">
                      <img src="{{ asset('images/icon/icon-biru1.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-2 mt-4">
                      <img src="{{ asset('images/icon/icon-biru2.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-2 mt-4">
                      <img src="{{ asset('images/icon/icon-biru3.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-2 mt-4">
                      <img src="{{ asset('images/icon/icon-biru4.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-2 mt-4">
                      <img src="{{ asset('images/icon/icon-biru5.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- home page services section -->
  <section class="w3l-index3 bg-orange">
      <div class="blog py-4" id="services">
          <div class="container py-lg-5 py-md-3">
              <h1 class="mb-4 text-center title"> Galeri <span>Aktifitas di</span> Pesantren Koding</h1>
              <div class="row justify-content-center">
                  <div class="col-md-12 ">
                      <div class="owl-two owl-carousel owl-theme">
                        @foreach ($galery as $item)
                        <div class="item">
                            <img src="{{ asset('images/galery') . '/' . $item->image }}" alt=""
                                class="radius-image w-100 shadow" style="height: 300px; object-fit: cover;">
                        </div>
                        @endforeach
                      </div>
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
  <!-- //home page services section -->

  <!-- testimonials -->
  <section class="w3l-index3 bg-blue" id="clients">
      <!-- /grids -->
      <div class="cusrtomer-layout py-4">
          <div class="container py-lg-5 py-md-4">
              <h1 class="mb-4 text-center title"> Testimoni <span>Pembelajaran di</span> Pesantren Koding</h1>
              <!-- /grids -->
              <div class="testimonial-width">
                  <div id="owl-demo1" class="owl-carousel owl-theme mb-4">
                    @foreach ($testimony as $item)
                    <div class="item">
                        <div class="testimonial-content">
                            <div class="testimonial">
                                <blockquote>
                                    <q>{!! $item->description !!}</q>
                                </blockquote>
                                <div class="testi-des">
                                    <div class="test-img"><img src="{{ asset('images/testimoni') . '/' . $item->image }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="peopl align-self">
                                        <p>{{ $item->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </div>
              </div>
          </div>
          <!-- /grids -->
      </div>
      <!-- //grids -->
  </section>
  <!-- //testimonials -->

  <section id="about" class="w3l-index3 bg-orange">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <h1 class="mb-2 title text-center"> Biaya Pendidikan</h1>
              <div class="row justify-content-center">
                  <div class="col-lg-3 mt-4">
                      <img src="{{ asset('images/harga/price1.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-3 mt-4">
                      <img src="{{ asset('images/harga/price2.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-3 mt-4">
                      <img src="{{ asset('images/harga/price3.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
                  <div class="col-lg-3 mt-4">
                      <img src="{{ asset('images/harga/price4.png') }}" alt="" class="radius-image shadow img-fluid">
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section class="w3l-index3 bg-blue" id="home">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <h1 class="mb-4 title text-center"> Lokasi <span>Sekolah</span> Pesantren Koding</h1>
              <div class="row justify-content-center mb-4">
                  <iframe
                      src="{{ $location[0]->map }}"
                      width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade" class="radius-image shadow"></iframe>
              </div>
              <div class="text-center">
                  <p class="mb-4">{{ $location[0]->description }}</p>
              </div>

          </div>
      </div>
  </section>
  @endsection