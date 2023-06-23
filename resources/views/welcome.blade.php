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
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <img class="d-block w-100" src="{{ asset('images/carousel/image1.jpg') }}" alt="First slide"
                      style="height: 450px; max-width: 100%; object-fit: cover;">
                  <div class="carousel-caption d-md-block">
                      <h3>Penerimaan Peserta Didik Baru T.A 2023/2024</h3>
                      <div class="row justify-content-center">
                          <div class="m-2">
                              <a href="https://wa.me/6281703703111" class="btn btn-success btn-style">Kontak</a>
                              <a href="https://docs.google.com/forms/d/e/1FAIpQLSeDoavH5vKqE2XnzlsBcVWbXnT8_1TLnpy7546eoF9wYgAYEA/viewform?embedded=true"
                                  class="btn btn-warning btn-style">Daftar</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('images/carousel/image2.jpg') }}" alt="Second slide"
                      style="height: 450px; max-width: 100%; object-fit: cover;">
                  <div class="carousel-caption d-md-block">
                      <h3>Penerimaan Peserta Didik Baru T.A 2023/2024</h3>
                      <div class="row justify-content-center">
                          <div class="m-2">
                              <a href="https://wa.me/6281703703111" class="btn btn-success btn-style">Kontak</a>
                              <a href="https://docs.google.com/forms/d/e/1FAIpQLSeDoavH5vKqE2XnzlsBcVWbXnT8_1TLnpy7546eoF9wYgAYEA/viewform?embedded=true"
                                  class="btn btn-warning btn-style">Daftar</a>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <img class="d-block w-100" src="{{ asset('images/carousel/image3.jpg') }}" alt="Third slide"
                      style="height: 450px; max-width: 100%; object-fit: cover;">
                  <div class="carousel-caption d-md-block">
                      <h3>Penerimaan Peserta Didik Baru T.A 2023/2024</h3>
                      <div class="row justify-content-center">
                          <div class="m-2">
                              <a href="https://wa.me/6281703703111" class="btn btn-success btn-style">Kontak</a>
                              <a href="https://docs.google.com/forms/d/e/1FAIpQLSeDoavH5vKqE2XnzlsBcVWbXnT8_1TLnpy7546eoF9wYgAYEA/viewform?embedded=true"
                                  class="btn btn-warning btn-style">Daftar</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
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
  </section>
  <!-- //home page about section -->


  <!-- banner section -->
  @foreach ($description as $item)
  <section id="home" class="w3l-index3 bg-orange">
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
                        <h1 class="mb-2 title text-right"> {{ $item->title }}</h1>
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
                        <h1 class="mb-2 title text-right"> {{ $item->title }}</h1>
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
                @endif
                  
              </div>
          </div>
      </div>
  </section>
  @endforeach
  <!-- //banner section -->

  <!-- home page about section -->
  <section class="w3l-index3 bg-blue" id="about">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title">Visi</h1>
                      <p class="sub mb-2">Menjadi lembaga pendidikan terbaik bertaraf internasional
                          untuk mencetak generasi muda yang Profesional,
                          amanah dan siap bersaing dalam industri IT.</p>
                      <h1 class="mb-2 title">Misi</h1>
                      <p class="sub"> - Menghasilkan lulusan yang memiliki berbagai skill dalam bidang IT.</p>
                      <p class="sub"> - Mengembangkan keterampilan IT peserta didik dengan metode "learning by project".
                      </p>
                      <p class="sub"> - Menanamkan Tauhid, Aqidah dan prinsip yang benar pada peserta didik.</p>
                      <p class="sub"> - Membina akhlak dan kepribadian peserta didik.</p>
                      <p class="sub"> - Menyelenggarakan pembelajaran yang menumbuh kembangkan kreatifitas dan inovatif
                          peserta didik.</p>
                      <p class="sub"> - Menumbuh kembangkan sikap dewasa, inisiatif dan kemandirian peserta didik.</p>
                  </div>
                  <div class="col-lg-6 mt-4">
                      <img src="{{ asset('images/image-hero/image1.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>
              </div>
          </div>
      </div>
  </section>

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

  <!-- home page about section -->
  <section class="w3l-index3 bg-blue" id="about">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title"> Fasilitas <span>Yang Dimiliki Oleh</span> Pesantren Koding</h1>
                      <p class="sub"> - Asrama yang nyaman.</p>
                      <p class="sub"> - Kelas dengan konsep ruang kerja industri IT.</p>
                      <p class="sub"> - Tercover dengan Wi-Fi kecepatan tinggi.</p>
                      <p class="sub"> - Ruang komunal untuk interaksi.</p>
                      <p class="sub"> - Domain dan Hosting untuk setiap santri.</p>
                      <p class="sub"> - Fasilitas Olahraga.</p>
                  </div>
                  <div class="col-lg-6 mt-4">
                      <img src="{{ asset('images/image-hero/image2.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section class="w3l-index3 bg-orange" id="about">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 mt-4">
                      <img src="{{ asset('images/image-hero/image3.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title text-right"> Mentor <span>Di</span> Pesantren Koding</h1>
                      <p class="sub text-right">Doni Fazriyanto (Founder DR Digital Indonesia), Arya Febiyan
                          (Founder Duta Media Teknologi, Dumet School, Dumet Agency,
                          Dumet Host, Dumet Store), Moch Shidup (Founder Buanatechno
                          Cipta Solusi, Founder Biruni Kreasi Teknologi, Founder Shratech
                          Berkah Amanah, Founder Sharia Rekacipta Tekno, Founder Teh Sari),
                          Muhammad Faruqie, Lc., MIRKH. (Alumni Universitas Islam Madinah,
                          Alumni Universitas Islam Antar Bangsa Malaysia) M. Imadudinnsyah
                          (Founder Big Idea Creative Solution, Founder Jasa Desain U2),
                          M. Ilham Wardani S.IKom (Founder Khalifah Stuff)</p>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-blue">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title"> <span>Learn By </span> Project</h1>
                      <p class="sub mb-2">Siswa ditantang untuk mengerjakan Project baik secara Individu maupun Team
                          Learning Day Selama 4 Hari (senin - kamis) Siswa diberikan materi dilanjutkan Project Day
                          selama 3 hari (jumat - sabtu) diharapkan Siswa mampu mengimplementasikan materi yang sudah
                          diberikan
                          manfaat Project Day</p>
                      <p class="sub mb-2"> - Implementasi Hasil Belajar</p>
                      <p class="sub mb-2"> - Kerjasama Team</p>
                      <p class="sub mb-2"> - Fleksibel Tempat dan Waktu sehinga siswa dapat menegerjakan tugs project di
                          sekolah dan dapat berkonsultasi langsung dengan mentor atau siswa dapat mengerjakan dirumah
                          sehingga Quality Time bersama Keluarga terwujud</p>
                  </div>
                  <div class="col-lg-6">
                      <iframe src="https://www.youtube.com/embed/hyFn1tXGjPQ" title="YouTube video player"
                          frameborder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                          allowfullscreen class="radius-image gambar shadow w-100"
                          style="height: 300px; object-fit: cover;"></iframe>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-orange">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6">
                      <iframe src="https://www.youtube.com/embed/-HUotKkJawY" title="YouTube video player"
                          frameborder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                          allowfullscreen class="radius-image gambar shadow w-100"
                          style="height: 300px; object-fit: cover;"></iframe>
                  </div>
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title text-right">Inkubator IT</h1>
                      <p class="sub mb-2 text-right">Badan usaha khusus dibawah naungan Yayasan yang melayani pembuatan
                          berbagai
                          produk berbasis IT dan telah melayani puluhan klien lebih.
                          perusahaan inkubator yang dibuat agar siswa pesantren koding dapat mengimplementasikan ilmu IT
                          di Dunia Usaha dan Dunia Industri</p>

                  </div>

              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-blue">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title">Sertifikasi IT</h1>
                      <p class="sub mb-2">keistimewaan pesantren koding adalah pada pola pembelajaran 80% praktek dan
                          20% teori dimana peserta didik akan memiliki kompetensi siap kerja bersertifikasi sehingga
                          dapat langsung terjun ke industri atau menjadi seorang technopreneur. Syarat peserta didik
                          adalah yang memiliki ketertarikan pada teknologi dan ingin mengembangkan karir nya pada
                          industri teknologi informasi, baik sebagai pekerja maupun sebagai seorang technopreneur.</p>
                  </div>
                  <div class="col-lg-6">
                      <img src="{{ asset('images/image-hero/image5.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>

              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-orange">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6">
                      <img src="{{ asset('images/image-hero/image6.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title text-right">English Camp</h1>
                      <p class="sub mb-2 text-right">Program yanng dipersiapkan pesantren koding selama 2 Bulan di
                          Kampung English Pare. Dengan Menguasai Bahasa Ingris yang merupakan bahasa pengantar dalam
                          pembelajaran IT Sehingga siswa dapat memahami dengan mudah materi materi disampaikan Bahasa
                          Ingris Sebagai Bahasa Komunikasi dalam Dunia Industri/Dunia Usaha dengan demikian Siswa dapat
                          Go International</p>
                  </div>

              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-blue">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title">Persiapan Akademik</h1>
                      <p class="sub mb-2">Pesantren Koding Mendatangkan Mentor Mentor Akademik dari Bimbingan Belajar
                          Yang Sudah Ternama dengan Metode Belajar Sistem Blok Siswa Diajarkan Fokus Kepada materi
                          materi yang berhubungan dengan Industri IT dan UTBK
                          Pesantren Koding Mempersiapkan Siswa yang siap kerja dan siap kuliah</p>
                  </div>
                  <div class="col-lg-6">
                      <img src="{{ asset('images/image-hero/image7.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>

              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-orange">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6">
                      <img src="{{ asset('images/image-hero/image8.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
                  </div>
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title text-right">Pembekalan Ilmu Diniyah</h1>
                      <p class="sub mb-2 text-right">Pesantren Koding memberikan pembekalan ilmu diniyah dan adab ,
                          siswa diberikan pembekalan tujuan hidup yang sebenarnya tidak hanya mencari materi dan
                          kebahagian dunia yang fana. siswa diajarkan bagaimana adab yang baik dalam berinteraksi dengan
                          keluarga dan masyakat.
                          Kepala Sekolah Pesantren Koding yang merupakan lulusan Universitas Islam Madinah akan
                          membimbing siswa Fiqih dan Adab dalam Islam</p>
                  </div>


              </div>
          </div>
      </div>
  </section>

  <section id="home" class="w3l-index3 bg-blue">
      <div class="midd-w3 py-4">
          <div class="container py-lg-5 py-md-3">
              <div class="row align-items-center">
                  <div class="col-lg-6 col-sm-12">
                      <h1 class="mb-2 title">Tahfidz Camp</h1>
                      <p class="sub mb-2">Pesantren Koding Memberikan Pembekalan Tahsin dan Tahfidz Alquran sebagai
                          bekal mereka menjadi imam didalam keluarga</p>
                  </div>
                  <div class="col-lg-6">
                      <img src="{{ asset('images/image-hero/image9.jpg') }}" alt=""
                          class="radius-image gambar shadow w-100" style="height: 300px; object-fit: cover;">
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
                          <div class="item">
                              <img src="{{ asset('images/galery/galery1.jpg') }}" alt=""
                                  class="radius-image w-100 shadow" style="height: 300px; object-fit: cover;">
                          </div>
                          <div class="item">
                              <img src="{{ asset('images/galery/galery2.jpg') }}" alt=""
                                  class="radius-image w-100 shadow" style="height: 300px; object-fit: cover;">
                          </div>
                          <div class="item">
                              <img src="{{ asset('images/galery/galery3.jpg') }}" alt=""
                                  class="radius-image w-100 shadow" style="height: 300px; object-fit: cover;">
                          </div>
                          <div class="item">
                              <img src="{{ asset('images/galery/galery4.jpg') }}" alt=""
                                  class="radius-image w-100 shadow" style="height: 300px; object-fit: cover;">
                          </div>
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
                      <div class="item">
                          <div class="testimonial-content">
                              <div class="testimonial">
                                  <blockquote>
                                      <q>Pesantren Koding merupakan sekolah yang mempersiapkan siswa untuk bisa langsung
                                          siap
                                          kerja di dunia IT. Saya sarankan agar orang tua yang ingin anaknya siap
                                          kerja di insdustri IT menyekolahkan di Pesantren Koding</q>
                                  </blockquote>
                                  <div class="testi-des">
                                      <div class="test-img"><img src="{{ asset('images/') }}" class="img-fluid" alt="">
                                      </div>
                                      <div class="peopl align-self">
                                          <p>Wali Siswa Abdul Razak - angkatan 0</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="item">
                          <div class="testimonial-content">
                              <div class="testimonial">
                                  <blockquote>
                                      <q>Pesantren Koding merupakan sekolah yang mempersiapkan siswa untuk bisa langsung
                                          siap
                                          kerja di dunia IT. Saya sarankan agar orang tua yang ingin anaknya siap
                                          kerja di insdustri IT menyekolahkan di Pesantren Koding</q>
                                  </blockquote>
                                  <div class="testi-des">
                                      <div class="test-img"><img src="{{ asset('images/') }}" class="img-fluid" alt="">
                                      </div>
                                      <div class="peopl align-self">
                                          <p>Wali Siswa Abdul Razak - angkatan 0</p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
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
                      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.0865000989656!2d107.01312457494328!3d-6.382836293607502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e699753f452a75d%3A0x25e019e428a06c70!2sKodein%20Sekolah%20Developer%20Indonesia!5e0!3m2!1sid!2sid!4v1684981881926!5m2!1sid!2sid"
                      width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                      referrerpolicy="no-referrer-when-downgrade" class="radius-image shadow"></iframe>
              </div>
              <div class="text-center">
                  <p class="mb-4">Harvest City Jl Raya Orchid A Setu-Bekasi 17320 pesantrenkoding@gmail.com(081 703 703
                      111). (08 212121 0078). (08 77 6142 4322)</p>
              </div>

          </div>
      </div>
  </section>
  @endsection