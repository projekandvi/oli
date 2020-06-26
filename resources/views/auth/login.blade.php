<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <title>Sign In | Olimpya Kids</title>
  </head>

  <body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="http://olimpyakids.com/">
              <img src="{{ asset('/frontend/img/header/logo.png') }}" alt="Olimpya Kids">
            </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item btn tombol aboutus mx-2 my-auto justify-content-center btn-group dropdown" data-aos="fade-left">
                      <a class="dropdown-toggle" role="button" id="navbarDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">About Us</a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropDown">
                        <a class="dropdown-item" href="/aboutus">What is Olimpya Kids</a>
                        <a class="dropdown-item" href="/methods">Methods</a>
                        <a class="dropdown-item" href="#">Our Team</a>
                        <a class="dropdown-item" href="#">Our Office</a>
                      </div>
                    </li>
                    <a class="nav-item btn tombol belajar mx-2 my-auto justify-content-center btn-group" href="/belajar" data-aos="fade-left" data-aos-delay="100">
                      <img src="{{ asset('/frontend/img/header/belajarnav.png') }}" alt="">
                    </a>
                    <a class="nav-item btn tombol partner mx-2 my-auto justify-content-center" href="partners" data-aos="fade-left" data-aos-delay="150">Partners</a>
                    <a class="nav-item btn tombol store mx-2 my-auto justify-content-center" href="/store" data-aos="fade-left" data-aos-delay="200">Store</a>
                    <a class="nav-item btn tombol news mx-2 mr-3 my-auto justify-content-center" href="/news" data-aos="fade-left"data-aos-delay="250">News</a>
                    <li class="nav-item nav-link language mx-2 btn-group dropdown" data-aos="fade-left">
                      <img src="{{ asset('/frontend/img/header/en.png') }}" class ="dropdown-toggle" role="button" id="navbarDropDown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" alt="">EN
                      <div class="dropdown-menu" aria-labelledby="navbarDropDown">
                        <a class="dropdown-item" href="#"> <img src="{{ asset('/frontend/img/header/en.png') }}" alt="">EN</a>
                        <a class="dropdown-item" href="#"> <img src="{{ asset('/frontend/img/header/id.png') }}" alt="">ID</a>
                      </div>
                    </li>
                    <a class="nav-item nav-link signin mx-2" href="/login" data-aos="fade-left" data-aos-delay="300">Sign In</a>
                  </ul>

            </div>
        </div>
    </nav>
    <!-- akhir Navbar -->

    <!-- section user login -->
    <div class="container">
      <section class="section-login bg-sign d-flex justify-content-center">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="login-card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="{{ asset('/frontend/img/login@4x.png') }}" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div></div>
                    <div class="d-flex justify-content-center form_container">
                      <form role="form" method="POST" action="{{ route('login') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <h5 class="text-center mb-3">User Login</h5>
                            <div class="input-group mb-3">
                                <input type="text" name="email" class="form-control input_user" value="" placeholder="please enter email address" autofocus>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-2">
                                <input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3ß">
                                <button type="submit" name="button" class="btn login_btn">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            <a href="#" class="ml-2 text-sm text-secondary">Forgot Password? </a>
                        </div>
                        <div class="d-flex justify-content-center links">
                          or
                          <a href="/signup" class="ml-2 text-secondary">New User?</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    </div>
    <!-- akhir user login -->
    
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
  </body>

</html>