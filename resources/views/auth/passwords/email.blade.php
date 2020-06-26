<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title> 
    Reset Password :: COSAN CRM  
  </title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="{!! asset('img/intelle_stock.png') !!}" rel="icon" type="image/gif" sizes="16x16">
  <script src="{{ asset('/assets/js-core/modernizr.js') }}"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('/build/base.a860b4298c9d804b3c70.css') }}">
  <script src="{{ asset('/assets/js-core/wow.js') }}"></script>

  <script type="text/javascript">
      wow = new WOW({
          animateClass: 'animated',
          offset: 100
      });
      wow.init();
  </script>

  <style type="text/css">

      html,body {
          height: 100%;
          background: #fff;
          overflow: hidden;
      }

  </style>

</head>
<body>

    <img src="{{ asset('/assets/image-resources/blurred-bg/blurred-bg-7.jpg') }}" class="login-img wow fadeIn" alt="">

    <div class="center-vertical">
        <div class="center-content row">

            <div class="col-md-3 center-margin">
                <center>
                 
                  <img src="{{ asset('/img/logo_lifewater.png') }}" class="wow fadeIn">
                  
                  <h3 class="font-white wow fadeIn">Cosan CRM</h3>
                </center>
                <br>

                
               <form method="POST" action="{{ route('password.email') }}" id="ism_form">
                        @csrf
                    <div class="content-box wow bounceInDown modal-content">
                        <h3 class="content-box-header content-box-header-alt bg-default">
                            <span class="icon-separator">
                                <i class="glyph-icon icon-cog"></i>
                            </span>
                            <span class="header-wrapper">
                                Cosan Customer Relation Management
                                <small>Reset Password</small>
                            </span>
                        </h3>

                        @if($errors->any())
                        <div class="alert alert-close alert-danger">
                            <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                            <div class="bg-red alert-icon">
                                <i class="glyph-icon fa fa-times fa-2x"></i>
                            </div>
                            <div class="alert-content">
                                <p>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </p>
                            </div>
                        </div>
                        @endif

                        @if (session('status'))
                        <div class="alert alert-close alert-success">
                            <div class="alert-content">
                                <p>
                                    {{ session('status') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        
                        <div class="content-box-wrapper">
                            <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    <span class="input-group-addon bg-blue">
                                        <i class="glyph-icon icon-envelope-o"></i>
                                    </span>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary btn-block" type="submit" id="submitButton" value="Send Password Reset Link" onclick="submitted()">                           
                            
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        function submitted () {
        document.getElementById('submitButton').disabled=true;
        document.getElementById('submitButton').value='Submitting, please wait...';
        document.getElementById("ism_form").submit();
      }
    </script>
</body>
</html>
