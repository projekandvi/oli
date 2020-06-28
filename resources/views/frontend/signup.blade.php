@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('content')

    <!-- section createnew -->
    <div class="container">
        <section class="section-createnew bg-sign">
          <div class="row no-gutters">
              <div class="col-lg-6">
                  <img src="{{ asset('/frontend/img/signup@4x.png') }}" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6 pt-5 pl-5 pr-5">
                <h3 class="labelsignup">Sign Up Today!</h3>
                <form method="POST" action="/signup">
                  @csrf
                  <div class="form-row mt-3">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputFullName" placeholder="Full Name" name="child_fullname">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputUsername" placeholder="Username" name="child_username">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6 radio-gender justify-content-center">
                      <h6 class="radio-caption mb-0">Child's Gender</h6>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="child_gender" id="inlineRadio1" value="girl" checked>
                        <label class="form-check-label" for="inlineRadio1">Girl</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="child_gender" id="inlineRadio2" value="boy">
                        <label class="form-check-label" for="inlineRadio2">Boy</label>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <input type="date" class="form-control" id="inputBirthday" placeholder="Birthday (DD/MM/YYYY)" name="child_birthday">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password">
                    </div>
                    <div class="form-group col-md-6">
                      <select name="educational_stage" class="form-control">
                        <option disabled selected>Educational Stage</option>
                        <option value="Playgroup">Playgroup</option>
                        <option value="Pre-Kindergarten">Pre-Kindergarten</option>
                        <option value="Kindergarten">Kindergarten</option>
                        <option value="1st Grade">1st Grade</option>
                        <option value="2st Grade">2st Grade</option>
                        <option value="3st Grade">3st Grade</option>
                        <option value="4st Grade">4st Grade</option>
                        <option value="5st Grade">5st Grade</option>
                        <option value="6st Grade">6st Grade</option>
                      </select>
                      {{-- <input type="text" class="form-control" id="inputChildStage" placeholder="Child's Stage" name="educational_stage"> --}}
                    </div>
                  </div>
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputParentName" name="parent_fullname" placeholder="Parent's Full Name">
                    </div>
                    <div class="form-group col-md-6 radio-gender mt-2">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="parent_gender" id="inlineRadio1" value="Female" checked>
                        <label class="form-check-label" for="inlineRadio1">Female</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="parent_gender" id="inlineRadio2" value="Men">
                        <label class="form-check-label" for="inlineRadio2">Male</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <input type="email" class="form-control" id="inputParentEmail" name="parent_email" placeholder="Parent's Email">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="tel" class="form-control" id="inputParentPhone" name="parent_phone" placeholder="Parent's Phone Number">
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="inputAlamat" name="address" placeholder="Address">
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputCountry" name="country" placeholder="Country">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputProvince" name="province" placeholder="Province">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputCity" name="city" placeholder="City">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputSubDistrict" name="sub_district" placeholder="Sub-district">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <input type="text" class="form-control" id="inputDistrict" name="district" placeholder="District">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="number" class="form-control" id="inputPostal" name="postal_code" placeholder="Postal Code">
                    </div>
                  </div>
                  <h6 class="disclaimer-policy">By clicking Sign Up, you agree to our <a href="">Terms</a>, <a href="">Data Policy</a>, and <a href="">Cookie Policy</a>, you may receive email notification from us and you can opt out any time </h6>
                  <button type="submit" class="btn btn-success signup mb-3">Sign Up</button>
                </form>
              </div>
          </div>
        </section>
      </div>
      <!-- akhir section signup -->
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
@stop