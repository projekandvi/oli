@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('content')
<!-- Jumbotron -->
<div class="jumbotron jumbotron-fluid">
    <img src="{{ asset('/frontend/img/jumbotron.png') }}" class="figur" data-aos="zoom-in-left" data-aos-delay="150"alt="">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h1 class="tagline" data-aos="zoom-in">Explore</h1>
          <h1 class="tagline2" data-aos="zoom-in" data-aos-delay="50">Discover &<br><span>Grow</span></h1>
          <a href="#" class="btn tombol tbl-learnmore" data-aos="zoom-in"data-aos-delay="100">Learn More</a>
        </div>
        <div class="col-lg-8 figur">
          <!-- <img src="img/jumbotron.png" alt=""> -->
        </div>
      </div>
    </div>
  </div>
  <!-- akhir Jumbotron -->

  <!-- section Video -->
  <section class="section-video">      
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h1 class="tagvideo" data-aos="fade-right">A Wonderland <br>in Your Hand</h1>
        </div>
      </div>
      <div class="row justify-content-center">
        <i class="far fa-play-circle playvideo" data-aos="zoom-in" data-aos-delay="50"></i>
      </div>
    </div>
  </section>
  <!-- akhir section Video -->

  <!-- Section Belajar -->
  <section class="section-belajar">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
          <div data-aos="fade-down">
            <img src="{{ asset('/frontend/img/belajar.png') }}" class="titlebelajar" alt="">
          </div>
        </div>
      </div>
      <div class="row justify-content-center taglinebelajar">
        <div class="col-lg-12">
          <h2 class="tagbelajar tb-best" data-aos="zoom-in">THE BEST</h2>
          <h2 class="tagbelajar virtu-e" data-aos="zoom-in">VIRTUAL EDUCATION</h2>
          <h2 class="tagbelajar in-indo" data-aos="zoom-in">IN INDONESIA</h2>
        </div>
      </div>
      <div class="row justify-content-center notifyme">
        <div class="col-lg-12 text-center">
          <h3 class="playsoon" data-aos="zoom-in">PLAYING SOON</h3>
          <a href="#" class="btn tombol btn-notifyme" data-aos="zoom-in" data-aos-delay="50">
            Notify Me
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Section Belajar -->

  <!-- Section Event Partner -->
  <section class="section-event-partner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="judul-event-partner">Our Event Partner</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3  text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3  text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
      </div>
      <div class="row justify-content-center learnmore-event">
        <div class="col-lg-12 text-center">
          <a href="#" class="btn tombol btn-learnmore">
            Learn More
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Akhir Section Event Partner -->

  <!-- Section colocates -->
  <section class="section-colocated-event">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="judul-colocated-event">Our Co-located Events</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/avatar.png') }}" class = "avatar" alt="">
        </div>
        <div class="col-lg-3 text-center">
          <img src="{{ asset('/frontend/img/colocated.png') }}" class = "avatar" alt="">
        </div>
      </div>
    
      <div class="row justify-content-center learnmore-colocated">
        <div class="col-lg-12 text-center">
          <a href="#" class="btn tombol btn-learnmore">
            Learn More
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- akhir Section colocates -->
@stop

@section('footer')
    <!-- Contact -->
    <section class="section-contact" id="sect-contact">
        <div class="container">
          <div class="row">
            <div class="col-lg-5">
              <h1>CONTACT US</h1>
              <h3>Head Quarter :</h3>
              <p>PT Global Kertapati EXPERIA<br>
                 Jl Jeruk Purut 56A, Kel Cilandak<br>
                 Jakarta Selatan, Indonesia - 12560 <br>
                 Phone : +62 21 27874146
             </p>
             <h3>Sales & Marketing :</h3><br><br>
             <hr class="mdiv">
            </div>
            <div class="col-lg-7 formulir">
              <h1>Apa yang bisa kita bantu?</h1>
              <form>
                 <div class="form-row isian">
                   <div class="form-group col-md-6">
                     <input type="text" class="form-control" id="inputEmail4" placeholder="First Name">
                   </div>
                   <div class="form-group col-md-6">
                     <input type="password" class="form-control" id="inputPassword4" placeholder="Last Name">
                   </div>
                 </div>
                 <div class="form-row">
                   <div class="form-group col-md-6">
                     <input type="number" class="form-control" id="inputEmail4" placeholder="Phone">
                   </div>
                   <div class="form-group col-md-6">
                     <input type="email" class="form-control" id="inputPassword4" placeholder="Email">
                   </div>
                 </div>
                 <div class="form-group">
                   <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter your message here..."></textarea>
                 </div>
                 <button class="btn btn-primary">SUBMIT</button>
               </form>
            </div>
          </div>
        </div>
      </section>
      <!-- akhir section kontak -->
  
      <section class="section-footer">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="d-flex flex-row icons">
                  <div class="p2 px-2"><a href="#"><i class="fab fa-youtube"></i></a></div>
                  <div class="p2 px-2"><a href="#"><i class="fab fa-twitter"></i></a></div>
                  <div class="p2 px-2"><a href="#"><i class="fab fa-facebook-f"></i></a></div>
                  <div class="p2 px-2"><a href="#"><i class="fab fa-instagram"></i></a></div>
                  <div class="p2 px-2"><a href="#"><img src="{{ asset('/frontend/images/channel/tiktok.png') }}" alt=""></a></div>
                </div>
            </div>
          </div>
        </div>
      </section>
@endsection

@section('js')
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/82136c52a0.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/frontend/libraries/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/frontend/jquery.easeScroll.js') }}"></script>
    <script src="{{ asset('/frontend/libraries/gijgo/css/gijgo.min.css') }}"></script>
    <script src="{{ asset('/frontend/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@stop