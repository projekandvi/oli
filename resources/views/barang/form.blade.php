@extends('app')

@section('contentheader')
    @if($barang->id)
        {{trans('core.editing')}} <b>{{$barang->name}}</b>
    @else
        add new barang
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('barang.index')}}">barang list</a>
     &nbsp;>&nbsp;
    edit {{$barang->name}}
@stop

@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">        
            add new barang        
    </h3>

    {!! Form::model($barang, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
    <input type="hidden" class="form-control" name="id_barang" value="{{$kode_barang}}" />
    {{-- @if ($barang->kode_barang === null)
            <input type="hidden" class="form-control" name="id_barang" value="{{$kode_barang}}" />
        @else
            <input type="hidden" class="form-control" name="id_barang" value="{{$barang->id_barang}}" />
        @endif  --}}
        <div class="form-group">
            <label class="control-label col-sm-3">Kode Barang<span class="required">*</span></label>
            <div class="col-sm-3">                
                <input type="text" class="form-control" name="kode_barang" />                            
            </div>
        </div>
    
        <div class="form-group">
            <label class="control-label col-sm-3">Nama Barang<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="{{$barang->nama_barang}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Harga<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Harga Barang" name="harga" value="{{$barang->harga}}" />
            </div>
        </div> 

        <div class="form-group">
            <label class="control-label col-sm-3">Stok Awal<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Stok Awal Barang" name="stok" value="{{$barang->stok}}" />
            </div>
        </div>  

        <div class="form-group">
            <label class="control-label col-sm-3">Lokasi Gudang<span class="required">*</span></label>
            <div class="col-sm-6">
                <select class="form-control" name="id_gudang">
                    <option value="" disabled selected>-- Pilihan Lokasi Gudang --</option>
                    @foreach ($gudang as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_gudang }}</option>
                    @endforeach
                </select>
            </div>
        </div>  

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop