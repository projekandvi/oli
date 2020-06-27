@extends('olimpyaKidsLayout.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('/frontend/libraries/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/frontend/style/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
@endsection

@section('content')

    <!-- Section AboutUs -->
    <section class="section-about">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-2">
                  <img src="{{ asset('/frontend/img/about2@4x.png') }}" alt="">
              </div>
              <div class="col-lg-8 text-center">
                  <h2 class="judul-about">What is Olimpya Kids</h2>
              </div>
              <div class="col-lg-2">
                  <img src="{{ asset('/frontend/img/about@4x.png') }}" alt="">
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-lg-10 text-center">
                  <p class="content-about">
                      Olimpya Kids is the biggest Interactive-Fun-Learning experience activities for children and family.  Provided by active learning opportunities platform that support the exploration and discovery skill to boost fun, natural and social interactions.  It is driven and created by value in their growth time. <br>
                      <br>
                      We will supporting support and accompanying accompany kids in their growth time to Discover, Explore and Grow their potential and Ability for their Future. It is developed by Experia - the Event Marketing Company. <br>
                      <br>
                      Olimpya kids adalah media merupakan tempat belajar interaktif untuk anak dan keluarga dan menghadirkan pengalaman menyenangkan dan juga didukung oleh media pembelajaran aktif untuk memaksimalkan kemampuan, interaksi sosial secara alami dan kreatif. <br>
                      <br>
                      Kami akan mendukung dan menemani anak anak di masa pertumbuhan mereka agar bisa EXPLORE – DISCOVER – GROW kemampuan dan potensi mereka. Olimpya kids dikembangkan oleh Global Experia  – Perusahaan Event Marketing. <br>
                  </p>
              </div>
          </div>
          <div class="row justify-content-center">
              <div class="col-12 text-center about-point">
                  <h3>Our Vision</h3>
                  <p>To be the leader among the children Interactive-Fun-Learning experience platform in Indonesia. <br>
                      <br>
                      Untuk menjadi wadah pembelajaran interaktif  anak yang terdepan dan memberikan pengalaman bermain yang menyenangkan.</p>
              </div>
          </div>

          <div class="row justify-content-center">
              <div class="col-12 text-center about-point abt-mission">
                  <h3>Our Mision</h3>
                  <p>Olimpya Kids is committed to promoting Indonesia's children activities platform and further serves to ensure that Olimpya Kids is stands out so we will be working close with essential stakeholders in academic world,  government, child care organization, industry and many more.
                      <br><br>
                      Olimpya Kids will bring together the benefits combines them with the joy and wonder of the play-learn-compete arena. The platform also will be particularly special as it is an occasion where children can interact together with their families and encouraged to enjoy and explore the activities.
                      <br><br>
                      Olimpya kids berkomitmen untuk menghadirkan festival anak-anak yang unik dan berbeda.  Dan berkolaborasi dengan berbagai pemangku kepentingan seperti akademisi, lembaga pemerintahan, organisasi pemerhati anak, pelaku industri dan lainnya.
                      <br><br>
                      Olimpya Kids menghadirkan berbagai wahana permainan yang kompetitif dan menyenangkan sebagai tempat eksplorasi berbagai kegiatan dan berinteraksi bersama keluarga.
                      </p>
              </div>
          </div>
      </div>
  </section>
  <!-- akhir Section AboutUs -->
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