<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Pesantren Koding | Pesantren IT | Pesantren Enterpreneur | Pondok IT</title>
	<meta name="description" content="Pesantren Koding, Pesantren IT, Pesantren Enterpreneur, Pondok IT">
    <!-- google fonts -->
    <link href="//fonts.googleapis.com/css2?family=Jost:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Template CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('public/css/style-starter.css') }}">
    @yield('css')
    @yield('js')
</head>

<body>
    <!-- header -->
    <header id="site-header" class="fixed-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg stroke">
                {{-- <a class="navbar-brand" href="index.html">
                    Kodein.
                </a> --}}
                <a class="navbar-brand" href="#index.html">
                    <img src="{{ asset('public/images/logo/logo2.png') }}" alt="Your logo" title="Your logo" style="height:55px;" />
                </a>
                <button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
                    data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
                    <span class="navbar-toggler-icon fa icon-close fa-times"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">BERANDA <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item @@about__active">
                            <a class="nav-link" href="https://docs.google.com/forms/d/e/1FAIpQLSeDoavH5vKqE2XnzlsBcVWbXnT8_1TLnpy7546eoF9wYgAYEA/viewform?embedded=true">DAFTAR</a>
                        </li>
                        <li class="nav-item @@about__active">
                            <a class="nav-link" href="https://wa.me/6281703703111">KONTAK</a>
                        </li>
                      	 <li class="nav-item">
                            <a class="btn btn-primary btn-style" href="{{ route ('login') }}">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!-- //header -->

    @yield('content')

    <!-- Footer -->
    <section class="w3l-footer py-sm-5 py-4">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <div class="col-lg-8 footer-left">
                        <a href="#url" class="m-0">Pesantren Koding</a>
                        <p>Harvest City Jl Raya Orchid A Setu-Bekasi 17320</p>
                        <p>© 2023 Pesantren Koding. All Rights Reserved</p>
                    </div>
                    <div class="col-lg-4 footer-right text-lg-right text-center mt-lg-0 mt-3">
                        <ul class="social m-0 p-0">
                            <li><a href="https://www.facebook.com/people/Sekolah-Developer-Indonesia/100088412141036/"><span class="fa fa-facebook-official"></span></a></li>
                            {{-- <li><a href="#linkedin"><span class="fa fa-linkedin-square"></span></a></li> --}}
                            <li><a href="https://www.instagram.com/sekolahdeveloperindonesia/"><span class="fa fa-instagram"></span></a></li>
                            {{-- <li><a href="#twitter"><span class="fa fa-twitter"></span></a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- whatsapp-button -->
        <a href="https://wa.me/6281703703111" class="whatsapp-button" target="_blank" style="position: fixed;  right: 20px; bottom: 20px;">
            <img src="https://i.ibb.co/VgSspjY/whatsapp-button.png" alt="botão whatsapp">
        </a>
        <!-- whatsapp-button -->
    </section>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        const sr = ScrollReveal({
            origin: 'top',
            distance: '80px',
            duration: 2000,
            reset: true
        })

        sr.reveal('.gambar', {})
        sr.reveal('.title', {
            origin: 'left'
        })
        sr.reveal('.tombol', {
            delay: 200
        })
        sr.reveal('.sub', {})

    </script>
    <!-- //Footer -->

    <!-- all js scripts and files here -->

    <script src="{{ asset('public/js/jquery-3.3.1.min.js') }}"></script><!-- default jQuery -->

    <!-- services owlcarousel -->
    <script src="{{ asset('public/js/owl.carousel.js') }}"></script>

    <!-- script for services -->
    <script>
        $(document).ready(function () {
            $('.owl-two').owlCarousel({
                loop: true,
                margin: 30,
                nav: false,
                responsiveClass: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplaySpeed: 900,
                autoplayHoverPause: false,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    480: {
                        items: 1,
                        nav: false
                    },
                    700: {
                        items: 1,
                        nav: false
                    },
                    1090: {
                        items: 3,
                        nav: false
                    }
                }
            })
        })

    </script>
    <!-- //script for services -->

    <!-- script for tesimonials carousel slider -->
    <script>
        $(document).ready(function () {
            $("#owl-demo1").owlCarousel({
                margin: 20,
                dots: false,
                nav: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    736: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 2,
                        nav: false,
                        loop: false
                    }
                }
            })
        })

    </script>
    <!-- //script for tesimonials carousel slider -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });

    </script>
    <!-- disable body scroll which navbar is in active -->

    <!--/MENU-JS-->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });

    </script>
    <!--//MENU-JS-->

    <!-- bootstrap js -->
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>


</body>

</html>
