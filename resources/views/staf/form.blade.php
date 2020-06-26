@extends('app')

@section('contentheader')
    @if($customer->id)
        {{trans('core.editing')}} <b>{{$customer->customer_name}}</b>
    @else
        add new customer
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('customer.index')}}">customer list</a>
     &nbsp;>&nbsp;
    edit {{$customer->customer_name}}
@stop



@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">
        
            add new customer
        
    </h3>

    {!! Form::model($customer, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}

        <div class="form-group">
            <label class="control-label col-sm-3">Nama customer<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama customer" name="nama_customer" value="{{$customer->nama_customer}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Nomor Induk Kependudukan (NIK)<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="NIK" name="nik_customer" value="{{$customer->nik_customer}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Tempat Lahir<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Tempat Lahir Customer" name="tempat_lahir_customer" value="{{$customer->tempat_lahir_customer}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Tanggal Lahir <span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir_customer" value="{{$customer->tanggal_lahir_customer}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">No. Hp<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="No. Hp" name="nomor_handphone_customer" value="{{$customer->nomor_handphone_customer}}" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Email<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Email" name="email_customer" value="{{$customer->email_customer}}" />
            </div>
        </div>


        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop