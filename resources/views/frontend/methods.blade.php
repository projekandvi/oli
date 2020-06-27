@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('content')
<!-- section methods -->
<section class="section-methods">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="judul-method">Methods</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 text-center">
      <div class="judul-metode jm-1">Explore</div>
        <div class="card">
          <img src="{{ asset('/frontend/img/card2@4x.png') }}" class="card-img-top" alt="">
          <div class="card-body">
            <button class="btn bc bc-1" data-method=".metod-1">Learn More</button>
          </div>
        </div>
    </div>
    <div class="col-lg-4 text-center">
      <div class="judul-metode jm-2">Discover</div>
      <div class="card">
        <img src="{{ asset('/frontend/img/card@4x.png') }}" class="card-img-top" alt="">
        <div class="card-body">
          <button href="#" class="btn bc bc-2" data-method=".metod-2">Learn More</button>
        </div>
      </div>
    </div>
    <div class="col-lg-4 text-center">
      <div class="judul-metode jm-3">Grow</div>
      <div class="card">
        <img src="{{ asset('/frontend/img/card3@4x.png') }}" class="card-img-top" alt="">
        <div class="card-body">
          <button class="btn bc bc-3" data-method=".metod-3">Learn More</button>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section methods -->

<!-- section content method -->
<section class="section-content-methods metod-2">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 method-image">
        <img src="{{ asset('/frontend/img/Discover@4x.png') }}" alt="">
      </div>
      <div class="col-lg-6 method-explain">
        <h1>Discover</h1>
        <p>Program Aktifitas discover anak berguna membantu menemukan bakat-bakat
          anak yang terpendam  melalui aktivitas kompetisi, mengembangkan kognitif dan menumbuhkan rasa percaya diri anak.
          <br><br>
          Discover programs are focussing to discover kid's unscouted talents through the designed acitivities and competitions, so the outcome will expand their cognitive aspect and build up self esteem.</p>
      </div>
    </div>
  </div>
</section>
<!-- akhir section content method -->

<!-- section content method -->
<section class="section-content-methods metod-1">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 method-explain">
        <h1>Explore</h1>
        <p>Aktifitas eksplorasi anak berguna untuk meningkatkan kecerdasan dan melatih koordinasi otot motorik anak. Saat bereksplorasi, anak akan mengalami proses belajar. Dari situlah akan terbentuk pribadi anak secara utuh.
          <br><br>
          Kids exploration activity focussing to enhance inteligency and train kid's motoric muscle, we are designing the learning process to inline with the exploration activities so the outcome will be the best result for the kids and parent in term of self exploration</p>
      </div>
      <div class="col-lg-6 method-image">
        <img src="{{ asset('/frontend/img/explore@4x.png') }}" alt="">
      </div>
    </div>
  </div>
</section>
<!-- akhir section content method -->

<!-- section content method -->
<section class="section-content-methods metod-3">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 method-explain">
        <h1>Grow</h1>
        <p>Program kegiatan grow  bertujuan untuk membantu mengoptimalkan kemampuan anak dalam berbagai bidang kegiatan seperti bernyanyi dan menari 
          <br><br>
          Grow programs are designed to optimizing kid's ability in any kind of performing acts such as singing and dancing.</p>
      </div>
      <div class="col-lg-6 method-image">
        <img src="{{ asset('/frontend/img/grow@4x.png') }}" alt="">
      </div>
    </div>
  </div>
</section>
<!-- akhir section content method -->
@stop

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

<script>
  function hideAllMethods() {
      $(".section-content-methods").hide();
  }
      
  $(".bc").click(function() {
    var data = $(this).data();

    var method = data.method;
    // console.log(data);
    hideAllMethods();
    
    $(method).fadeIn("fast");
  });

  $(".bc").click(function() {
    var data = $(this).data();
    var method = data.method;
    
    $('html, body').animate({
      scrollTop: $(method).offset().top
    }, 1000);
  });

  window.onload = hideAllMethods;
  
</script>
@stop