@extends('app')

@section('contentheader')
    Input Data Teknisi Maintenance
@stop

@section('breadcrumb')
    <a href="{{route('sparepart.index')}}">Maintenance</a>
     &nbsp;>&nbsp;
     Input Data Teknisi Maintenance
@stop



@section('main-content')

<div class="panel-body">

   <form action="/simpanUbahJadwalMaintenance" class="form-horizontal bordered-row" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="id_rubah" value="{{$maintenance->id}}">
        <div class="form-group">
            <label class="control-label col-sm-3">ID Sales Order</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$maintenance->id_slip_order}}" disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Tanggal Maintenance Awal</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$maintenance->tanggal_perbaikan}}" disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Tanggal Maintenance Perubahan</label>
            <div class="col-sm-6">
                <input type="text" name="tanggal_perbaikan" class="form-control dateTime" />
            </div>
        </div>        

        <div class="bg-default content-box text-center pad20A mrg25T">
           <input class="btn btn-lg btn-primary" type="submit" >     
        </div>

    </form>
</div>

<div class="panel-footer">  
    <span style="padding: 10px;"></span> 
    <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/maintenance">
      <i class="fa fa-backward"></i> Kembali
    </a>
</div> 
@stop