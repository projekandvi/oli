@extends('app')

@section('contentheader')    
    add new Tiket
@stop

@section('breadcrumb')
    <a href="{{route('tiket.index')}}">Tiket List</a>
     &nbsp;>&nbsp;
    Tiket Baru
@stop

@section('main-content')
<div class="panel-body">
    <h3 class="title-hero">add new Tiket</h3>
    <form action="/tiket/new" enctype="multipart/form-data" method="POST" id="ism_form" class="form-horizontal bordered-row">
        @csrf
        <input type="hidden" name="author" value="{{Auth::user()->id}}" />
        <div class="form-group">
            <label class="control-label col-sm-3">ID Slip Order<span class="required">*</span></label>
            <div class="col-sm-6">
                <select name="id_slip_order" class="form-control gampang" width="100%">
                    <option value="">Pilih</option>
                    @foreach ($so as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>       
        <div class="form-group">
            <label class="control-label col-sm-3">Subyek<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Subyek" name="subyek" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Kategori<span class="required">*</span></label>
            <div class="col-sm-6">
                <select class="form-control gampang" name="kategori" style="width: 100%">
                    <option value="" disabled="disabled" selected="selected">-- Pilihan Kategori --</option>
                    <option value="administrasi">Administrasi</option>
                    <option value="teknisi">Teknisi</option>
                    <option value="akunting">Akunting</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Prioritas<span class="required">*</span></label>
            <div class="col-sm-6">
                <select class="form-control gampang" name="prioritas" style="width: 100%">
                    <option value="" disabled="disabled" selected="selected">-- Pilihan Prioritas --</option>
                    <option value="rendah">Rendah</option>
                    <option value="sedang">Sedang</option>
                    <option value="tinggi">Tinggi</option>
                    <option value="mendesak">Mendesak</option>
                </select>
            </div>
        </div>        
        <div class="form-group">
            <label class="control-label col-sm-3">Pesan<span class="required">*</span></label>
            <div class="col-sm-6">
                <textarea class="form-control" name="pesan" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    </form>
</div>
@stop