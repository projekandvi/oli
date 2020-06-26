@extends('app')

@section('title')
  Lead {{$lead->nama_lead}}
@stop

@section('contentheader')
  {{$lead->nama_lead}} Details
@stop

@section('breadcrumb')
  <a href="/lead">Lead</a>
  <li>{{$lead->nama_lead}}</li>
@stop

@section('main-content')
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<!-- Main content -->
<div class="panel-body">

  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"> <a href="#details" data-toggle="tab">Detail Leads</a></li>          
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="details">            				
              <div class="row">                
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Nama Lead</label>                           
                      <input type="text" class="form-control" value="{{$lead->nama_lead}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. Hp</label>                           
                      <input type="text" class="form-control" value="{{$lead->no_hp}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. Telp</label>                           
                      <input type="text" class="form-control" value="{{$lead->no_telp}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Alamat</label>                           
                      <textarea class="form-control" cols="30" rows="4" disabled="true">{{$lead->alamat}}</textarea>           
                    </div>
                  </div>                  
                  <div class="row">
                    <div class="col-md-12">
                      <label>Email</label>                           
                      <input type="text" class="form-control" value="{{$lead->email}}" disabled="true">
                    </div>
                  </div>
                </div>                
              </div>                                  
          </div>               
        </div>
      </div>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
  <div class="panel-footer">
    <a class="btn btn-border btn-alt border-black font-black btn-xs pull-right" href="/lead">
      <i class="fa fa-backward"></i> Kembali
    </a>
</div>
</div><!-- /.nav-tabs-custom -->
          
@stop
@section('js')
    @parent    
@stop