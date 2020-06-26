@extends('app')

@section('title')
  Slip Order {{$so->id_slip_order}}
@stop

@section('contentheader')
  {{$so->id_slip_order}} Details
@stop

@section('breadcrumb')
  <a href="/slipOrder">Slip Order</a> / 
  <a href="/slipOrderSewaRecurring">Slip Order Periode</a>
  <li>{{$so->id_slip_order}}</li>
@stop

@section('main-content')
<style>
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
    margin: 0; 
  }
</style>
<!-- Main content -->
<div class="panel-body">

  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"> <a href="#details" data-toggle="tab"> Detail  </a> </li>
          <li>  <a href="#payment_history" data-toggle="tab"> Payment History  </a> </li>
          @if ($so->sisa_tagihan != 0)
            <li>  <a href="#sisa_tagihan" data-toggle="tab"> Sisa Tagihan</a> </li>
            <li>  <a href="#make_payment_pelunasan" data-toggle="tab"> Make Payment Pelunasan</a> </li>
          @endif
          @if ($so->tarikan_barang === 'TRUE')
          <li>  <a href="#tarik_barang" data-toggle="tab">  Tarik Barang  </a>  </li>
          @endif
         
          @if ($so->fault->count() != null)
            <li>  <a href="#fault_history" data-toggle="tab"> Fault Recurring History</a> </li>
          @endif
          <li>  <a href="#upgrade" data-toggle="tab">  Upgrade  </a>  </li>
          
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="details">            				
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">	
                      <label>Tanggal</label>                           
                      <input type="text" class="form-control" value="{{$so->tanggal}}" disabled="true">
                    </div>
                    <div class="col-md-12">	
                      <label>VP / GM</label>                           
                      <input type="text" class="form-control" value="{{$so->salesManagernya->nama_manajer}}" disabled="true">
                    </div>
                    <div class="col-md-12">	
                      <label>Agency</label>                           
                      <input type="text" class="form-control" value="{{$so->salesnya->nama_sales}}" disabled="true">
                    </div>
                    <div class="col-md-12">	
                      <label>Agency Code</label>                           
                      <input type="text" class="form-control" value="{{$so->salesnya->agency_code}}" disabled="true">
                      
                    </div>      
                    <div class="col-md-12">	
                      <label>Location</label>                           
                      <input type="text" class="form-control" value="{{$so->lokasi_penjualan}}" disabled="true">
                      
                    </div>
                    <div class="col-md-12">	
                      <label>CRC Code</label>                           
                      <input type="text" class="form-control" value="{{$so->crc_code}}" disabled="true">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Nama Pembeli</label>                           
                      <input type="text" class="form-control" value="{{$so->nama_customer}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. KTP</label>                           
                      <input type="text" class="form-control" value="{{$so->no_ktp}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Alamat</label>                           
                      <textarea class="form-control" cols="30" rows="4" disabled="true">{{$so->alamat_ktp}}</textarea>           
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Alamat Pemasangan</label>                           
                      <textarea class="form-control" cols="30" rows="4" disabled="true">{{$so->alamat_pemasangan}}</textarea>   
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. Telp</label>                           
                      <input type="text" class="form-control" value="{{$so->no_telp}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. HP.</label>                           
                      <input type="text" class="form-control" value="{{$so->no_hp}}" disabled="true">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Tempat Tinggal</label>                           
                      <input type="text" class="form-control" value="{{$so->milik_tempat_tinggal}}" disabled="true">
                    </div>
                  </div>
                </div>                
              </div>
              
              <hr>
              <div class="row">
                <div class="col-md-12"> <br />
                  <table class="table table-bordered">
                    <thead class="bg-gradient-1">
                      <td class="text-center font-white">No</td>
                      <td class="text-center font-white">Nama Barang</td>
                    </thead>
                    <tbody>
                      @foreach ($so->slipOrderDetail as $item) 
                        <tr> 
                          <td class="text-center">{{$loop->iteration}}</td>
                          <td class="text-center">{{$item->nama_barang}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>                      
          </div>
          <div class="tab-pane" id="payment_history">            
            @foreach ($pembayaran as $item)
            <div class="row">                  
              <div class="col-md-12">
                  <h2>Pembayaran ke-{{$loop->iteration}}. </h2>
                <form class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> Metode Pembayaran</label>
                    <div class="col-sm-4">
                      <input class="form-control" type="text" value="{{$item->metode_pembayaran}}" disabled="">
                    </div>                  
                    <label class="col-sm-2 control-label"> Bank  </label>
                    <div class="col-sm-4">
                      @if ($item->id_bank != '-')
                      <input class="form-control" type="text" value="{{$item->bank->nama_bank}}" disabled=""> 
                      @else
                      <input class="form-control" type="text" value="{{$item->id_bank}}" disabled="">
                      @endif 
                    </div>            
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"> Nominal Debit </label>
                    <div class="col-sm-4">
                      <input class="form-control" type="text" value="Rp {{ number_format($item->nominal_pembayaran,0,'.','.') }}" disabled="">
                    </div> 
                  </div>
                </form>
              </div>
            </div>                    
            <br>
            <hr>
            @endforeach                    
        </div>
        <div class="tab-pane" id="sisa_tagihan">
          <div class="row">
            <div class="col-md-12">
              <h2>Sisa Tagihan</h2>
                <form class="form-horizontal bordered-row">
                  <div class="form-group">
                    <label class="control-label col-sm-3">Nominal</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" value="Rp {{ number_format($so->sisa_tagihan,0,'.','.') }}" disabled="true">
                    </div>
                  </div>                    
                </form>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="make_payment_pelunasan">
          <div class="row"> 
            <div class="col-md-12">
              <h2>Pembayaran</h2>                  
              <form action="/bayarCicilanPeriode" enctype="multipart/form-data" method="POST" id="ism_form">
                @csrf
                <input type="hidden" name="id_slip_order"  value="{{$so->id_slip_order}}">
                <input type="hidden" name="id_staf" value="{{Auth::user()->id}}" />	             
                                                                          
                <div class="form-group form-group-sm">
                  <label>Metode Pembayaran</label>                           
                  <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                    <option value=""  selected>-- Metode Pembayaran --</option>
                    <option value="tunai">Tunai / Cash</option>
                    <option value="visa">Visa </option>
                    <option value="master">Master Card </option>
                    <option value="kartu_debit">Kartu Debit </option>
                    <option value="jcb">JCB</option>
                  </select>
                </div>
                <div class="form-group form-group-sm">
                  <label>Jenis Bank</label>                           
                  <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                    <option value="" selected>-- Pilihan Bank --</option>
                    @foreach ($banks as $item)
                      <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group form-group-sm">
                  <label>Nominal Pembayaran</label>                           
                  <input type="text" class="form-control" name="nominal_pembayaran[]"  value="">
                </div>
                <div class="form-group form-group-sm">
                  <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Tambah Metode Pembayaran
                  </a>
                </div>
                <div class="collapse" id="pembayaran2">
                  <div class="form-group form-group-sm">
                    <label>Metode Pembayaran</label>                           
                    <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                      <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                      <option value="tunai">Tunai / Cash</option>
                      <option value="visa">Visa </option>
                      <option value="master">Master Card </option>
                      <option value="kartu_debit">Kartu Debit </option>
                      <option value="jcb">JCB</option>
                    </select>
                  </div>                                     
                    <div class="form-group form-group-sm">
                      <label>Jenis Bank</label>                           
                      <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                        <option value="" selected>-- Pilihan Bank --</option>
                        @foreach ($banks as $item)
                          <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group form-group-sm">
                      <label>Nominal Pembayaran</label>                           
                      <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                    </div>  
                    <div class="form-group form-group-sm">
                      <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Tambah Metode Pembayaran
                      </a>
                    </div>
                    <div class="collapse" id="pembayaran3">
                      <div class="form-group form-group-sm">
                        <label>Metode Pembayaran</label>                           
                        <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                          <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                          <option value="tunai">Tunai / Cash</option>
                          <option value="visa">Visa </option>
                          <option value="master">Master Card </option>
                          <option value="kartu_debit">Kartu Debit </option>
                          <option value="jcb">JCB</option>
                        </select>
                      </div>
                      <div class="form-group form-group-sm">
                        <label>Jenis Bank</label>                           
                          <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                          <option value="" selected>-- Pilihan Bank --</option>
                          @foreach ($banks as $item)
                            <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                          @endforeach
                        </select>
                      </div>                              
                      <div class="form-group form-group-sm">
                        <label>Nominal Pembayaran</label>                           
                          <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                      </div> 
                      <div class="form-group form-group-sm">
                        <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran4" role="button" aria-expanded="false" aria-controls="collapseExample">
                          Tambah Metode Pembayaran
                        </a>
                      </div>
                      <div class="collapse" id="pembayaran4">
                        <div class="form-group form-group-sm">
                          <label>Metode Pembayaran</label>                           
                          <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                            <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                            <option value="tunai">Tunai / Cash</option>
                            <option value="visa">Visa </option>
                            <option value="master">Master Card </option>
                            <option value="kartu_debit">Kartu Debit </option>
                            <option value="jcb">JCB</option>
                          </select>
                        </div>
                        <div class="form-group form-group-sm">
                          <label>Jenis Bank</label>                           
                          <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                            <option value="" selected>-- Pilihan Bank --</option>
                            @foreach ($banks as $item)
                              <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group form-group-sm">
                          <label>Nominal Pembayaran</label>                           
                          <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                        </div>
                        <div class="form-group form-group-sm">
                          <a class="btn btn-primary" data-toggle="collapse" href="#pembayaran5" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tambah Metode Pembayaran
                          </a>
                        </div>
                        <div class="collapse" id="pembayaran5">
                          <div class="form-group form-group-sm">
                            <label>Metode Pembayaran</label>                           
                            <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                              <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                              <option value="tunai">Tunai / Cash</option>
                              <option value="visa">Visa </option>
                              <option value="master">Master Card </option>
                              <option value="kartu_debit">Kartu Debit </option>
                              <option value="jcb">JCB</option>
                            </select>
                          </div>
                          <div class="form-group form-group-sm">
                            <label>Jenis Bank</label>                           
                            <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                              <option value="" selected>-- Pilihan Bank --</option>
                                @foreach ($banks as $item)
                                  <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group form-group-sm">
                            <label>Nominal Pembayaran</label>                           
                            <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                          </div>                                              
                        </div>                                              
                      </div>                                          
                    </div>                                      
                  </div>
                  <div class="bg-default content-box text-center pad20A mrg25T">
                    <button type="submit" class="btn btn-lg btn-primary">Simpan</button>      
                  </div>                             
              </form>
            </div>
          </div>
            <br>
            <hr>          
        </div>
        <div class="tab-pane" id="tarik_barang">
            <div class="row">                        
              <div class="col-md-12">
                <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Remarks</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" cols="30" rows="4" disabled="true">{{$so->remarks_tarikan}}</textarea>     
                        </div>               
                                            
                    </div> 
                  </form>
              </div>
            </div>
        </div>                
          <div class="tab-pane" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="row"> 
              <div class="bg-default content-box text-center pad20A mrg25T">
                <a class="btn btn-lg btn-primary" data-toggle="modal" data-target="#upgradeModal"><i class="fa fa-edit" style="color: #069996;"></i> Upgrade</a>
              </div>                       
            </div>

            <!-- Slip Order Upgrade modal -->
            <div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <form action="/upgradeStatusSewa" enctype="multipart/form-data" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" name="id_slip_order" value="{{$so->id_slip_order}}">
                <input type="hidden" name="id_staf" value="{{Auth::user()->id}}">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Upgrade sewa menjadi pembelian</h4>
                    </div>
                    <div class="modal-body" >
                      <div class="form-group">
                        <label class="col-sm-4" style="text-align: left;"> Harga Barang</label>
                        <div class="col-sm-8">
                          <input type="text" name="total_cart" class="form-control">
                        </div>
                      </div> 
                      <div class="form-group">
                        <label class="col-sm-4" style="text-align: left;">Metode Pembayaran</label>
                          <div class="col-sm-8">                           
                            <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                              <option value=""  selected>-- Metode Pembayaran --</option>
                              <option value="tunai">Tunai / Cash</option>
                              <option value="visa">Visa </option>
                              <option value="master">Master Card </option>
                              <option value="kartu_debit">Kartu Debit </option>
                              <option value="jcb">JCB</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4" style="text-align: left;">Jenis Bank</label> 
                        <div class="col-sm-8">                          
                          <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                            <option value="" selected>-- Pilihan Bank --</option>
                            @foreach ($banks as $item)
                              <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4" style="text-align: left;">Nominal Pembayaran</label> 
                        <div class="col-sm-8">                          
                          <input type="text" class="form-control" name="nominal_pembayaran[]"  value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-4"> </div>
                        <div class="col-sm-8"> 
                          <a class="btn btn-primary" data-toggle="collapse" href="#pembayaranUpgrade2" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Tambah Metode Pembayaran
                          </a>
                        </div>
                      </div>
                      <div class="collapse" id="pembayaranUpgrade2">
                        <div class="form-group">
                          <label class="col-sm-4" style="text-align: left;">Metode Pembayaran</label>  
                          <div class="col-sm-8">                         
                            <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                              <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                              <option value="tunai">Tunai / Cash</option>
                              <option value="visa">Visa </option>
                              <option value="master">Master Card </option>
                              <option value="kartu_debit">Kartu Debit </option>
                              <option value="jcb">JCB</option>
                            </select>
                          </div>
                        </div>                                     
                        <div class="form-group">
                          <label class="col-sm-4" style="text-align: left;">Jenis Bank</label> 
                          <div class="col-sm-8">                          
                            <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                              <option value="" selected>-- Pilihan Bank --</option>
                              @foreach ($banks as $item)
                                <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4" style="text-align: left;">Nominal Pembayaran</label>   
                          <div class="col-sm-8">                        
                            <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                          </div>
                        </div>  
                        <div class="form-group">
                          <div class="col-sm-4"> </div>
                          <div class="col-sm-8"> 
                            <a class="btn btn-primary" data-toggle="collapse" href="#pembayaranUpgrade3" role="button" aria-expanded="false" aria-controls="collapseExample">
                              Tambah Metode Pembayaran
                            </a>
                          </div>
                        </div>
                        <div class="collapse" id="pembayaranUpgrade3">
                          <div class="form-group">
                            <label class="col-sm-4" style="text-align: left;">Metode Pembayaran</label>  
                            <div class="col-sm-8">                         
                              <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                                <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                <option value="tunai">Tunai / Cash</option>
                                <option value="visa">Visa </option>
                                <option value="master">Master Card </option>
                                <option value="kartu_debit">Kartu Debit </option>
                                <option value="jcb">JCB</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-4" style="text-align: left;">Jenis Bank</label> 
                            <div class="col-sm-8">                          
                              <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                                <option value="" selected>-- Pilihan Bank --</option>
                                @foreach ($banks as $item)
                                  <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>                              
                          <div class="form-group">
                            <label class="col-sm-4" style="text-align: left;">Nominal Pembayaran</label>
                            <div class="col-sm-8">                          
                              <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                            </div>
                          </div> 
                          <div class="form-group">
                            <div class="col-sm-4"> </div>
                            <div class="col-sm-8"> 
                              <a class="btn btn-primary" data-toggle="collapse" href="#pembayaranUpgrade4" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Tambah Metode Pembayaran
                              </a>
                            </div>
                          </div>
                          <div class="collapse" id="pembayaranUpgrade4">
                            <div class="form-group">
                              <label class="col-sm-4" style="text-align: left;">Metode Pembayaran</label>  
                              <div class="col-sm-8">                         
                                <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                                  <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                  <option value="tunai">Tunai / Cash</option>
                                  <option value="visa">Visa </option>
                                  <option value="master">Master Card </option>
                                  <option value="kartu_debit">Kartu Debit </option>
                                  <option value="jcb">JCB</option>
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4" style="text-align: left;">Jenis Bank</label>   
                              <div class="col-sm-8">                        
                                <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                                  <option value="" selected>-- Pilihan Bank --</option>
                                  @foreach ($banks as $item)
                                    <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-sm-4" style="text-align: left;">Nominal Pembayaran</label>  
                              <div class="col-sm-8">                         
                                <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-4"> </div>
                              <div class="col-sm-8"> 
                                <a class="btn btn-primary" data-toggle="collapse" href="#pembayaranUpgrade5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                  Tambah Metode Pembayaran
                                </a>
                              </div>
                            </div>
                            <div class="collapse" id="pembayaranUpgrade5">
                              <div class="form-group">
                                <label class="col-sm-4" style="text-align: left;">Metode Pembayaran</label>  
                                <div class="col-sm-8">                         
                                  <select class="form-control gampang" name="metode_pembayaran_putus[]" style="width: 100%">
                                    <option value="" disabled="disabled" selected="selected">-- Metode Pembayaran --</option>
                                    <option value="tunai">Tunai / Cash</option>
                                    <option value="visa">Visa </option>
                                    <option value="master">Master Card </option>
                                    <option value="kartu_debit">Kartu Debit </option>
                                    <option value="jcb">JCB</option>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4" style="text-align: left;">Jenis Bank</label>  
                                <div class="col-sm-8">                         
                                  <select class='form-control gampang' name="jenis_bank[]" style="width: 100%">
                                    <option value="" selected>-- Pilihan Bank --</option>
                                    @foreach ($banks as $item)
                                      <option value="{{ $item->kode_bank }}">{{ $item->nama_bank }}</option>
                                    @endforeach
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-4" style="text-align: left;">Nominal Pembayaran</label> 
                                <div class="col-sm-8">                          
                                  <input type="text" class="form-control" name="nominal_pembayaran[]" value="">
                                </div>
                              </div>                                              
                            </div>                                              
                          </div>                                          
                        </div>                                      
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4" style="text-align: left;">Remarks </label>
                        <div class="col-sm-8">
                          <textarea name="remark" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                      </div> <br>
                      {{-- ----------------------------------------------------------------------------- --}}
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
              <!-- upgrade modal ends -->
          </div> 
          <div class="tab-pane" id="fault_history">
            <div class="row">
              <div class="col-md-12">
                <h2>Fault History</h2>
                <table class="table table-bordered">
                  <thead class="bg-gradient-1">
                    <td class="text-center font-white">No</td>
                    <td class="text-center font-white">ID Slip Order</td>
                    <td class="text-center font-white">Waktu</td>
                  </thead>
                  <tbody>
                    @foreach ($so->fault as $item) 
                    <tr> 
                      <td class="text-center">
                        {{$loop->iteration}}                       
                       </td>
                      <td class="text-center">
                        {{$item->id_slip_order}}                         
                      </td>
                      <td class="text-center">
                        {{$item->created_at}}                         
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>                       
        </div>
      </div>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
  <div class="panel-footer">
    <a class="btn btn-border btn-alt border-black font-black btn-xs pull-right" href="/slipOrderSewaPeriode">
      <i class="fa fa-backward"></i> Kembali
    </a>
    <a class="btn btn-alt btn-warning btn-xs" target="_BLINK" href="/printSOperiode/{{$so->id_slip_order}}">  
      <i class="fa fa-print"></i>
      Print Slip Order
    </a>
</div>
</div><!-- /.nav-tabs-custom -->
          
@stop
@section('js')
    @parent  
    <script>
      $(function() {
		$('#upgradeButton').click(function(event) {
			event.preventDefault();
			$('#upgradeModal').modal('show')
		});
  });
  </script>  
@stop