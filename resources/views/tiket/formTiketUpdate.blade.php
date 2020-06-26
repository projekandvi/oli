@extends('app')

@section('contentheader')
    Update Tiket for Slip Order : <b>{{$tiket->id_slip_order}}</b>    
@stop

@section('breadcrumb')
    <a href="{{route('tiket.index')}}">Tiket List</a>
     &nbsp;>&nbsp;
    Update Tiket
@stop



@section('main-content')

<div class="panel-body">

    <h3 class="title-hero"> add new Tiket</h3>
    <form action="/updateTiket" enctype="multipart/form-data" method="POST" id="ism_form" class="form-horizontal bordered-row">
        @csrf
        <input type="hidden" name="id_tiket" value="{{$tiket->id}}" />
        <div class="form-group">
            <label class="control-label col-sm-3">ID Slip Order</label>
            <div class="col-sm-6">
                <input type="text" class="form-control"  value="{{$tiket->id_slip_order}}" disabled/>
            </div>
        </div>       

        <div class="form-group">
            <label class="control-label col-sm-3">Subyek</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$tiket->subyek}}" disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Kategori</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$tiket->kategori}}" disabled/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Prioritas</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" value="{{$tiket->prioritas}}" disabled/>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Pesan</label>
            <div class="col-sm-6">
                <textarea class="form-control" disabled cols="30" rows="5">{{$tiket->pesan}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Staf</label>
            <div class="col-sm-6">
                <select name="id_staf" class="form-control gampang" width="100%">
                    <option value="" disabled="disabled" selected="selected">-- Pilihan Staf --</option>
                    @foreach ($staf as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
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