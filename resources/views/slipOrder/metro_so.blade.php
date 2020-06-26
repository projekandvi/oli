<!DOCTYPE html>
<html>
  <head>
      <meta charset="UTF-8">
      <title> 
          @section('title') Cosan CRM @show
      </title>
      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
      <script src="{{ asset('/assets/js-core/modernizr.js') }}"></script>
      <!-- CSS -->
      <link rel="stylesheet" href="{{ asset('/build/base.a860b4298c9d804b3c70.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css-core/custom.css') }}">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
      @if(app()->getLocale() == 'ar')
      <link rel="stylesheet" href="{{ asset('/assets/css-core/bootstrap.rtl.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css-core/theme-rtl.css') }}">
      @endif
      <link href="{{ asset('/img/intelle_stock.png') }}" rel="icon" type="image/gif" sizes="16x16">
      <script src="{{ asset('/build/vendor.a860b4298c9d804b3c70.js') }}"></script>        
      <script src="{{ asset('/css/metro.css') }}"></script>  
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">    
      <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,300);
        .wrap, .wrap2, .start {
          width: 100%;
          height: auto;
          margin: 27px 27px;
          float: left;
        }

        * {
          margin: 0;
          padding: 0;
          outline: none;
          border: none;
          box-sizing: border-box;
          -webkit-font-smoothing: antialiased;
          -moz-font-smoothing: antialiased;
          -ms-font-smoothing: antialiased;
          -o-font-smoothing: antialiased;
          font-smoothing: antialiased;
        }

        html {
          width: 100%;
          background: #004050;
        }

        .wrap2 {
          width: 60% !important;
        }

        div[class^="metro"] {
          float: left;
          margin: 0 7% 2% 0;
          position: relative;
          cursor: pointer;
          transition: all .4s ease;
          user-drag: element;
          border: solid 2px transparent;
        }
        div[class^="metro"]:hover {
          border: solid 2px mintcream;
          box-shadow: 0px 0px 6px 4px rgba(53, 89, 100, 0.5);
        }
        div[class^="metro"]:active {
          -webkit-transform: scale(0.98, 0.98);
                  transform: scale(0.98, 0.98);
        }

        .metro-huge {
          width: 26%;
          height: 173px;
        }
        .metro-huge p {
          font-size: 13px;
          color: white;
          text-align: center;
        }

        .metro-big {
          width: 21%;
          height: 135px;
        }

        .metro-small {
          width: 95px;
          height: 95px;
        }

        .start {
          @import url(https://netdna.bootstrapcdn.com/font-awesome/2.0/css/font-awesome.css);
          color: white;
          font: 300 49px AwesomeFont, Open Sans;
          margin-bottom: 10px;
          cursor: pointer;
          -webkit-user-select: none;
            -moz-user-select: none;
              -ms-user-select: none;
                  user-select: none;
          display: inline-block;
          transition: all .3s ease;
        }
        .start:hover {
          text-shadow: 0 0 1px white;
        }

        .space {
          margin-bottom: 10px;
        }

        .label {
          position: absolute;
          color: white;
          font: 500 17px Segoe UI Light, Open Sans;
          -webkit-user-select: none;
            -moz-user-select: none;
              -ms-user-select: none;
                  user-select: none;
        }

        .bottom {
          bottom: 0px;
        }

        .top {
          top: 5px;
        }

        .chat {
          background: #d61300;
        }

        .calendar {
          background: #00a9ec;
        }

        .store {
          background: #ff9000;
        }

        .ie {
          background: #00a9ec;
        }

        .people {
          background: #0e5d30;
        }

        .video {
          background: #8b0189;
        }

        .chrome {
          background: #ce4e4e;
        }

        .photo {
          background: url(http://lorempixel.com/200/95/people);
          background-position: -2px -2px;
        }
        .photo img {
          top: -4px;
          left: -4px;
          position: absolute;
          opacity: 0;
          -webkit-animation: fade 8s ease-in-out infinite 8s;
                  animation: fade 8s ease-in-out infinite 8s;
          z-index: 0;
          border: solid 2px transparent;
          transition: all .3s ease;
        }
        .photo img:hover {
          border: solid 2px mintcream;
        }

        .music {
          background: #5f5f5f;
          -webkit-animation: flip 6s linear infinite;
                  animation: flip 6s linear infinite;
          -webkit-transform: rotateX(0deg);
                  transform: rotateX(0deg);
        }

        .games {
          background: #00ff00;
        }

        .twitter {
          background: #5AC6FA;
        }

        .gp {
          background: #d64136;
        }

        .fb {
          background: #3b5998;
        }

        .cnn {
          background: #fe0000;
        }

        .ps {
          background: #0c5fa1;
        }

        .bt {
          background: #2546e9;
        }

        .cc {
          background: #d61300;
        }

        .wmp {
          background: #f68935;
        }

        .tube {
          background: #c8312b;
        }

        .skype {
          background: #19bfe5;
        }

        .steam {
          background: #59554F;
        }

        .play {
          background: #95C10D;
        }

        div[class^="icon"] {
            width: 100px;
            height: 100px;
            margin: 10px auto;
            background-size: 100px 100px;
        }


        .icon-invoice {
          background: url("/icon_cosan/invoice.png");
        }

        .icon-invoice_add {
          background: url("/icon_cosan/invoice_add.png");
        }

        .icon-lead {
          background: url("/icon_cosan/lead.png");
        }
        .icon-customer {
          background: url("/icon_cosan/customer.png");
        }
        .icon-instalasi {
          background: url("/icon_cosan/instalasi.png");
        }
        .icon-delivery {
          background: url("/icon_cosan/delivery.png");
        }
        .icon-tiket {
          background: url("/icon_cosan/tiket.png");
        }
        .icon-inventori {
          background: url("/icon_cosan/inventori.png");
        }
        .icon-akunting {
          background: url("/icon_cosan/akunting.png");
        }

        .icon-chat {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Other-Mail-alt-Metro-icon.png);
        }

        .icon-store {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Web-Microsoft-Store-Metro-icon.png);
        }

        .icon-ie {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Web-Browsers-Internet-Explorer-10-Metro-icon.png);
        }

        .icon-people {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Folders-OS-User-No-Frame-Metro-icon.png);
        }

        .icon-video {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Folders-OS-My-Videos-Metro-icon.png);
        }

        .icon-chrome {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Web-Browsers-Google-Chrome-Metro-icon.png);
        }

        .icon-music {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Apps-Google-Music-Metro-icon.png);
        }

        .icon-games {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Folders-OS-Games-alt-Metro-icon.png);
        }

        .icon-twitter {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Web-Twitter-alt-4-Metro-icon.png);
        }

        .icon-gp {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Web-Google-plus-Metro-icon.png);
        }

        .icon-fb {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Web-Facebook-alt-1-Metro-icon.png);
        }

        .icon-cnn {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Web-CNN-Metro-icon.png);
        }

        .icon-ps {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Apps-Adobe-Photoshop-Metro-icon.png);
        }

        .icon-bt {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Apps-Bluetooth-Metro-icon.png);
        }

        .icon-cc {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Apps-CCleaner-Metro-icon.png);
        }

        .icon-wmp {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Apps-Windows-Media-Player-Metro-icon.png);
        }

        .icon-tube {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/256/Web-YouTube-alt-1-Metro-icon.png);
        }

        .icon-skype {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Apps-Skype-Metro-icon.png);
        }

        .icon-steam {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Apps-Steam-alt-Metro-icon.png);
        }

        .icon-play {
          background: url(http://icons.iconarchive.com/icons/dakirby309/windows-8-metro/128/Web-Android-Market-Metro-icon.png);
        }

        ::-webkit-scrollbar {
          width: 10px;
          height: 10px;
          cursor: pointer;
        }

        ::-webkit-scrollbar-track {
          background: #007491;
        }

        ::-webkit-scrollbar-thumb {
          background: #002f3b;
          cursor: pointer;
        }

        ::-moz-selection {
          background: mintcream;
        }

        ::selection {
          background: mintcream;
        }

        @-webkit-keyframes flip {
          0% {
            -webkit-transform: rotateX(0deg);
                    transform: rotateX(0deg);
          }
          15% {
            -webkit-transform: rotateX(360deg);
                    transform: rotateX(360deg);
          }
          100% {
            -webkit-transform: rotateX(360deg);
                    transform: rotateX(360deg);
          }
        }

        @keyframes flip {
          0% {
            -webkit-transform: rotateX(0deg);
                    transform: rotateX(0deg);
          }
          15% {
            -webkit-transform: rotateX(360deg);
                    transform: rotateX(360deg);
          }
          100% {
            -webkit-transform: rotateX(360deg);
                    transform: rotateX(360deg);
          }
        }
        @-webkit-keyframes fade {
          0% {
            opacity: 0;
          }
          10% {
            opacity: 1;
          }
          50% {
            opacity: 1;
          }
          60% {
            opacity: 0;
          }
        }
        @keyframes fade {
          0% {
            opacity: 0;
          }
          10% {
            opacity: 1;
          }
          50% {
            opacity: 1;
          }
          60% {
            opacity: 0;
          }
        }
      </style>
  </head>
      
  <body class="add-transition pt-page-rotatePullTop-init">  
    <div id="page-wrapper">        
      @include('partials.mainheader') 
      @include('partials.sidebar')   
      
      <div id="page-content-wrapper" >
        <div id="page-content" style="min-height: 600px;">
          <div class="container">
            <!-- Content Header (Page header) -->
            <div id="page-title">
              <h2>
                @section('contentheader') 
                  COSAN CRM
                  <small style=" font-size: 12px; letter-spacing: 2px;">
                    <b>{{Auth::user()->name}}</b>
                  </small>
                @show
              </h2>
              <p>@section('contentheader_description') COSAN CRM @show</p>
                <ol class="breadcrumb">
                  <li> <a href="/"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
                  <li class="active"> Slip Order </li>
                </ol>
            </div>                      
            <div class="panel">          
              <!-- Main content -->
              <div class="panel-body" id="dw">
                <div class="row"> 
                  <div class="col-md-12">
                    <div class="col-md-6 col-xs-12" >
                      <div class="dashboard-box dashboard-box-chart bg-white content-box">
                        <div class="content-wrapper">
                          <div class="header">Statistik Penjualan</div>
                            <canvas id="stockChart" ></canvas>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-xs-12" >
                        <div class="dashboard-box dashboard-box-chart bg-white content-box">
                          <div class="content-wrapper">
                            <div class="header">Penyewaan Vs Pembelian Perbulan</div>
                              <canvas id="penyewaanvspembelian"></canvas>
                            </div>
                          </div>
                      </div>                  
                    </div>         
                    <div class="col-md-12">
                      {{-- ------------------------------------------------------------------------------- --}}
                      <div class="wrap">
                        
                        @if (Auth::user()->status === 'STAFF ACCOUNTING')
                          <a href="{{route('slipOrder.indexSewaRecurring')}}">
                            <div class="metro-huge chat">
                              <div class="icon-invoice"></div>
                              <p><b>{{$sewaRecurring}}</b> Invoice</p>
                                <span class="label bottom">Daftar Penjualan Sewa Recurring</span>
                            </div>
                          </a>
                                                        
                          <a href="{{route('slipOrder.indexSewaPeriode')}}">
                              <div class="metro-huge chat">
                                <div class="icon-invoice"></div>
                              <p><b>{{$sewaPeriode}}</b> Invoice</p>
                                <span class="label bottom">Daftar Penjualan Sewa Periode</span>
                            </div>
                          </a>

                          <a href="{{route('slipOrder.indexPutus')}}">
                              <div class="metro-huge chat">
                                <div class="icon-invoice"></div>
                                <p><b>{{$putus}}</b> Invoice</p>
                                <span class="label bottom">Daftar Penjualan Jual Putus</span>
                            </div>
                          </a>
                        @else
                          <a href="{{route('indexSlipOrderNew')}}">
                            <div class="metro-huge chat">
                              <div class="icon-invoice_add"></div>
                              {{-- <p>You have <b>3</b> unread messages.</p> --}}
                              <span class="label bottom">Buat Slip OrderMenu</span>
                            </div>
                          </a>
                        
                          <a href="{{route('slipOrder.indexSewaRecurring')}}">
                              <div class="metro-huge chat">
                                <div class="icon-invoice"></div>
                              <p><b>{{$sewaRecurring}}</b> Invoice</p>
                                <span class="label bottom">Daftar Penjualan Sewa Recurring</span>
                            </div>
                          </a>
                                                        
                          <a href="{{route('slipOrder.indexSewaPeriode')}}">
                              <div class="metro-huge chat">
                                <div class="icon-invoice"></div>
                              <p><b>{{$sewaPeriode}}</b> Invoice</p>
                                <span class="label bottom">Daftar Penjualan Sewa Periode</span>
                            </div>
                          </a>

                          <a href="{{route('slipOrder.indexPutus')}}">
                              <div class="metro-huge chat">
                                <div class="icon-invoice"></div>
                                <p><b>{{$putus}}</b> Invoice</p>
                                <span class="label bottom">Daftar Penjualan Jual Putus</span>
                            </div>
                          </a> 
                        @endif
                                                 
                            
                      </div>
                            {{-- ------------------------------------------------------------------------------- --}}

                    </div><!-- /.col -->  
                        
                  </div><!-- /.row -->  
                </div>  
                
                <div class="panel-footer">  
                  <span style="padding: 10px;">
                  
                  </span> 
                  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
                    <i class="fa fa-backward"></i> Kembali
                  </a>
                </div>

            </div>
          </div>
      </div>
            {{-- @include('partials.footer')  --}}
        </div>        
      </div>

      @include('metroScriptChart')    

  </body>
</html>