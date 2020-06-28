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
                <div class="col-lg-1">
                  <button class="btn btn-back" onclick="location.href='/payment';"><i class="fas fa-angle-left"></i></button>
                </div>
                <div class="col-lg-9">
                    <h5>Credit Card</h5>
                    <form class="form-cc">
                        <div class="form-group">
                            <label for="inputCCNum">Credit Card Number</label>
                            <input type="number" class="form-control" id="inputCCNum" name="inputCCNum">
                        </div>
                       <div class="row">
                           <div class="col-lg-6">
                               Expiry Date
                               <div class="form-group row d-flex align-items-center">
                                   <div class="col-lg-5">
                                       <input type="number" class="form-control" id="inputCCNum" name="inputCCNum">
                                   </div>
                                   /
                                   <div class="col-lg-5">
                                       <input type="number" class="form-control" id="inputCCNum" name="inputCCNum">
                                   </div>
                               </div>
                           </div>
                           <div class="col-lg-6">
                               <div class="row d-flex align-items-end">
                                   <div class="col-lg-6">
                                       <label for="inputCCNum">CVV</label>
                                       <input type="number" class="form-control" id="inputCCNum" name="inputCCNum">
                                   </div>
                                   <div class="col-lg-6">
                                       <img src="{{ asset('/frontend/img/cc@4x.png') }}" class="img-fluid" alt="">
                                   </div>
                               </div>
                           </div>
                       </div>
                       <p class="mt-5">By continuing this, you agree to our <a href="">Terms</a>, <a href="">Data Policy</a>, and <a href="">Cookie Policy</a> </p>
                       <div class="form-group row">
                        <div class="col-sm-10">
                          <button type="submit" class="btn btn-success px-5">Save</button>
                        </div>
                      </div>
                    </form>
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