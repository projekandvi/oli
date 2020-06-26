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
            <a href="{{route('dashboard')}}">
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