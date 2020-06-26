@extends('olimpyaKidsLayout.master')

@section('content')
 <!-- section official partner-->
 <section class="section-official-partner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="judul-off-partner">Official Partners</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 text-center justify-content-center">
        <div class="pic-off-partner text-center"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
      <div class="col-lg-3 text-center justify-content-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
      <div class="col-lg-3 text-center justify-content-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
      <div class="col-lg-3 text-center justify-content-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- akhir section official partner-->

<!-- section official sponsor-->
<section class="section-official-partner sponsor">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="judul-off-partner">Sponsors</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 text-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
      <div class="col-lg-3 text-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
      <div class="col-lg-3 text-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
      <div class="col-lg-3 text-center">
        <div class="pic-off-partner"></div>
        <h5 class="name-off-partner">Lorem Ipsum</h5>
        <div class="desc-off-partner">
          <h6>Sponsors</h6>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- akhir section official sponsor-->
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