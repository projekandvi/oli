@extends('app')

@section('contentheader')
    @if($sparepart->id)
        {{trans('core.editing')}} <b>{{$sparepart->nama_sparepart}}</b>
    @else
        Tambah Data sparepart
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('sparepart.index')}}">barang list</a>
     &nbsp;>&nbsp;
    Edit {{$sparepart->nama_sparepart}}
@stop



@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">
        
            add new sparepart
        
    </h3>

    {!! Form::model($sparepart, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}

        <div class="form-group">
            <label class="control-label col-sm-3">Kode Sparepart<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Kode Sparepart" name="kode_sparepart" value="{{$sparepart->kode_sparepart}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Nama Sparepart<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Sparepart" name="nama_sparepart" value="{{$sparepart->nama_sparepart}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Harga<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Harga Barang" name="harga" value="{{$sparepart->harga}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Kondisi<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Kondisi Sparepart" name="kondisi" value="{{$sparepart->kondisi}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Lokasi Stok<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Lokasi Stok" name="lokasi_stok" value="{{$sparepart->lokasi_stok}}" />
            </div>
        </div>


        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop