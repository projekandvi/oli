@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/gijgo/css/gijgo.min.css') }}" >
@endsection

@section('content')

    <!-- header -->
    <div class="section-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-center headeruser p-4">
                    <h1>Welcome Back, {{$dataUser->child_fullname}}</h1>
                    <a href="" class="text-white">Add Image</a>
                </div>
            </div>
        </div>
    </div>
    <!-- akhir header -->

    <!-- section menu -->
    <div class="section-menu">
        <div class="container section-menus p-4">
          <div class="row">
            <div class="col-lg-3 user-menus">
              @include('personalData.menu')
            </div>
            <div class="col-lg-9">
              <div class="row">
                <div class="col-sm-1">
                  <button class="btn btn-back" onclick="location.href='/setting';"><i class="fas fa-angle-left"></i></button>
                </div>
                <div class="col-sm-11">
                  <h5 class="mb-4">Payment</h5>
                </div>
              </div>
              <div class="row mb-3 ed-container menu-ed d-flex align-items-center">
                <div class="col-lg-11">
                    <h6 class="text-white">OVO, GOPAY, LinkAja, DANA</h6>
                </div>
                <div class="col-lg-1 text-right">
                  <button class="btn btn-back next" onclick="location.href='/payment_method';"><i class="fas fa-angle-right"></i></button>
                </div>
              </div>
              <div class="row mb-3 ed-container menu-ed  d-flex align-items-center">
                <div class="col-lg-11">
                    <h6 class="text-white">Credit Card</h6>
                </div>
                <div class="col-lg-1 text-right">
                  <button class="btn btn-back next" onclick="location.href='/credit_card';"><i class="fas fa-angle-right"></i></button>
                </div>
              </div>
              <div class="row mb-3 ed-container menu-ed  d-flex align-items-center">
                <div class="col-lg-11">
                    <h6 class="text-white">Debit Card</h6>
                </div>
                <div class="col-lg-1 text-right">
                  <button class="btn btn-back next" onclick="location.href='/debit_card';"><i class="fas fa-angle-right"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- section menu -->
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
    <script src="{{ asset('/frontend/libraries/gijgo/js/gijgo.min.js') }}"></script>

    <script>
        AOS.init();
        $(document).ready(function() {
          $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            minDate: '1/1/2008',
          });
        });
    </script>
@stop