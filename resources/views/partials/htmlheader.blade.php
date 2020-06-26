<head>
  <meta charset="UTF-8">
  <title> 
      @section('title')
          Cosan CRM

      @show
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

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  
  

  {{-- <style type="text/css">
    #header-logo .logo-content-big,
    .logo-content-small {
        
          background: url({!! json_encode(asset('uploads/site/GBdRGjGjJ8ie.jpeg'))!!}) left 50% no-repeat;
        
    }
  </style> --}}
</head>
