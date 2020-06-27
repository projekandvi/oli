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
                    <h1>Welcome Back, GeorgeMid14!</h1>
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
                <div class="col-lg-2 text-center">
                  <img src="{{ asset('/frontend/img/george@4x.png') }}" class="img-fluid profile-photo" alt="">
                  <div class="tombol-menu-user mb-2"><i class="far fa-eye mx-2"></i><i class="fas fa-sync-alt mx-2"></i></div>
                  <div class="form-group form-childstage">
                    <label for="inputChildStage">Educational Stage</label>
                    <select class="form-control" id="inputEducationalStage" name="inputEducationalStage">
                      <option selected disabled>Educational Stage</option>
                      <option>Playgroup</option>
                      <option>Pre-Kindergarten</option>
                      <option>Kindergarten</option>
                      <option>1st Grade</option>
                      <option>2nd Grade</option>
                      <option>3rd Grade</option>
                      <option>4th Grade</option>
                      <option>5th Grade</option>
                      <option>6th Grade</option>
                    </select>
                  </div>
                  <div class="rank">Rank<img class="img-fluid" src="{{ asset('/frontend/img/rank@4x.png') }}" alt=""></div>
                </div>
                <div class="col-lg-10">
                  <form class="myprofile">
                    <div class="form-group row">
                      <div class="col-lg-8">
                        <div class="row">
                          <label for="inputEmail3" class="col-sm-3 col-form-label">Full Name</label>
                          <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputEmail3" value="{{$dataUser->child_fullname}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="row">
                          <label for="inputEmail3" class="col-sm-4 col-form-label">Gender</label>
                          <div class="radio-gender col-sm-8 d-flex justify-content-center">
                            <div class="form-check form-check-inline mx-3">
                              <input class="form-check-input" type="radio" name="radioGender" id="inlineRadio1" value="option1" checked>
                              <label class="form-check-label" for="inlineRadio1"><i class="fas fa-mars"></i></label>
                            </div>
                            <div class="form-check form-check-inline mx-3" id="female">
                              <input class="form-check-input" type="radio" name="radioGender" id="inlineRadio2" value="option2">
                              <label class="form-check-label" for="inlineRadio2"><i class="fas fa-venus"></i></label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputFullName" class="col-sm-4 col-form-label">Username</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputFullName" name="inputFullName" value="{{$dataUser->child_username}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputPhone" class="col-sm-4 col-form-label">Phone No</label>
                          <div class="col-sm-8">
                            <input type="tel" class="form-control" id="inputPhone" name="inputPhone">
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputBio" class="col-sm-4 col-form-label">Bio</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputBio" name="inputBio" placeholder="">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputBirthday" class="col-sm-4 col-form-label">Birthday</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control datepicker" id="inputBirthday" name="inputBirthday" value="{{$dataUser->child_birthday}}">
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputHobby" class="col-sm-4 col-form-label">Hobby</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputHobby" name="inputHobby" placeholder="">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-12">
                        <div class="row">
                          <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputAddress" name="inputAddress" value="{{$dataUser->address}}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputCountry" class="col-sm-4 col-form-label">Country</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputCountry" name="inputCountry" value="{{$dataUser->country}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputProvince" class="col-sm-5 col-form-label">Province</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputProvince" name="inputProvince" value="{{$dataUser->province}}">
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputCity" class="col-sm-4 col-form-label">City</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputCity" name="inputCity" value="{{$dataUser->city}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputSubdis" class="col-sm-5 col-form-label">Sub-disctrict</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" id="inputSubdis" name="inputSubdis" value="{{$dataUser->sub_district}}">
                          </div> 
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputDistrict" class="col-sm-4 col-form-label">District</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputDistrict" name="inputDistrict" value="{{$dataUser->district}}">
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="row">
                          <label for="inputPostcode" class="col-sm-5 col-form-label">Postal Code</label>
                          <div class="col-sm-7">
                            <input type="number" class="form-control" id="inputPostcode" name="inputPostcode" value="{{$dataUser->postal_code}}">
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