@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('content')
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('/frontend/img/carousel@4x.png') }}" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/frontend/img/carousel@4x.png') }}" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/frontend/img/carousel@4x.png') }}" class="d-block w-100" alt="...">
      
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



<div class="container">
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0 tags">
            <li class="nav-item">
              <a class="nav-link" href="#">Parenting</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Food</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Fashion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Games</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Event</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Education</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
</div>
<br>
<section class="section-content-news">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="headline">
                    <h3>Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h3>
                    <h6>KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                    <p>Penulis : <span>Ayunda Pininta Kasih</span> | Editor : <span>Ayunda Pininta Kasih</span></p>
                    <div class="img-berita">
                        <img src="{{ asset('/frontend/img/anak@4x.png') }}" alt="">
                        <p>Ilustrasi anak belajar (shutterstock)</p>
                    </div>
                    <p class="ringkasan">
                        KOMPAS.com - Selama masa pembelajaran jarak jauh, tugas bisa saja hadir setiap hari. Situasi rumah yang kadang tidak kondusif untuk belajar dan tak adanya pengajar yang hadir, berpotensi membuat anak kerap bosan dan menolak untuk belajar.
                    </p>
                </div>
                <div class="beritalain">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('/frontend/img/anak@4x.png') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <h5>Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h5>
                            <h6>KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                            <p>Penulis : <span>Ayunda Pininta Kasih</span> | Editor : <span>Ayunda Pininta Kasih</span></p>
                        </div>
                    </div>
                </div>
                <div class="beritalain">
                    <div class="row">
                        <div class="col-lg-4">
                            <img src="{{ asset('/frontend/img/anak@4x.png') }}" alt="">
                        </div>
                        <div class="col-lg-8">
                            <h5>Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h5>
                            <h6>KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                            <p>Penulis : <span>Ayunda Pininta Kasih</span> | Editor : <span>Ayunda Pininta Kasih</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sebelah kanan -->
            <div class="col-lg-4">
                <div class="like-news">
                    <h6>Like Olimpya Kids News</h6>
                    <hr>
                    <div class="btn-like fb my-2">
                        <span class="col-lg-1 text-right"><i class="fab fa-facebook-f"></i></span>
                        <span class="col-lg-2 text-right">1,847</span>
                        <span class="col-lg-6 text-right">&nbsp;Fans </span>
                        <span class="col-lg-1 offset-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</span>
                        <span class="col-lg-1 text-right">Like</span>
                        <!-- <span class="jumlah-sub">10,847</span>
                        <span class="judul-sub">Fans</span>
                        <span class="divide-sub">|</span>
                        <span class="tbl-sub">Like</span> -->
                    </div>
                    <div class="btn-like ig my-2">
                        <span class="col-lg-1 text-right"><i class="fab fa-instagram"></i></span>
                        <span class="col-lg-2 text-right">5,873</span>
                        <span class="col-lg-6 text-right">Followers </span>
                        <span class="col-lg-1 offset-1">&nbsp;|</span>
                        <span class="col-lg-1 text-right">Follow</span>
                    </div>
                    <div class="btn-like tw my-2">
                        <span class="col-lg-1 text-right"><i class="fab fa-twitter"></i></span>
                        <span class="col-lg-2 text-right">9,874</span>
                        <span class="col-lg-6 text-right">Followers </span>
                        <span class="col-lg-1 offset-1">&nbsp;|</span>
                        <span class="col-lg-1 text-right">Follow</span>
                    </div>
                    <div class="btn-like yt my-2">
                        <span class="col-lg-1 text-right"><i class="fab fa-youtube"></i></span>
                        <span class="col-lg-2 text-right">1,945</span>
                        <span class="col-lg-6 text-right">Subscriber </span>
                        <span class="col-lg-1 offset-1">|</span>
                        <span class="col-lg-1 text-right">Subscribe</span>
                    </div>
                </div>

                <div class="popular-news">
                    <h6 class="judul-popular">Most Popular</h6>
                    <hr>
                    <div class="beritalain popular">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset('/frontend/img/anak@4x.png') }}" alt="">
                            </div>
                            <div class="col-lg-8">
                                <h5>Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h5>
                                <h6>KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                            </div>
                        </div>
                    </div>
                    <div class="beritalain popular">
                        <div class="row">
                            <div class="col-lg-4">
                                <img src="{{ asset('/frontend/img/anak@4x.png') }}" alt="">
                            </div>
                            <div class="col-lg-8">
                                <h5>Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h5>
                                <h6>KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="trending-news">
                    <h6 class="judul-trending">Trending</h6>
                    <hr>
                    <div class="beritalain popular">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="trend vid-1 justify-content-center">
                                    <img src="{{ asset('/frontend/img/anak@4x.png') }}" alt="">
                                </div>
                                <h5 class="judul-trend">Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h5>
                                <h6 class="tanggal-trend">KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                            </div>
                            <div class="col-lg-6">
                                <div class="trend vid-1"><img src="{{ asset('/frontend/img/anak@4x.png') }}" alt=""></div>
                                <h5 class="judul-trend">Anak Mulai Bosan dan Menolak Belajar dari Rumah, Orang Tua Lakukan Ini</h5>
                                <h6 class="tanggal-trend">KOMPAS.COM - 14/04/2020, 17:06 WIB</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop

@section('js')
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/82136c52a0.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/frontend/libraries/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/frontend/libraries/gijgo/css/gijgo.min.css') }}"></script>
    <script src="{{ asset('/frontend/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> 
    <script>
      AOS.init();
  </script>
    <script src="{{ asset('/frontend/scripts/jquery.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/wow.min.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/jquery.nav.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/modernizr.custom.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/grid.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/stellar.js') }}"></script>
    <script src="{{ asset('/frontend/scripts/custom.js') }}"></script>
@stop