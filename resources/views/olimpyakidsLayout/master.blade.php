<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    
	  
    @yield('css')


    <title>Olimpyakids</title>
    
    <!-- 1. Addchat css -->
    @yield('Addchat_css')
    
  </head>

  <body>
    <!-- 2. AddChat widget -->
    @yield('Addchat_widget')
    
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
                    @if (Auth::check())
                    <a class="nav-item nav-link signin mx-2" href="{{ route('logout') }}" data-aos="fade-left" data-aos-delay="300" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="glyph-icon icon-power-off"></i>
                          Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    @else                    
                    <a class="nav-item nav-link signin mx-2" href="/login" data-aos="fade-left" data-aos-delay="300">Sign In</a>
                    @endif
                    
                  </ul>

            </div>
        </div>
    </nav>
    <!-- akhir Navbar -->

    @yield('content')

    @yield('footer')

    <!-- 3. AddChat JS -->
    @yield('Addchat_js')
    
    
    @yield('js')
  </body>

</html>