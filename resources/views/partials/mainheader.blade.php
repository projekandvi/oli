<div id="page-header" class="bg-gradient-1  "  >
    
    <div id="mobile-navigation">
        <button id="nav-toggle" class="collapsed" data-toggle="collapse" data-target="#page-sidebar"><span></span></button>
        <a href="{{ url('/') }}" class="logo-content-small" title="Museum Management System"></a>
    </div>

    <div id="header-logo" class="logo-bg">
        <img class="logo-content-big" style="width: 200px;" src="{{asset('img/dashboard_logo.png')}}" alt="">
        
           <a href="#" class="logo-content-big" title="CRM">
               CRM
               <span>Keren</span>
           </a>
           <a href="#" class="logo-content-small" title="CRM">
               CRM
               <span>keren</span>
           </a>
           <a id="close-sidebar" href="#" title="Close sidebar">
               <i class="glyph-icon icon-angle-left"></i>
           </a>
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
                    {{-- <div class="divider"></div>
                    <ul class="reset-ul mrg5B">
                        <li>
                            <a href="{{route('user.profile')}}">
                                <i class="glyph-icon float-right icon-caret-right"></i>
                                View account details
                            </a>
                        </li>
                    </ul> --}}
                    <div class="pad5A button-pane button-pane-alt text-center">
                        {{-- <a href="{{ url('logout') }}" class="btn display-block font-normal btn-danger">
                            <i class="glyph-icon icon-power-off"></i>
                            {{ trans('core.sign_out') }}
                        </a> --}}

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
        <!--ends-->

        {{-- <!--View cash status-->
        @if(Auth::user() && Auth::user()->can('cash.view'))
          @if(cashStatus() == 0)
          <a data-toggle="modal" data-target="#myCashStatus" href="#" class="hdr-btn tooltip-button" data-placement="bottom" title="Cash Status">
          @else
          <a onclick="cashCalc()" href="#" class="hdr-btn tooltip-button" data-placement="bottom" title="Cash Status">
          @endif
              <i class="glyph-icon fa fa-money"></i>
          </a>
        @endif
        <!--cash status ends--> --}}
        
        {{-- <!--View Today's profit-->
        @if(Auth::user() && Auth::user()->can('profit.view'))
          <a onclick="profitCalc()" href="#" class="hdr-btn tooltip-button" data-placement="bottom" title="Profit / Loss">
              <i class="glyph-icon fa fa-line-chart"></i>
          </a>
        @endif
        <!--View Today's profit Ends--> --}}

        <!--Notification-->
        <div class="dropdown" id="notifications-btn">
            <a data-toggle="dropdown" href="#" data-placement="bottom" title="Alert Maintenance Tempo" class="tooltip-button" 
                @if($reminderTempoMaintenance->count() > 0) 
                    style="background-color: #FFE941CC !important;" 
                @endif
            >
                <i class="glyph-icon icon-linecons-megaphone" 
                    @if($reminderTempoMaintenance->count() > 0) 
                        style="color: red;text-shadow: 1px 1px 1px #ccc;"
                    @endif>
                </i>
            </a>

            <div class="dropdown-menu float-right box-md">
                @if ($reminderTempoMaintenance->count() > 0)
                    <div class="popover-title display-block clearfix pad10A">
                        Alert Maintenance Tempo : {{$reminderTempoMaintenance->count()}} Slip Order 
                    </div>
                    
                    <div class="scrollable-content scrollable-slim-box">
                        <ul class="no-border notifications-box">
                            @foreach($reminderTempoMaintenance as $item)
                            <li>
                                <ul>
                                    <li><span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span> 
                                        No. Slip Order : {{$item->id_slip_order}}
                                    </li>
                            </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="pad10A button-pane button-pane-alt text-center">
                        <a href="/daftarMaintenanceTempo" class="btn btn-primary" title="View all notifications">
                            Proses
                        </a>
                    </div>
                @endif
                
                
                <div class="popover-title display-block clearfix pad10A">
                    Alert Maintenance Tempo : {{$reminderTempoMaintenance->count()}} Slip Order 
                </div>
                   
                <div class="scrollable-content scrollable-slim-box">
                    <ul class="no-border notifications-box">
                        @foreach($reminderTempoMaintenance as $item)
                        <li>
                            <ul>
                                <li><span class="bg-danger icon-notification glyph-icon icon-bullhorn"></span> 
                                    No. Slip Order : {{$item->id_slip_order}}
                                </li>
                           </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="pad10A button-pane button-pane-alt text-center">
                    <a href="/daftarMaintenanceTempo" class="btn btn-primary" title="View all notifications">
                        Proses
                    </a>
                </div>
            </div>
        </div>
        <!--Notification Ends-->

        <!--Calculator-->
        <div class="dropdown" id="notifications-btn" >
          <a  href="#" data-toggle="dropdown" data-placement="bottom" title="Calculator" class="tooltip-button">
              <i class="glyph-icon fa fa-calculator"></i>
          </a>
          <div class="dropdown-menu float-right box-md">
                <div class="scrollable-content scrollable-slim-box">
                   @include('partials.calculator')
                </div>
            </div>

        </div>
        <!--Calculator-->

        

        
    </div><!-- #header-nav-right -->
</div><!-- header ends -->








