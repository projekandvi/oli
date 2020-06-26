@extends('olimpyaKidsLayout.master')

@section('content')
<!-- Section Belajar -->
<section class="section-belajar">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        <div data-aos="fade-down">
          <img src="{{ asset('/frontend/') }}img/belajar.png" class="titlebelajar" alt="">
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
        <h3 class="playsoon">PLAYING SOON</h3>
        <a href="#" class="btn tombol btn-notifyme">
          Notify Me
        </a>
      </div>
    </div>
  </div>
</section>
<!-- Akhir Section Belajar -->
@stop

@section('js')
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
    <script src="https://kit.fontawesome.com/82136c52a0.js" crossorigin="anonymous"></script>
    <script src="{{ asset('/frontend/libraries/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('/frontend/libraries/gijgo/css/gijgo.min.css') }}"></script>
    <script src="{{ asset('/frontend/libraries/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@stop