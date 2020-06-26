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

    <h3 class="title-hero">add new customer</h3>

    {!! Form::model($customer, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}

        <div class="form-group">
            <label class="control-label col-sm-3">Nama customer<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama customer" name="nama_customer" value="{{$customer->nama_customer}}" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Jenis Kelamin<span class="required">*</span></label>
            <div class="col-sm-6">
                <select name="jenis_kelamin" class="form-control">
                    @if ($customer->jenis_kelamin != null)
                        <option value="{{$customer->jenis_kelamin}}" selected>{{$customer->jenis_kelamin}}</option>
                    @else
                        <option value="" disabled selected>-- Pilihan Jenis Kelamin --</option>
                    @endif
                    
                    <option value="Laki - Laki">Laki - Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>                
            </div>
        </div>        
        <div class="form-group">
            <label class="control-label col-sm-3">Tanggal Lahir</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" value="{{$customer->tanggal_lahir}}" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Kewarganegaraan<span class="required">*</span></label>
            <div class="col-sm-6">
                <select name="kewarganegaraan" class="form-control">
                    @if ($customer->kewarganegaraan != null)
                        <option value="{{$customer->kewarganegaraan}}" selected>{{$customer->kewarganegaraan}}</option>
                    @else
                        <option value="" disabled selected>-- Pilihan kewarganegaraan --</option>
                    @endif
                    <option value="WNI">WNI</option>
                    <option value="WNA">WNA</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Alamat KTP<span class="required">*</span></label>
            <div class="col-sm-6">
                <textarea class="form-control" name="alamat_ktp" id="" cols="30" rows="4">{{$customer->alamat_ktp}}</textarea>  
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">No Telp</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="No Telp" name="no_telp" value="{{$customer->no_telp}}" />
            </div>
        </div>         
        <div class="form-group">
            <label class="control-label col-sm-3">No. Hp 1<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="No. Hp" name="no_hp" value="{{$customer->no_hp}}" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">No. Hp 2</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="No. Hp2" name="no_hp2" value="{{$customer->no_hp2}}" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Nomor Induk Kependudukan (NIK)<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="NIK" name="no_ktp" value="{{$customer->no_ktp}}" />
            </div>
        </div>
        {{-- <div class="form-group">
            <label class="control-label col-sm-3">CRC Code</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="CRC Code" name="crc_code" value="{{$customer->crc_code}}" />
            </div>
        </div>         --}}               
        <div class="form-group">
            <label class="control-label col-sm-3">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$customer->email}}" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Data Keluarga Dekat yang Tidak Serumah</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Data Keluarga Dekat yang Tidak Serumah" name="keluarga" value="{{$customer->keluarga}}" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3">Kontak HP Keluarga</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Data Keluarga Dekat yang Tidak Serumah" name="hp_keluarga" value="{{$customer->keluarga}}" />
            </div>
        </div>

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop