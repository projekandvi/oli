<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@section('title') Cosan CRM @show
        </title>
        <meta
            content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
            name='viewport'>
        <script src="{{ asset('/assets/js-core/modernizr.js') }}"></script>
        <!-- CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('/build/base.a860b4298c9d804b3c70.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css-core/custom.css') }}">
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
            rel="stylesheet"/>
        @if(app()->getLocale() == 'ar')
        <lisnk rel="stylesheet" href="{{ asset('/assets/css-core/theme-rtl.css') }}">
            @endif
            <link
                href="{{ asset('/img/intelle_stock.png') }}"
                rel="icon"
                type="image/gif"
                sizes="16x16">
            <script src="{{ asset('/build/vendor.a860b4298c9d804b3c70.js') }}"></script>
    </head>

    <body class="add-transition pt-page-rotatePullTop-init">
        <div id="page-wrapper">
            @include('partials.mainheader') 
            @include('partials.sidebar')
            <div id="page-content-wrapper">
                <div id="page-content" style="min-height: 600px;">
                    <div class="container">
                        <!-- Content Header (Page header) -->
                        <div id="page-title">
                            <h2>
                                @section('contentheader') COSAN CRM
                                    <small style=" font-size: 12px; letter-spacing: 2px;">
                                        <b>{{Auth::user()->name}}</b>
                                    </small>
                                    @show
                            </h2>
                            <p>@section('contentheader_description') COSAN CRM @show</p>
                            <ol class="breadcrumb">
                                <li> <a href="/"> <i class="fa fa-dashboard"></i>  Dashboard  </a> </li>
                                <li class="active"> @section('breadcrumb') @show </li>
                            </ol>
                        </div>
                        @if(( isset($errors) && $errors->any()) || Session::has('error') || isset($error) || Session::has('message') || isset($message))
                            <div id="messageBar" class="animated fadeInDown">
                                @if($errors->any())
                                    <div class="alert alert-close alert-danger">
                                    <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                                    <div class="bg-red alert-icon">
                                        <i class="glyph-icon fa fa-times fa-2x"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h4 class="alert-title">Error</h4>
                                        <p>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                <li>{!! $error !!}</li>
                                                @endforeach
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                                @endif 
                                @if(isset($message) || Session::has('message'))
                                    <div class="alert alert-close alert-info">
                                    <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                                    <div class="bg-info alert-icon">
                                        <i class="fa {{ (isset($icon)) ? $icon : (Session::has('icon') ? Session::get('icon') : 'fa-info-circle') }} fa-2x text-info"></i>
                                    </div>
                                    <div class="alert-content">
                                        <h4 class="alert-title">Info</h4>
                                        <p>{!! isset($message) ? $message : Session::get('message') !!} </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif 
                        @if(isset($success) || Session::has('success')) 
                            @section('js') @parent
                            <script>
                                $(document).ready(function () {
                                    swal( {title: '', text: 'Changes Saved', type: 'success', confirmButtonText: 'Ok'} );
                                });
                            </script>
                            @stop 
                        @endif 
                        @if(isset($quantityerror) || Session::has('quantityerror'))
                            @section('js') @parent
                            <script>
                                $(document).ready(function () {
                                    swal({
                                        title: '',
                                        text: {
                                            !!json_encode(
                                                isset($quantityerror)
                                                    ? $quantityerror
                                                    : Session::get('quantityerror')
                                            )!!
                                        },
                                        type: 'warning'
                                    }).then(() => {
                                        window.location.href = '{{route("sell.index")}}';
                                    });
                                });
                            </script>
                            @stop 
                        @endif 
                        @if(isset($warning) || Session::has('warning')) 
                            @section('js')
                            @parent
                            <script>
                                $(document).ready(function () {
                                    swal({
                                        title: '',
                                        text: {
                                            !!json_encode(
                                                isset($warning)
                                                    ? $warning
                                                    : Session::get('warning')
                                            )!!
                                        },
                                        type: 'warning',
                                        confirmButtonText: {
                                            !!json_encode(trans('core.ok'))!!
                                        }
                                    });
                                });
                            </script>
                            @stop @endif
                            <div class="panel">
                                <style>
                                    .output {
                                        margin: 0 auto;
                                    }
                                    .colors {
                                        display: none;
                                    }
                                    .nampilinBank {
                                        display: none;
                                    }
                                    .output_recurring {
                                        margin: 0 auto;
                                    }
                                    .recurring {
                                        display: none;
                                    }

                                    .debit_output {
                                        margin: 0 auto;
                                    }
                                    .debit_colors {
                                        display: none;
                                    }
                                    input[type=number]::-webkit-inner-spin-button,
                                    input[type=number]::-webkit-outer-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                    }
                                </style>
                                <!-- Main content -->
                                <div class="panel-body" id="dw">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="nav-tabs-custom">
                                                {{-- tab title start --}}
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#beli_putus" data-toggle="tab">Sewa Periode</a>
                                                    </li>
                                                </ul>
                                                {{-- tab title end --}}

                                                <div class="tab-content">
                                                    {{-- tab pertama start --}}
                                                    <div class="active tab-pane" id="beli_putus">

                                                        <form action="/slipOrder/simpan" enctype="multipart/form-data" method="POST" id="buat_invoice_sewa">
                                                            @csrf
                                                            <input type="hidden" name="id_staf" value="{{Auth::user()->id}}"/>
                                                            <input type="hidden" class="form-control" name="tipe_penjualan" value="SewaPeriode"/>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-sm">
                                                                        <label class="control-label col-sm-6">Tanggal<span class="required">*</span></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" class="form-control" name="tanggal" value="{{$tanggal_otomatis}}"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group form-group-sm">
                                                                      <label class="control-label col-sm-4">No. Slip Order<span class="required">*</span></label>                               
                                                                      <div class="col-sm-3">
                                                                        <input type="text" class="form-control" name="id_slip_order" id="so"/> 
                                                                      </div>
                                                                      <div class="col-sm-5">
                                                                        <label class="form-check-label">Generate No. Slip Order</label> &nbsp;
                                                                        <input type="checkbox" class="control-label" value="ceklis" name="ceklis_id_slip_order" id="ceklis" onclick="ceklisGenerateSO()">
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                            </div><hr>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <h2>Data Sales</h2>
                                                                        <div class="col-md-6">
                                                                          <div class="form-group form-group-sm">
                                                                            <label>VP / GM<span class="required">*</span></label>  
                                                                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-target="#newSalesManager"><i class='fa fa-plus'></i> Sales Manager</a>                          
                                                                            <button type="button" class="btn btn-primary btn-xs" @click="refreshSalesManager()"><i class='fa fa-refresh'></i></button> 
                                                                            <select class='form-control gampang' name="salesManager">
                                                                              <option value="" disabled selected>-- Pilihan VP / GM --</option>
                                                                              <option v-for='data in daftarSalesManager' v-bind:value='data.id'>@{{ data.nama_manajer }}</option>
                                                                            </select>
                                                                          </div>	                                    
                                                                        </div>
                                                                        <div class="col-md-6">	
                                                                          <div class="form-group form-group-sm">
                                                                            <label>Agency<span class="required">*</span></label>   
                                                                            <a data-toggle="modal" class="btn btn-primary btn-xs" data-target="#newSales"><i class='fa fa-plus'></i> Sales</a>                        
                                                                            <button type="button" class="btn btn-primary btn-xs" @click="refreshSales()"><i class='fa fa-refresh'></i></button>                      
                                                                            <select name="sales" class="form-control">
                                                                            <option value="" disabled selected>-- Pilihan Agency --</option>
                                                                            </select>
                                                                          </div>                                     
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group form-group-sm">
                                                                            <label>Lokasi Penjualan<span class="required">*</span></label>                           
                                                                            <input type="text" class="form-control" placeholder="lokasi" name="lokasi_penjualan" />
                                                                          </div>	                                      
                                                                        </div>
                                                                        <div class="col-md-6">	
                                                                          <div class="form-group form-group-sm">
                                                                            <label>Kota / Kabupaten</label>                           
                                                                            <input type="text" class="form-control" placeholder="Kota / Kabupaten" name="kab_kot" />
                                                                          </div>                          
                                                                        </div>
                                                                    </div>              
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                          <div class="form-group form-group-sm">
                                                                            <label>Provinsi</label>                           
                                                                            <input type="text" class="form-control" placeholder="Provinsi" name="provinsi" />
                                                                          </div>                                  
                                                                        </div>
                                                                        <div class="col-md-6">	
                                                                          <div class="form-group form-group-sm">
                                                                            <label>CRC Code</label>          
                                                                            <input type="text" class="form-control" name="crc_code" v-model="customer2.crc_code" value="" />
                                                                          </div>                               
                                                                        </div>
                                                                    </div><hr>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <h2>Pilih Barang</h2>
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Pilih Barang</label>
                                                                                <select id="barang_id2" class="form-control" v-model="item2.id_barang">
                                                                                    <option value="">Pilih</option>
                                                                                    @foreach ($barangs as $barang)
                                                                                        <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} - Kode Barang :  {{ $barang->kode_barang }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Kode Barang</label>
                                                                                <input v-model="item2.kode_barang" class="form-control" value="">
                                                                            </div>
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Nama Barang</label>
                                                                                <input v-model="item2.nama_barang" class="form-control" value="">
                                                                                <input v-model="item2.harga" type="hidden" class="form-control" value="">
                                                                            </div>
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Qty</label>
                                                                                <input v-model="item2.qty" class="form-control" value="">
                                                                            </div>
                                                                            <button type="button" v-on:click="addItem2()" class="btn btn-primary">Add Item</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <h2>Data Customer</h2>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Nama Customer</label>
                                                                                <select name="id_customer" id="customer_id2" class="form-control" width="100%">
                                                                                    <option value="">Pilih</option>
                                                                                    @foreach ($customers as $customer)
                                                                                    <option value="{{ $customer->id }}">{{ $customer->nama_customer }} - NIK : {{ $customer->no_ktp }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <input type="hidden" class="form-control" name="nama_customer" v-model="customer2.id"  value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>No. KTP</label>
                                                                                <input type="text" class="form-control" name="no_ktp" v-model="customer2.no_ktp"  value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Alamat KTP</label>
                                                                                <input type="text" class="form-control" name="alamat_ktp" v-model="customer2.alamat_ktp" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Alamat Pemasangan</label>
                                                                                <input type="text" class="form-control" name="alamat_pemasangan" v-model="customer2.alamat_pemasangan" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>No. Telp</label>
                                                                                <input type="text" class="form-control" name="no_telp"  v-model="customer2.no_telp" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>No. HP.</label>
                                                                                <input type="text" class="form-control" name="no_hp" v-model="customer2.no_hp" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Email</label>
                                                                                <input type="text" class="form-control" name="email" v-model="customer2.email" value=""/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                                <label>Tempat Tinggal</label>
                                                                                <div class="form-check">
                                                                                    <input type="checkbox" class="form-check-input"  value="Milik Sendiri" name="milik_tempat_tinggal">
                                                                                    <label class="form-check-label" for="exampleCheck1">Milik Sendiri</label>
                                                                                    &nbsp;
                                                                                    <input type="checkbox" class="form-check-input" value="Sewa" name="milik_tempat_tinggal">
                                                                                    <label class="form-check-label" for="exampleCheck1">Sewa</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}
                                                            <div class="row">                                                                
                                                                <div class="col-md-12">
                                                                    <br>
                                                                    <table class="table table-bordered">
                                                                        <thead class="bg-gradient-1">
                                                                            <td class="text-center font-white">ID</td>
                                                                            <td class="text-center font-white">Name</td>
                                                                            <td class="text-center font-white">Qty</td>
                                                                            <td class="text-center font-white">Action</td>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="item in items2">
                                                                                <td>@{{ item.id }}</td>
                                                                                <td>@{{ item.name }}</td>
                                                                                <td>@{{ item.quantity }}</td>
                                                                                <td>
                                                                                    <button type="button"  v-on:click="removeItem2(item.id)" class="btn btn-sm btn-danger">remove</button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <table class="table">
                                                                        <tr>
                                                                            <td>Items on Cart:</td>
                                                                            <td>@{{itemCount2}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total Qty:</td>
                                                                            <td>@{{ details2.total_quantity }}</td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            {{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h2>Periode Sewa</h2><br>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group form-group-sm">
                                                                                        <label>Periode Sewa</label>
                                                                                        <select id="pilihanPeriode" name="periode_sewa" class="form-control gampang">
                                                                                            <option value="" disabled="disabled" selected="selected">-- Periode Sewa --</option>
                                                                                            <option value="3">3 bulan</option>
                                                                                            <option value="6">6 bulan</option>
                                                                                            <option value="12">12 bulan</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group form-group-sm">
                                                                                        <label>Nominal Pembayaran </label>
                                                                                        <input type="text" id="nominalPembayaranPeriode" class="form-control" name="total_tagihan" v-model="adi.totalan">
                                                                                        <input type="hidden" name="status_pelunasan" value="SewaPeriode">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <h2>Pembayaran</h2><br>
                                                                            <div class="form-group form-group-sm">
                                                                              <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                Tambah Metode Pembayaran
                                                                              </a>
                                                                            </div>
                                                                            <div class="collapse" id="pembayaran1">                                 
                                                                              <div class="form-group form-group-sm">
                                                                                <label>Metode Pembayaran</label>                           
                                                                                <select class="form-control gampang" name="metode_pembayaran_putus[]">
                                                                                  <option value=""  selected>-- Metode Pembayaran --</option>
                                                                                  <option v-for='data in metode_pembayaran_p' v-bind:value='data.key'>@{{ data.label }}</option>
                                                                                </select>
                                                                              </div>
                                                                              <div class="form-group form-group-sm">
                                                                                <label>Jenis Bank</label>                           
                                                                                <select class='form-control gampang' name="jenis_bank[]">
                                                                                  <option value="" selected>-- Pilihan Bank --</option>
                                                                                  <option v-for='data in daftarBank' v-bind:value='data.kode_bank'>@{{ data.nama_bank }}</option>
                                                                                </select>
                                                                              </div>
                                                                              <div class="form-group form-group-sm">
                                                                                <label>Nominal Pembayaran</label>                           
                                                                                <input type="text" class="form-control" name="nominal_pembayaran[]" v-model="adi.sisa1" value="">
                                                                              </div>
                                                                              <div class="form-group form-group-sm">
                                                                                <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                  Tambah Metode Pembayaran
                                                                                </a>
                                                                              </div>
                                                                              <div class="collapse" id="pembayaran2">
                                                                                <div class="form-group form-group-sm">
                                                                                  <label>Metode Pembayaran</label>                           
                                                                                  <select class="form-control gampang" name="metode_pembayaran_putus[]">
                                                                                    <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                                                                    <option v-for='data in metode_pembayaran_p' v-bind:value='data.key'>@{{ data.label }}</option>
                                                                                  </select>
                                                                                </div>                                     
                                                                                  <div class="form-group form-group-sm">
                                                                                    <label>Jenis Bank</label>                           
                                                                                    <select class='form-control gampang' name="jenis_bank[]">
                                                                                      <option value="" selected>-- Pilihan Bank --</option>
                                                                                      <option v-for='data in daftarBank' v-bind:value='data.kode_bank'>@{{ data.nama_bank }}</option>
                                                                                    </select>
                                                                                  </div>
                                                                                  <div class="form-group form-group-sm">
                                                                                    <label>Nominal Pembayaran</label>                           
                                                                                    <input type="text" class="form-control" name="nominal_pembayaran[]" v-model="adi.sisa2" value="">
                                                                                  </div>  
                                                                                  <div class="form-group form-group-sm">
                                                                                    <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran3" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                      Tambah Metode Pembayaran
                                                                                    </a>
                                                                                  </div>
                                                                                  <div class="collapse" id="pembayaran3">
                                                                                    <div class="form-group form-group-sm">
                                                                                      <label>Metode Pembayaran</label>                           
                                                                                      <select class="form-control gampang" name="metode_pembayaran_putus[]">
                                                                                        <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                                                                        <option v-for='data in metode_pembayaran_p' v-bind:value='data.key'>@{{ data.label }}</option>
                                                                                      </select>
                                                                                    </div>
                                                                                    <div class="form-group form-group-sm">
                                                                                      <label>Jenis Bank</label>                           
                                                                                        <select class='form-control gampang' name="jenis_bank[]">
                                                                                        <option value="" selected>-- Pilihan Bank --</option>
                                                                                        <option v-for='data in daftarBank' v-bind:value='data.kode_bank'>@{{ data.nama_bank }}</option>
                                                                                      </select>
                                                                                    </div>                              
                                                                                    <div class="form-group form-group-sm">
                                                                                      <label>Nominal Pembayaran</label>                           
                                                                                        <input type="text" class="form-control" name="nominal_pembayaran[]" v-model="adi.sisa3" value="">
                                                                                    </div> 
                                                                                    <div class="form-group form-group-sm">
                                                                                      <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                        Tambah Metode Pembayaran
                                                                                      </a>
                                                                                    </div>
                                                                                    <div class="collapse" id="pembayaran4">
                                                                                      <div class="form-group form-group-sm">
                                                                                        <label>Metode Pembayaran</label>                           
                                                                                        <select class="form-control gampang" name="metode_pembayaran_putus[]">
                                                                                          <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                                                                          <option v-for='data in metode_pembayaran_p' v-bind:value='data.key'>@{{ data.label }}</option>
                                                                                        </select>
                                                                                      </div>
                                                                                      <div class="form-group form-group-sm">
                                                                                        <label>Jenis Bank</label>                           
                                                                                        <select class='form-control gampang' name="jenis_bank[]">
                                                                                          <option value="" selected>-- Pilihan Bank --</option>
                                                                                          <option v-for='data in daftarBank' v-bind:value='data.kode_bank'>@{{ data.nama_bank }}</option>
                                                                                        </select>
                                                                                      </div>
                                                                                      <div class="form-group form-group-sm">
                                                                                        <label>Nominal Pembayaran</label>                           
                                                                                        <input type="text" class="form-control" name="nominal_pembayaran[]" v-model="adi.sisa4" value="">
                                                                                      </div>
                                                                                      <div class="form-group form-group-sm">
                                                                                        <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                                                          Tambah Metode Pembayaran
                                                                                        </a>
                                                                                      </div>
                                                                                      <div class="collapse" id="pembayaran5">
                                                                                        <div class="form-group form-group-sm">
                                                                                          <label>Metode Pembayaran</label>                           
                                                                                          <select class="form-control gampang" name="metode_pembayaran_putus[]">
                                                                                            <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                                                                            <option v-for='data in metode_pembayaran_p' v-bind:value='data.key'>@{{ data.label }}</option>
                                                                                          </select>
                                                                                        </div>
                                                                                        <div class="form-group form-group-sm">
                                                                                          <label>Jenis Bank</label>                           
                                                                                          <select class='form-control gampang' name="jenis_bank[]">
                                                                                            <option value="" selected>-- Pilihan Bank --</option>
                                                                                            <option v-for='data in daftarBank' v-bind:value='data.kode_bank'>@{{ data.nama_bank }}</option>
                                                                                          </select>
                                                                                        </div>
                                                                                        <div class="form-group form-group-sm">
                                                                                          <label>Nominal Pembayaran</label>                           
                                                                                          <input type="text" class="form-control" name="nominal_pembayaran[]" v-model="adi.sisa5" value="">
                                                                                        </div>                                              
                                                                                      </div>                                              
                                                                                    </div>                                          
                                                                                  </div>                                      
                                                                                </div>
                                                                                <h2>Sisa Pembayaran</h2><br>
                                                                                <input type="text" class="form-control" name="sisa_tagihan" v-model="adi.totalan - adi.sisa1 - adi.sisa2 - adi.sisa3 - adi.sisa4 - adi.sisa5" value="">
                                                                                <input type="hidden"  name="biaya_sewa_periode" v-model="adi.totalan" value=""/>
                                                                              </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group form-group-sm">
                                                                            <label>Remark</label>                           
                                                                            <input type="text" class="form-control" name="remark">
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- -------------------------------------------------------------------------------------------------------------------------------------  --}}
                                                            <!-- input bank baru modal -->
                                                            <div class="modal fade" id="newBankModal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">Form Input Bank Baru</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-sm-3" style="text-align: left;">
                                                                                    Kode Bank
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" v-model="form.new_kode_bank" class="form-control" name="a">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-sm-3" style="text-align: left;">
                                                                                    Nama Bank
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text" v-model="form.new_nama_bank" class="form-control" name="b">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer" style="margin-top: 5%;">
                                                                            <button  type="button" class="btn btn-primary"  data-dismiss="modal"  @click="save()">save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- new bank modal ends here -->

                                                            <!-- input new sales manager modal -->
                                                            <div  class="modal fade" id="newSalesManager" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">Form Input Sales Manager Baru</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-sm-4" style="text-align: left;">Nama Sales Manajer</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formSalesManager.nama_manajer" class="form-control" name="b">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer" style="margin-top: 5%;">
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveSalesManager()">save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- new sales manager modal ends here -->

                                                            <!-- input new sales modal -->
                                                            <div  class="modal fade" id="newSales" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title" id="myModalLabel">Form Input Sales Baru</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-sm-4" style="text-align: left;">Nama Sales Manager </label>
                                                                                <div class="col-sm-8">
                                                                                    <select v-model="formSales.id_manajer" class="form-control">
                                                                                        <option disabled="disabled" value="">Please select one</option>
                                                                                        <option v-for='data in daftarSalesManager' v-bind:value='data.id'>@{{ data.nama_manajer }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group" style="margin-bottom: 40px;">
                                                                                <label class="col-sm-4" style="text-align: left;">Nama Sales</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" v-model="formSales.nama_sales" class="form-control" name="b">
                                                                                </div>
                                                                            </div>
                                                                            <br><br>         
                                                                            <div class="form-group" style="margin-bottom: 20px;">
                                                                                <label class="col-sm-4" style="text-align: left;">Agency Code</label>
                                                                                <div class="col-sm-8">
                                                                                <input type="text"  v-model="formSales.agency_code" class="form-control" name="c">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer" style="margin-top: 5%;">
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal"  @click="saveSales()">save</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!-- new sales modal ends here -->
                                                            {{-- -------------------------------------------------------------------------------------------------------------------------------------  --}}

                                                            {{-- isi tab pertama end --}}
                                                            <hr>
                                                            <div class="bg-default content-box text-center pad20A mrg25T">
                                                                <a class="btn btn-lg btn-primary"  onclick="event.preventDefault();  document.getElementById('buat_invoice_sewa').submit();">
                                                                    Save
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane beli putus-->
                                                        {{-- tab pertama end --}}
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- /.nav-tabs-custom -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>                                   

                                    <div class="panel-footer">
                                        <span style="padding: 10px;"></span>
                                        <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrder">
                                            <i class="fa fa-backward"></i>
                                            {{trans('back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('partials.footer')
                    </div>
                </div>

                @include('cartScript')

            </body>
        </html>