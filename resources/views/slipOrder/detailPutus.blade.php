@extends('app')

@section('title')
  {{$so->id_slip_order}}
@stop

@section('contentheader')
  {{$so->id_slip_order}} Details
@stop

@section('breadcrumb')
  <a href="/slipOrderPutus">Slip Order Jual Putus</a>
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
            <li>  <a href="#make_payment" data-toggle="tab"> Make Payment</a> </li>
          @endif
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
                      <input type="text" class="form-control" value="{{$so->alamat_ktp}}" disabled="true">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Alamat Pemasangan</label>                           
                    <input type="text" class="form-control" value="{{$so->alamat_pemasangan}}" disabled="true">
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
            <div class="row">
              @if ($pembayaran->sum('nominal_pembayaran') === $so->total_cart)
                <h3>Keterangan : Lunas</h3> 
              @endif
              <form class="form-horizontal">
                @foreach($pembayaran as $row)                
                  <div class="col-md-12">Pembayaran ke {{$loop->iteration}}</div>                  
                  <div class="col-md-4">                  
                      <div class="form-group">
                        <label class="col-sm-6 control-label">Metode Pembayaran </label>
                          <div class="col-sm-6">                        
                            <input class="form-control" type="text" value="{{$row->metode_pembayaran}}" disabled="">                                              
                          </div>                
                      </div>                                    
                  </div>
                  <div class="col-md-4">                 
                      <div class="form-group">
                        <label class="col-sm-6 control-label">Bank </label>
                          <div class="col-sm-6">
                            @if ($row->id_bank != null)
                              @if ($row->id_bank != '-')
                              <input class="form-control" type="text" value="{{$row->bank->nama_bank}}" disabled=""> 
                              @else
                              <input class="form-control" type="text" value="{{$row->id_bank}}" disabled="">
                              @endif 
                            @endif
                                                  
                                                                         
                          </div>                
                      </div>                                 
                  </div>
                  <div class="col-md-4">                  
                      <div class="form-group">
                        <label class="col-sm-4 control-label"> Nominal </label>
                          <div class="col-sm-8">                        
                            <input class="form-control" type="text" value="Rp {{ number_format($row->nominal_pembayaran,0,'.','.') }}" disabled="">                                             
                          </div>
                      </div>                  
                  </div>
                @endforeach 
              </form>
            </div>
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
          <div class="tab-pane" id="make_payment">
            <div class="row"> 
              <div class="col-md-12">
                <h2>Pembayaran</h2>                  
                <form action="/bayarCicilan" enctype="multipart/form-data" method="POST" id="ism_form">
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
        </div> <!-- /.end tab content -->
      </div>
    </div><!-- /.col-md-12 -->
  </div><!-- /.row -->
  

  <div class="panel-footer">
    <a class="btn btn-border btn-alt border-black font-black btn-xs pull-right" href="/slipOrderPutus">
      <i class="fa fa-backward"></i> Kembali
    </a>

  <a class="btn btn-alt btn-warning btn-xs" target="_BLINK" href="/printSOputus/{{$so->id_slip_order}}">
  {{-- <a class="btn btn-alt btn-warning btn-xs" target="_BLINK" href="/cetak"> --}}
      <i class="fa fa-print"></i>
      Print Slip Order
    </a>
</div>

</div><!-- /.panel-body -->
    
@stop

@section('js')
    @parent    
@stop