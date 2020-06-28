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
                    <h1>Welcome Back, {{ Auth::user()->child_fullname }}</h1>
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
                  <button class="btn btn-back"  onclick="location.href='/educational_formal';"><i class="fas fa-angle-left"></i></button>
                </div>
                <div class="col-lg-9">
                    <h5 class="mb-4">Edit Formal School</h5>
                    <form action="/educationalFormalEdit/simpan" enctype="multipart/form-data" method="POST" class="form-formalschool">
                        @csrf
                        <input type="hidden" name="id" value="{{$dataEducationFormal->id}}">
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <div class="row">
                            <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputName" name="name" value="{{$dataEducationFormal->name}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <div class="row">
                            <label for="inputClass" class="col-sm-3 col-form-label">Class</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputClass" name="class" value="{{$dataEducationFormal->class}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <div class="row">
                            <label for="inputSchoolAddress" class="col-sm-3 col-form-label">School Address</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputSchoolAddress" name="school_address" value="{{$dataEducationFormal->school_address}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-7">
                          <div class="row">
                            <label for="inputProvince" class="col-sm-5 col-form-label">Province</label>
                            <div class="col-sm-7">
                              <input type="text" class="form-control" id="inputProvince" name="province" value="{{$dataEducationFormal->province}}">
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="row">
                            <label for="inputCity" class="col-sm-4 col-form-label">City</label>
                            <div class="col-sm-8">
                              <input type="text" class="form-control" id="inputCity" name="city" value="{{$dataEducationFormal->city}}">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <div class="row">
                            <label for="inputExtracurricular" class="col-sm-3 col-form-label">Extracurricular</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputExtracurricular" name="extracurricular" value="{{$dataEducationFormal->extracurricular}}">
                            </div>
                          </div>
                        </div>
                      </div>
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