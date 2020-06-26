@extends('app')

@section('contentheader')
    @if($delivery->id)
        {{trans('core.editing')}} <b>{{$delivery->nama_delivery}}</b>
    @else
        Tambah Data delivery
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('delivery.index')}}">barang list</a>
     &nbsp;>&nbsp;
    Edit {{$delivery->nama_delivery}}
@stop



@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">
        
            add new delivery
        
    </h3>

    {!! Form::model($delivery, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
    <input type="hidden" name="id_staf" value="{{Auth::user()->id}}" />	
        <div class="form-group">
            <label class="control-label col-sm-3">Tanggal<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="date" class="form-control" placeholder="Kode Sparepart" name="tanggal" value="{{$delivery->tanggal}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">ID Invoice<span class="required">*</span></label>
            <div class="col-sm-6">
                <select name="id_invoice" id="customer_id2" class="form-control" required width="100%">
                    <option value="">Pilih</option>
                    @foreach ($invoices as $invoice)
                    <option value="{{ $invoice->id_invoice }}">{{ $invoice->id_invoice }}</option>
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