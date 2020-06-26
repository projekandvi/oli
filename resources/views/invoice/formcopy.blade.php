@extends('app')

@section('contentheader')
    @if($invoice->id_invoice)
        {{trans('core.editing')}} <b>{{$invoice->id_invoice}}</b>
    @else
        add new Slip Order
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('customer.index')}}">invoice list</a>
     &nbsp;>&nbsp;
    edit {{$invoice->id_invoice}}
@stop



@section('main-content')

<div class="panel-body" id="dw">

    <h3 class="title-hero">
        
            add Slip Order
        
    </h3>

    {!! Form::model($invoice, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
    <input type="hidden" class="form-control" placeholder="id staf" name="id_staf" value="{{Auth::user()->id}}" />
        
        <div class="form-group">
            <label class="control-label col-sm-3">Nomor Slip Order<span class="required">*</span></label>
            <div class="col-sm-3">
                @if ($invoice->id_invoice === null)
                <input type="text" class="form-control" name="id_invoice" value="{{$nomor_otomatis}}" />
                @else
                <input type="text" class="form-control" name="id_invoice" value="{{$invoice->id_invoice}}" />
                @endif            
        </div>
            {{-- <label class="control-label col-sm-3">Auto Number<span class="required">*</span></label>
            <div class="col-sm-1">
               
                <input class="form-control" type="checkbox" value="">
            </div> --}}
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">tanggal<span class="required">*</span></label>
            <div class="col-sm-6">
                    @if ($invoice->tanggal === null)
                    <input type="text" class="form-control" name="tanggal" value="{{$tanggal_otomatis}}" />
                    @else
                    <input type="date" class="form-control" name="tanggal" value="{{$invoice->tanggal}}" />
                    @endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">team<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="team" name="team" value="{{$invoice->team}}" />
            </div>
        </div>
    
        <div class="form-group">
            <label class="control-label col-sm-3">nama seller<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="nama seller" name="nama_seller" value="{{$invoice->nama_seller}}" />
            </div>
        </div>
    
        <div class="form-group">
            <label class="control-label col-sm-3">lokasi<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="lokasi" name="lokasi" value="{{$invoice->lokasi}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Nama Customer<span class="required">*</span></label>
            <div class="col-sm-6">
                <select name="id_customer" id="product_id" class="form-control" required width="100%">
                    <option value="">Pilih</option>
                    @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->nama_customer }} - NIK : {{ $customer->no_ktp }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">crc code<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->crc_code === null)
                <input type="text" class="form-control" name="crc_code" v-model="product.crc_code" value="" />
                @else
                <input type="text" class="form-control" placeholder="crc code" name="crc_code" value="{{$invoice->crc_code}}" />
                @endif
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">la code<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->la_code === null)
                <input type="text" class="form-control" name="la_code" v-model="product.la_code" value="" />
                @else
                <input type="text" class="form-control" placeholder="la code" name="la_code" value="{{$invoice->la_code}}" />
                @endif
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">nama customer<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->nama_customer === null)
                <input type="text" class="form-control" name="nama_customer" v-model="product.nama_customer" value="" />
                @else
                <input type="text" class="form-control" placeholder="nama customer" name="nama_customer" value="{{$invoice->nama_customer}}" />
                @endif
                
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">no ktp<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->no_ktp === null)
                <input type="text" class="form-control" name="no_ktp" v-model="product.no_ktp" value="" />
                @else
                <input type="text" class="form-control" placeholder="no ktp" name="no_ktp" value="{{$invoice->no_ktp}}" />
                @endif
               
            </div>
        </div>

        <div class="form-group">
               
            <label class="control-label col-sm-3">alamat ktp<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->alamat_ktp === null)
                <input type="text" class="form-control"  name="alamat_ktp" v-model="product.alamat" value="" />
                @else
                <input type="text" class="form-control" placeholder="alamat ktp" name="alamat_ktp" value="{{$invoice->alamat_ktp}}" />
                @endif
               
            </div>
        </div>

        <div class="form-group">                
            <label class="control-label col-sm-3">alamat pemasangan<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->alamat_pemasangan === null)
                <input type="text" class="form-control" name="alamat_pemasangan" v-model="product.alamat" value="" />
                @else
                <input type="text" class="form-control" placeholder="alamat pemasangan" name="alamat_pemasangan" value="{{$invoice->alamat_pemasangan}}" />
                @endif
               
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">milik tempat tinggal<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="milik tempat tinggal" name="milik_tempat_tinggal" value="{{$invoice->milik_tempat_tinggal}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">No. Telp<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->no_telp === null)
                <input type="text" class="form-control" name="no_telp" v-model="product.no_telp" value="" />
                @else
                <input type="text" class="form-control" placeholder="no telp" name="no_telp" value="{{$invoice->no_telp}}" />
                @endif                
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">No. HP<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->no_hp === null)
                <input type="text" class="form-control" name="no_hp" v-model="product.no_hp" value="" />
                @else
                <input type="text" class="form-control" placeholder="no telp" name="no_hp" value="{{$invoice->no_hp}}" />
                @endif                
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">email<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->email === null)
                <input type="text" class="form-control" name="email" v-model="product.email" value="" />
                @else
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$invoice->email}}" />
                @endif               
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Nama Barang<span class="required">*</span></label>
            <div class="col-sm-6">
                <select name="id_barang" id="barang_id" class="form-control" required width="100%">
                    <option value="">Pilih</option>
                    @foreach ($barangs as $barang)
                    <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} - Kode Barang : {{ $barang->kode_barang }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">harga<span class="required">*</span></label>
            <div class="col-sm-6">
                @if ($invoice->harga === null)
                <input type="text" class="form-control" name="harga" v-model="barang.harga" value="" />
                @else
                <input type="text" class="form-control" placeholder="harga" name="harga"  value="{{$invoice->harga}}" />
                @endif               
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">pembayaran<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="pembayaran" name="pembayaran" value="{{$invoice->pembayaran}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">jenis bank<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="jenis bank" name="jenis_bank" value="{{$invoice->jenis_bank}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">nominal pembayaran<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="nominal pembayaran" name="nominal_pembayaran" value="{{$invoice->nominal_pembayaran}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">tipe penjualan<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="tipe penjualan" name="tipe_penjualan" value="{{$invoice->tipe_penjualan}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">pembayaran terkini<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="date" class="form-control" placeholder="pembayaran terkini" name="pembayaran_terkini" value="{{$invoice->pembayaran_terkini}}" />
            </div>
        </div>

        

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop