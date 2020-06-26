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

   <form action="/simpanInputTeknisiMaintenance" class="form-horizontal bordered-row" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="id_rubah" value="{{$maintenance->id}}">
        <div class="form-group">
            <label class="control-label col-sm-3">ID Sales Order<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$maintenance->id_slip_order}}" disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Nama Customer<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$maintenance->so->nama_customer}}" disabled/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Alamat Pemasangan<span class="required">*</span></label>
            <div class="col-sm-6">
               <textarea class="form-control"  cols="30" rows="4" disabled>{{$maintenance->so->alamat_pemasangan}}</textarea>           
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Teknisi<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($maintenance->teknisi != null)
                <input type="text" class="form-control" value="{{$maintenance->teknisi}}" disabled />
                @else
                <select class="form-control" name="teknisi">
                    <option value="">Pilih</option>
                    <option value="RIKI">RIKI</option>
                    <option value="KRYESNA">KRYESNA</option>
                    <option value="AGUNG">AGUNG</option>
                    <option value="ALIF">ALIF</option>
                    <option value="ILHAM">ILHAM</option>
                </select>
                @endif	
            </div>
        </div>

        <div class="bg-default content-box text-center pad20A mrg25T">
            
            @if ($maintenance->teknisi != null)
            <a class="btn btn-lg btn-primary" href="/maintenance">
                <i class="fa fa-backward"></i> Kembali
              </a>
                @else
                <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
                @endif
        </div>

    </form>
</div>
@stop