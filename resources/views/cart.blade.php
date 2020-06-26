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
    </head>
      
<body class="add-transition pt-page-rotatePullTop-init">
    <style>
        .output {
          margin: 0 auto;
          /* padding: 1em;  */
        }
        .colors {
          /* padding: 2em; */
          /* color: #fff; */
          display: none;
        }
        
        .debit_output {
          margin: 0 auto;
          /* padding: 1em;  */
        }
        .debit_colors {
          /* padding: 2em; */
          /* color: #fff; */
          display: none;
        }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
        }
        </style>
    <div id="page-wrapper">
        <div id="page-header" class="bg-gradient-1">
            <div id="mobile-navigation">
                <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
                <a href="{{ url('/') }}" class="logo-content-small" title="Museum Management System"></a>
            </div>        
            <div id="header-logo" class="logo-bg">
                <img class="logo-content-big" style="width: 200px;" src="{{asset('img/dashboard_logo.png')}}" alt="">                
                <a href="#" class="logo-content-big" title="CRM">  CRM <span>Keren</span> </a>
                   <a href="#" class="logo-content-small" title="CRM">  CRM <span>keren</span> </a>
                   <a id="close-sidebar" href="#" title="Close sidebar">  <i class="glyph-icon icon-angle-left"></i>   </a>
            </div>
            <div id="header-nav-left">
                <div class="user-account-btn dropdown">
                    <a href="#" title="My Account" class="user-profile clearfix" data-toggle="dropdown">                        
                        <img src="{{asset('img/default.png')}}" class="user-image" alt="" />
                        <span style="display: block; height: 20px;">{{ Auth::user()->email }}</span>
                        <i class="glyph-icon icon-angle-down"></i>
                    </a>
                    <div class="dropdown-menu float-left">
                        <div class="box-sm">
                            <div class="login-box clearfix">
                                <div class="user-img">
                                    <a href="#" title="" class="change-img">Change photo</a>
                                    @if(Auth::user() || Auth::user()->image )
                                      <img src="{{ asset('img/default.png') }}" class="user-image" alt="" />
                                    @else
                                      <img src="{!! asset('uploads/profiles/'. Auth::user()->image)!!}" class="user-image" alt="{{ Auth::user()->first_name }}"/>
                                    @endif
                                </div>
                                <div class="user-info">
                                    <span>
                                      @if(Auth::user())
                                          {{ Auth::user()->name }}
                                          <i>Member since  {{Auth::user()->created_at}}</i>
                                      @else
                                          Not logged in
                                      @endif
                                    </span>
                                </div>
                            </div>
                            <div class="pad5A button-pane button-pane-alt text-center">
                                <a class="btn display-block font-normal btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="glyph-icon icon-power-off"></i>
                                            Logout
                                        </a>        
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- #header-nav-left -->
        
            <div id="header-nav-right">
                <!--fulscreen-->
                <a href="#" class="hdr-btn tooltip-button" id="fullscreen-btn" data-placement="bottom" title="Fullscreen">
                    <i class="glyph-icon icon-arrows-alt"></i>
                </a>
                <!--ends--><!--Calculator-->
                <div class="dropdown" id="notifications-btn" >
                    <a  href="#" data-toggle="dropdown" data-placement="bottom" title="Calculator" class="tooltip-button">
                      <i class="glyph-icon fa fa-calculator"></i>
                    </a>
                    <div class="dropdown-menu float-right box-md">
                        <div class="scrollable-content scrollable-slim-box">

                            <script>
                                    calc_array = new Array();
                                    var calcul=0;
                                    var pas_ch=0;
                                    function $id(id)
                                    {
                                            return document.getElementById(id);
                                    }
                                    function f_calc(id,n)
                                    {
                                    if(n=='ce')
                                    {
                                        init_calc(id);
                                    }
                                    else if(n=='=')
                                    {
                                        if(calc_array[id][0]!='=' && calc_array[id][1]!=1)
                                        {
                                                eval('calcul='+calc_array[id][2]+calc_array[id][0]+calc_array[id][3]+';');
                                                calc_array[id][0] = '=';
                                                $id(id+'_result').value=calcul;
                                                calc_array[id][2]=calcul;
                                                calc_array[id][3]=0;
                                        }
                                    }
                                    else if(n=='+-')
                                    {
                                        $id(id+'_result').value=$id(id+'_result').value*(-1);
                                        if(calc_array[id][0]=='=')
                                        {
                                                calc_array[id][2] = $id(id+'_result').value;
                                                calc_array[id][3] = 0;
                                        }
                                        else
                                        {
                                                calc_array[id][3] = $id(id+'_result').value;
                                        }
                                        pas_ch = 1;
                                    }
                                    else if(n=='nbs')
                                    {
                                        if($id(id+'_result').value<10 && $id(id+'_result').value>-10)
                                        {
                                                $id(id+'_result').value=0;
                                        }
                                        else
                                        {
                                        $id(id+'_result').value=$id(id+'_result').value.slice(0,$id(id+'_result').value.length-1);
                                        }
                                        if(calc_array[id][0]=='=')
                                        {
                                        calc_array[id][2] = $id(id+'_result').value;
                                        calc_array[id][3] = 0;
                                        }
                                        else
                                        {
                                        calc_array[id][3] = $id(id+'_result').value;
                                        }
                                    }
                                    else
                                    {
                                        if(calc_array[id][0]!='=' && calc_array[id][1]!=1)
                                        {
                                                eval('calcul='+calc_array[id][2]+calc_array[id][0]+calc_array[id][3]+';');
                                                $id(id+'_result').value=calcul;
                                                calc_array[id][2]=calcul;
                                                calc_array[id][3]=0;
                                        }
                                        calc_array[id][0] = n;
                                    }
                                    if(pas_ch==0)
                                    {
                                            calc_array[id][1] = 1;
                                    }
                                    else
                                    {
                                            pas_ch=0;
                                    }
                                    document.getElementById(id+'_result').focus();
                                    return true;
                                    }
                                function add_calc(id,n)
                                    {
                                    if(calc_array[id][1]==1)
                                    {
                                            $id(id+'_result').value=n;
                                    }
                                    else
                                    {
                                            $id(id+'_result').value+=n;
                                    }
                                    if(calc_array[id][0]=='=')
                                    {
                                            calc_array[id][2] = $id(id+'_result').value;
                                            calc_array[id][3] = 0;
                                    }
                                    else
                                    {
                                            calc_array[id][3] = $id(id+'_result').value;
                                    }
                                    calc_array[id][1] = 0;
                                    document.getElementById(id+'_result').focus();
                                    return true;
                                    }
                                function init_calc(id)
                                    {
                                    $id(id+'_result').value=0;
                                    calc_array[id] = new Array('=',1,'0','0',0);
                                    document.getElementById(id+'_result').focus();
                                    return true;
                                    }
                                function key_detect_calc(id,evt)
                                {
                                    if((evt.keyCode>95) && (evt.keyCode<106))
                                    {
                                            var nbr = evt.keyCode-96;
                                            add_calc(id,nbr);
                                    }
                                    else if((evt.keyCode>47) && (evt.keyCode<58))
                                    {
                                            var nbr = evt.keyCode-48;
                                            add_calc(id,nbr);
                                    }
                                    else if(evt.keyCode==107)
                                    {
                                            f_calc(id,'+');
                                    }
                                    else if(evt.keyCode==109)
                                    {
                                            f_calc(id,'-');
                                    }
                                    else if(evt.keyCode==106)
                                    {
                                            f_calc(id,'*');
                                    }
                                    else if(evt.keyCode==111)
                                    {
                                            f_calc(id,'');
                                    }
                                    else if(evt.keyCode==110)
                                    {
                                            add_calc(id,'.');
                                    }
                                    else if(evt.keyCode==190)
                                    {
                                            add_calc(id,'.');
                                    }
                                    else if(evt.keyCode==188)
                                    {
                                            add_calc(id,'.');
                                    }
                                    else if(evt.keyCode==13)
                                    {
                                            f_calc(id,'=');
                                    }
                                    else if(evt.keyCode==46)
                                    {
                                            f_calc(id,'ce');
                                    }
                                    else if(evt.keyCode==8)
                                    {
                                            f_calc(id,'nbs');
                                    }
                                    else if(evt.keyCode==27)
                                    {
                                            f_calc(id,'ce');
                                    }
                                    return true;
                                }
                            </script>
                                
                            <table class="calculator" id="calc">
                                <tr>
                                    <td colspan="4" class="calc_td_result">
                                        <input type="text" readonly="readonly" name="calc_result" id="calc_result" class="calc_result" onkeydown="javascript:key_detect_calc('calc',event);" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="CE" onclick="javascript:f_calc('calc','ce');" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="&larr;" onclick="javascript:f_calc('calc','nbs');" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="%" onclick="javascript:f_calc('calc','%');" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="+" onclick="javascript:f_calc('calc','+');" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="7" onclick="javascript:add_calc('calc',7);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="8" onclick="javascript:add_calc('calc',8);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="9" onclick="javascript:add_calc('calc',9);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="-" onclick="javascript:f_calc('calc','-');" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="4" onclick="javascript:add_calc('calc',4);" />
                                    </td>
                                    <td class="calc_td_btn">
                                            <input type="button" class="calc_btn" value="5" onclick="javascript:add_calc('calc',5);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="6" onclick="javascript:add_calc('calc',6);" />
                                    </td>
                                    <td class="calc_td_btn">
                                            <input type="button" class="calc_btn" value="x" onclick="javascript:f_calc('calc','*');" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="1" onclick="javascript:add_calc('calc',1);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="2" onclick="javascript:add_calc('calc',2);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="3" onclick="javascript:add_calc('calc',3);" />
                                    </td>
                                    <td class="calc_td_btn">
                                        <input type="button" class="calc_btn" value="&divide;" onclick="javascript:f_calc('calc','/');" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="calc_td_btn">
                                            <input type="button" class="calc_btn" value="0" onclick="javascript:add_calc('calc',0);" />
                                    </td>
                                    <td class="calc_td_btn">
                                            <input type="button" class="calc_btn" value="&plusmn;" onclick="javascript:f_calc('calc','+-');" />
                                    </td>
                                    <td class="calc_td_btn">
                                            <input type="button" class="calc_btn" value="." onclick="javascript:add_calc('calc','.');" />
                                    </td>
                                    <td class="calc_td_btn">
                                            <input type="button" class="calc_btn" value="=" onclick="javascript:f_calc('calc','=');" />
                                    </td>
                                </tr>
                            </table>
                            <script type="text/javascript">
                                document.getElementById('calc').onload=init_calc('calc');
                            </script>                             
                        </div>
                    </div>        
                </div>
                <!--Calculator-->       
                
            </div><!-- #header-nav-right -->
        </div><!-- header ends -->

        <div id="page-sidebar" class="bg-gradient-1 font-inverse">
            <div class="scroll-sidebar">
          
                <ul id="sidebar-menu">            
                    <li class="no-menu" ><a href="/"> <i class='fa fa-th'></i> <span>Dashboard</span> </a></li>
                    <li class="no-menu"><a href="{{route('customer.index')}}"><i class='fa fa-users'></i> <span>Customer</span> </a></li>         
                    <li class="no-menu"> <a href="{{route('lead.index')}}">  <i class='fa fa-users'></i> <span>Lead</span></a> </li>     
                    <li>
                        <a href="#"><i class='fa fa-cubes'></i> <span>Persetujuan Perubahan</span></a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>  <a href="{{route('temporarySO.index')}}"><i class='fa fa-cubes'></i> <span>Data Slip Order</span></a>  </li>
                                <li>   <a href="{{route('sparepart.index')}}"><i class='fa fa-cubes'></i> <span>Data Customer</span> </a>   </li>
                            </ul>
                        </div>
                    </li>  
                    <li>
                        <a href="#"><i class='fa fa-cubes'></i> <span>Slip Order</span></a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li> <a href="{{route('slipOrder.new')}}"> <i class='fa fa-cubes'></i> <span>Buat Slip Order</span> </a> </li>
                                <li><a href="{{route('slipOrder.indexSewa')}}"><i class='fa fa-cubes'></i> <span>Sewa</span></a> </li>
                                <li>  <a href="{{route('slipOrder.indexPutus')}}"><i class='fa fa-cubes'></i> <span>Jual Putus</span> </a> </li>                            
                            </ul>
                        </div>
                    </li>          
                    <li class="no-menu"> <a href="{{route('akunting.index')}}">   <i class='fa fa-money'></i>  <span>Akunting</span> </a> </li>
                    <li>
                        <a href="#"><i class='fa fa-cubes'></i> <span>Manajemen Staf</span></a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li><a href="{{route('barang.index')}}"><i class='fa fa-cubes'></i><span>Sales</span></a>    </li>
                                <li><a href="{{route('sparepart.index')}}"><i class='fa fa-cubes'></i> <span>Admin</span> </a>                                </li>
                                <li><a href="{{route('sparepart.index')}}"> <i class='fa fa-cubes'></i> <span>Teknisi</span> </a>                                </li>
                            </ul>
                        </div>
                    </li>  
                    <li class="no-menu">    <a href="{{route('tiket.index')}}"> <i class='fa fa-photo'></i> <span>Tiket</span></a>   </li>  
                    <li>
                        <a href="#"><i class='fa fa-cubes'></i> <span>Inventory</span></a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#"> <i class='fa fa-cubes'></i> <span>Data Barang</span></a>
                                    <div class="sidebar-submenu">
                                        <ul>
                                            <li><a href="{{route('barang.index')}}"> <i class='fa fa-cubes'></i> <span>Barang</span></a></li>
                                            <li><a href="{{route('sparepart.index')}}"> <i class='fa fa-cubes'></i> <span>Sparepart</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="{{route('delivery.index')}}"> <i class='fa fa-cubes'></i> <span>Delivery Order</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>         
                    <li class="no-menu" >    <a href="#"> <i class='fa fa-pie-chart'></i> <span>Monitoring Instalasi</span></a>     </li>                    
                    <li class="no-menu" >   <a href="#"> <i class='fa fa-pie-chart'></i> <span>Laporan</span> </a>   </li>            
                    <li class="no-menu">     <a href="{{route('reward.index')}}"> <i class='fa fa-photo'></i> <span>Reward</span></a>    </li>
                </ul><!-- #sidebar-menu -->
            </div>
        </div> 

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
                            <li>
                                <a href="{{route('home')}}">
                                    <i class="fa fa-dashboard"></i> 
                                    Dashboard
                                </a>
                            </li>
                            <li class="active">
                                @section('breadcrumb')
                                    
                                @show
                            </li>
                        </ol>
                    </div>
                    @if(( isset($errors) && $errors->any()) || Session::has('error') || isset($error) || Session::has('message') || isset($message))
                    <div id="messageBar" class="animated fadeInDown">
                        @if($errors->any())
                        <div class="alert alert-close alert-danger">
                            <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                            <div class="bg-red alert-icon">
                                <i class="glyph-icon fa fa-times fa-2x"></i>
                            </div>
                            <div class="alert-content">
                                <h4 class="alert-title">Error</h4>
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

                        @if(isset($message) || Session::has('message'))

                        <div class="alert alert-close alert-info">
                            <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                            <div class="bg-info alert-icon">
                                <i class="fa {{ (isset($icon)) ? $icon : (Session::has('icon') ? Session::get('icon') : 'fa-info-circle') }} fa-2x text-info"></i>
                            </div>
                            <div class="alert-content">
                                <h4 class="alert-title">Info</h4>
                                <p>
                                    {!! isset($message) ? $message : Session::get('message') !!}
                                </p>
                            </div>
                        </div>

                        @endif
        
                    </div>
                    @endif

                    @if(isset($success) || Session::has('success'))
                        @section('js')
                            @parent
                            <script>
                                $(document).ready(function() {
                                    swal({
                                        title: '',
                                        text: 'Changes Saved',
                                        type: 'success',
                                        confirmButtonText: 'Ok'
                                    });
                                });
                            </script>
                        @stop
                    @endif

                    @if(isset($quantityerror) || Session::has('quantityerror'))
                        @section('js')
                            @parent
                            <script>
                                $(document).ready(function() {
                                    swal({
                                        title: '',
                                        text: {!! json_encode(isset($quantityerror) ? $quantityerror : Session::get('quantityerror')) !!},
                                        type: 'warning',
                                    })
                                    .then(() => {
                                    window.location.href = '{{route("sell.index")}}';
                                    });
                                });
                            </script>
                        @stop
                    @endif

                    @if(isset($warning) || Session::has('warning'))
                        @section('js')
                            @parent
                            <script>
                                $(document).ready(function() {
                                    swal({
                                        title: '',
                                        text: {!! json_encode(isset($warning) ? $warning : Session::get('warning')) !!},
                                        type: 'warning',
                                        confirmButtonText: {!! json_encode(trans('core.ok')) !!}
                                    });
                                });
                            </script>
                        @stop
                    @endif
                <div class="panel">
                    {{-- main-content start --}}
                    <style>
                        .output {
                          margin: 0 auto;
                          /* padding: 1em;  */
                        }
                        .colors {
                          /* padding: 2em; */
                          /* color: #fff; */
                          display: none;
                        }
                        
                        .debit_output {
                          margin: 0 auto;
                          /* padding: 1em;  */
                        }
                        .debit_colors {
                          /* padding: 2em; */
                          /* color: #fff; */
                          display: none;
                        }
                        input[type=number]::-webkit-inner-spin-button, 
                        input[type=number]::-webkit-outer-spin-button { 
                          -webkit-appearance: none; 
                          margin: 0; 
                        }
                    </style>
                        <!-- Main content -->
                        <div class="panel-body" id="dw">
                          <div class="row">          
                            <div class="col-md-12">
                              <div class="nav-tabs-custom">
                                {{-- tab title start --}}
                                <ul class="nav nav-tabs">
                                  <li class="active">
                                    <a href="#beli_putus" data-toggle="tab">Beli Putus</a>
                                  </li>
                                  <li>
                                    <a href="#sewa" data-toggle="tab">Sewa</a>
                                  </li>
                                </ul>
                                {{-- tab title end --}}
                        
                                <div class="tab-content">
                                  {{-- tab pertama start --}}
                                  <div class="active tab-pane" id="beli_putus">                               
                                     @include('invoice.form_jual_putus')
                                  </div><!-- /.tab-pane beli putus-->
                                  {{-- tab pertama end --}}
                                  
                                {{-- tab kedua start   --}}
                                <div class="tab-pane" id="sewa">           
                                  @include('invoice.form_sewa')   
                                </div><!-- /.tab-pane sewa-->
                                {{-- tab kedua end --}}  
                                </div><!-- /.tab-content -->
                                </div><!-- /.nav-tabs-custom -->
                              </div><!-- /.col -->  
                          </div>
                          <!-- /.row -->  
                        </div>
                          
                              <div class="panel-footer">
                                <span style="padding: 10px;"></span> 
                                <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="{{route('barang.index')}}"> <i class="fa fa-backward"></i> {{trans('back')}} </a>
                              </div>
                    {{-- main-content end --}}               

                </div>
            </div>
          </div>
          <!-- Main Footer -->
            <div class="footer bg-black">
                <!-- To the right -->
                <div class="pull-right hidden-xs">
                <!-- Powered By -->
                    <a href="http://www.intelle-hub.com">
                        <b>PT. Cosan</b>
                    </a>.
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 
                    <a href="#">
                        Cosan CRM 2019
                    </a>
                </strong>
            </div>
        </div>        
    </div>

    @include('cartScript')

</body>
</html>