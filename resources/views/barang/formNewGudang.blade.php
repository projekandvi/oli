@extends('app')

@section('contentheader')    
        Tambah Data Gudang
   
@stop

@section('breadcrumb')
    <a href="{{route('gudang.index')}}">Daftar Gudang</a>     
@stop

@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">        
        Tambah Data Gudang       
    </h3>

    <form action="/newGudang/simpan" enctype="multipart/form-data" method="POST" class="form-horizontal bordered-row" id="ism_form">
        @csrf
    
        <div class="form-group">
            <label class="control-label col-sm-3">Nama Gudang<span class="required">*</span></label>
            <div class="col-sm-3">                
                <input type="text" class="form-control" name="nama_gudang" />                            
            </div>
        </div>

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    </form>
</div>
@stop