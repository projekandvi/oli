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
    Update Stok {{$barang->name}}
@stop

@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">        
            add new barang        
    </h3>

    {{-- {!! Form::model($barang, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!} --}}
    {!! Form::open(['route'=> ['barang.stok', $barang], 'method'=>'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
        
        <div class="form-group">
            <label class="control-label col-sm-3">Nama Barang<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="{{$barang->nama_barang}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Stok Terakhir<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$barang->stok}}"  disabled/>
            </div>
        </div> 

        <div class="form-group">
            <label class="control-label col-sm-3">Stok Tambahan<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Stok Tambahan" name="stok" />
            </div>
        </div>  

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop