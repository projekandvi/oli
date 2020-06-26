@extends('app')

@section('title')
  {{$customer->nama_customer}}
@stop

@section('contentheader')
  {{$customer->nama_customer}} Details
@stop

@section('breadcrumb')
  <a href="/customer">Customer</a>
  <li>{{$customer->nama_customer}}</li>
@stop

@section('main-content')
<!-- Main content -->
<div class="panel-body">
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#details" data-toggle="tab">Customer Detail</a></li> 
          @if ($so != null)
            <li><a href="#transaksi" data-toggle="tab">Riwayat Transaksi</a></li>         
            <li><a href="#instalasi" data-toggle="tab">Data Instalasi</a></li>         
            <li><a href="#maintenance" data-toggle="tab">Data Maintenance</a></li>         
            <li><a href="#riwayat_pelaporan" data-toggle="tab">Riwayat Laporan Teknisi</a></li> 
          @endif                  
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="details">            				
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">	
                    <label>Nama Customer</label>                           
                    <input type="text" class="form-control" value="{{$customer->nama_customer}}" disabled="true">
                  </div>
                  <div class="col-md-12">	
                    <label>NIK</label>                           
                    <input type="text" class="form-control" value="{{$customer->no_ktp}}" disabled="true">
                  </div>
                  <div class="col-md-12">	
                    <label>Tanggal Lahir</label>                           
                    <input type="text" class="form-control" value="{{$customer->tanggal_lahir}}" disabled="true">
                  </div>
                  <div class="col-md-12">	
                    <label>Kewarganegaraan</label>                           
                    <input type="text" class="form-control" value="{{$customer->kewarganegaraan}}" disabled="true">
                  </div>
                  <div class="col-md-12">	
                    <label>Alamat</label>                           
                    <textarea class="form-control" cols="30" rows="4" disabled="true">{{$customer->alamat_ktp}}</textarea>   
                  </div>      
                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <label>No HP 1</label>                           
                    <input type="text" class="form-control" value="{{$customer->no_hp}}" disabled="true">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>No HP 2</label>                           
                    <input type="text" class="form-control" value="{{$customer->no_hp2}}" disabled="true">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>CRC Code</label>                           
                    <input type="text" class="form-control" value="{{$customer->crc_code}}" disabled="true">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Email</label>                           
                    <input type="text" class="form-control" value="{{$customer->email}}" disabled="true">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">	
                    <label>Alamat Pemasangan</label>                           
                    <textarea class="form-control" cols="30" rows="4" disabled="true">{{$customer->alamat_pemasangan}}</textarea>  
                  </div>
                </div>
              </div>                
            </div>                                 
          </div>   

          @if ($so != null)
            <div class="tab-pane" id="transaksi">
              <div class="row">
                <div class="col-md-12">
                  @foreach ($customer->so as $item)
                  <div class="row">                  
                    <div class="col-md-12">
                      <h2>Transaksi ke - {{$loop->iteration}} </h2>
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> No Slip Order </label>
                          <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$item->id_slip_order}}" disabled="">
                          </div>                  
                          <label class="col-sm-2 control-label"> VP / GM  </label>
                          <div class="col-sm-4">
                              <input type="text" disabled="" class="form-control" value="{{$item->salesManagernya->nama_manajer}}">
                          </div>            
                        </div>
    
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> Tanggal Transaksi </label>
                          <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$item->tanggal}}" disabled="">
                          </div>
                          <label class="col-sm-2 control-label"> Agency </label>
                          <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$item->salesnya->nama_sales}}" disabled="">
                          </div>  
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> Alamat Pemasangan </label>
                          <div class="col-sm-4">
                            <textarea class="form-control" cols="30" rows="4" disabled="true">{{$item->alamat_pemasangan}}</textarea>  
                          </div> 
                          <label class="col-sm-2 control-label"> Lokasi Penjualan </label>
                          <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$item->lokasi}}" disabled="">
                          </div> 
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> Teknisi Instalasi </label>
                          <div class="col-sm-4">
                            @if ($item->instalasi != null)
                            <input class="form-control" type="text" value="{{$item->instalasi->teknisi}}" disabled="">
                            @endif
                            
                          </div> 
                        </div>
                      </form>
                    </div>
                  </div>                    
                  <br>
                  
                  <div class="row">
                    <div class="col-md-12"> <br />
                      <table class="table table-bordered">
                        <thead class="bg-gradient-1">
                          <td class="text-center font-white">No</td>
                          <td class="text-center font-white">Nama Barang</td>
                        </thead>
                        <tbody>
                          @foreach ($item->slipOrderDetail as $row) 
                          <tr> 
                            <td class="text-center">
                              {{$loop->iteration}}                       
                            </td>
                            <td class="text-center">
                              {{$row->nama_barang}}                         
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div> 
                  <hr>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="tab-pane" id="instalasi">
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">	
                      <label>Tanggal Pemasangan</label>                           
                        <input type="text" class="form-control" value="{{$instalasi->tanggal_pemasangan}}" disabled="true">
                    </div>
                    <div class="col-md-12">	
                      <label>Teknisi</label>                           
                      <input type="text" class="form-control" value="{{$instalasi->teknisi}}" disabled="true">
                    </div>                  
                  </div>
                </div>
                               
              </div> 
            </div>
            <div class="tab-pane" id="maintenance">
              <div class="row">
                <div class="col-md-12">
                  @foreach ($maintenance as $item)
                  <div class="row">                  
                    <div class="col-md-12">
                      <h2>Maintenance ke - {{$loop->iteration}} </h2>
                      <form class="form-horizontal">
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> No Slip Order </label>
                          <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$item->id_slip_order}}" disabled="">
                          </div>                  
                          <label class="col-sm-2 control-label"> Tanggal Perbaikan  </label>
                          <div class="col-sm-4">
                              <input type="text" disabled="" class="form-control" value="{{$item->tanggal_perbaikan}}">
                          </div>            
                        </div>
    
                        <div class="form-group">
                          <label class="col-sm-2 control-label"> Teknisi </label>
                          <div class="col-sm-4">
                            <input class="form-control" type="text" value="{{$item->teknisi}}" disabled="">
                          </div>                          
                        </div>                      
                      </form>
                    </div>
                  </div>                    
                  
                  @endforeach
                </div>
              </div>
            </div>
            <div class="tab-pane" id="riwayat_pelaporan">
              <div class="row">
                @foreach ($laporan as $item)
                <div class="col-md-12">
                  <form class="form-horizontal bordered-row">
                    <div class="col-md-12">                  
                      <div class="form-group">
                        <label class="col-sm-2">Kunjungan </label>
                          <div class="col-sm-6">                        
                          <input type="text" value="{{$item->kunjungan}}" class="form-control" disabled>                                            
                          </div>                
                      </div>                                    
                    </div>
                    <table class="table table-bordered">
                      <tr>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Tanggal</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Kondisi Air</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Sumber</th>
                        <th colspan="6" class="text-center">Hasil</th>
                      </tr>
                      <tr>
                        <th class="text-center">Level 1</th>
                        <th class="text-center">Level 2</th>
                        <th class="text-center">Level 3</th>
                        <th class="text-center">Level 4</th>
                        <th class="text-center">Level 5</th>
                        <th class="text-center">Level 6</th>
                      </tr>
                      <tr>
                        <td rowspan="2"><input type="text" value="{{$item->tanggal_laporan}}" class="form-control" disabled></td>
                        <th class="text-center">TDS</th>
                        <td><input type="text" value="{{$item->tds_sumber}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->tds_lv1}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->tds_lv2}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->tds_lv3}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->tds_lv4}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->tds_lv5}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->tds_lv6}}" class="form-control" disabled></td>
                      </tr>
                      <tr>
                        <th class="text-center">pH</th>
                        <td><input type="text" value="{{$item->ph_sumber}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->ph_lv1}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->ph_lv2}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->ph_lv3}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->ph_lv4}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->ph_lv5}}" class="form-control" disabled></td>
                        <td><input type="text" value="{{$item->ph_lv6}}" class="form-control" disabled></td>
                      </tr>
                      <tr>
                        <th colspan="9" class="text-center">keterangan</th>
                      </tr>
                      <tr>
                        <td colspan="9"><textarea class="form-control" cols="30" rows="5" disabled>{{$item->keterangan}}</textarea></td>
                      </tr>
                    </table>
                    
                  </form>
                </div>
                @endforeach
                
                                
              </div>
            </div>  
          @endif
          		
        </div> <!-- /.end tab content -->
      </div>
    </div><!-- /.col-md-12 -->
  </div><!-- /.row -->
  <div class="panel-footer">  
    <span style="padding: 10px;"></span> 
      <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/customer">
        <i class="fa fa-backward"></i> Kembali
      </a>
  </div>
</div><!-- /.panel-body -->
    
@stop

@section('js')
    @parent    
@stop