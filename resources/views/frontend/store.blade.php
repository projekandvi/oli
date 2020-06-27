@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('content')
<!-- carousel -->
<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{ asset('/frontend/img/store/Asset 9@4x.png') }}" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/frontend/img/store/Asset 9@4x.png') }}" class="d-block w-100" alt="...">
      
    </div>
    <div class="carousel-item">
      <img src="{{ asset('/frontend/img/store/Asset 9@4x.png') }}" class="d-block w-100" alt="...">
      
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
      <!-- akhir carousel -->

<!-- section-stores -->
<div class="section-stores">
    <div class="container">
        <div class="row store-row-1 my-4">
            <div class="col-lg-9 text-center testi d-flex align-items-center">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-1"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
                    <div class="col-lg-10">
                        <h5>What Our Customers Have To Say</h5>
                        <br>
                        Very happy and excited about the toys they sell. I can tell they've done
                        their research and carefully chosen and design innovative, stimulating,
                        and educational toys. My new favorite toy website I shop 1st while shopping
                        for any kids gifts from the ages 0-14.
                        <br><br>
                        - Deanna
                    </div>
                    <div class="col-lg-1"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                </div>
            </div>
            <div class="col-lg-3 new-release">
                <h2>NEW RELEASES</h2>
                <a href="">COLLECTIONS <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <img src="{{ asset('/frontend/img/store/Asset 1@4x.png') }}" alt="">
            </div>
        </div>

        <div class="row store-row-2 my-4">
            <div class="col-lg-6 baby-toys">
                <h2>BABY TOYS <br> & GIFTS</h2>
                <a href="">COLLECTIONS <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <img src="{{ asset('/frontend/img/store/Asset 2@4x.png') }}" alt="">
            </div>
            <div class="col-lg-6 baby-toys">
                <img src="{{ asset('/frontend/img/store/Asset 3@4x.png') }}" alt="">
            </div>
        </div>

        <div class="row store-row-3">
            <div class="col-lg-3 last-row">
                <a href="">BIRTHDAY <br> CONCIERGE <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <img src="{{ asset('/frontend/img/store/Asset 4@4x.png') }}" alt="">
            </div>
            <div class="col-lg-3 last-row">
                <a href="">SPECIAL <br> NEEDS <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <img src="{{ asset('/frontend/img/store/Asset 5@4x.png') }}" alt="">
            </div>
            <div class="col-lg-3 last-row">
                <a href="">EDUCATORS <br> EXTRA CREDIT <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                <img src="{{ asset('/frontend/img/store/Asset 6@4x.png') }}" alt="">
            </div>
            <div class="col-lg-3 last-row">
                <a href="">FOR <br> BUSSINESS <i class="fa fa-angle-right ml-auto" aria-hidden="true"></i></a>
                <img src="{{ asset('/frontend/img/store/Asset 7@4x.png') }}" alt="">
            </div>
        </div>
    </div>
</div>
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
    <script>
        AOS.init();
    </script>
@stop