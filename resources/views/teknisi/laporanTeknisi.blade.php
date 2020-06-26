@extends('app')

@section('title')
 Laporan Kunjungan Slip Order {{$so->id_slip_order}}
@stop

@section('contentheader')
Laporan Kunjungan Slip Order {{$so->id_slip_order}}
@stop

@section('breadcrumb')
  <a href="{{route('teknisi.index')}}">Daftar Laporan Teknisi</a>
  <li>Laporan Kunjungan Slip Order {{$so->id_slip_order}}</li>
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

      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">	
              <label>Nama Customer</label>                           
              <input type="text" class="form-control" value="{{$so->nama_customer}}" disabled="true">
            </div>
            <div class="col-md-12">	
              <label>No. SO</label>                           
              <input type="text" class="form-control" value="{{$so->id_slip_order}}" disabled="true">
            </div>
            <div class="col-md-12">	
              <label>Tipe Mesin</label> 
              @foreach ($so->slipOrderDetail as $item)
              <input type="text" class="form-control" value="{{$item->nama_barang}}" disabled="true">
              @endforeach                           
              
            </div>            
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <label>Alamat</label>                           
              <textarea name="" class="form-control" cols="30" rows="4" disabled="true">{{$so->alamat_pemasangan}}</textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>No. Kontak</label>                           
              <input type="text" class="form-control" value="{{$so->no_hp}}" disabled="true">
            </div>
          </div>          
          
        </div>                
      </div>
<hr>

      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"> <a href="#form" data-toggle="tab"> Form  </a> </li>
          @if (! $laporan->isEmpty())
            <li>  <a href="#riwayat_pelaporan" data-toggle="tab"> Riwayat Pelaporan </a> </li>
          @endif
         
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="form">            				
            <div class="row">
              <div class="col-md-12">
                <form role="form" action="/storeLaporanTeknisi" method="POST" class="form-horizontal bordered-row" id="ism_form" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id_slip_order" value="{{$so->id_slip_order}}">
                  <div class="col-md-12">                  
                    <div class="form-group">
                      <label class="col-sm-2">Kunjungan<span class="required"></span> </label>
                        <div class="col-sm-6">                        
                          <select name="kunjungan" class="form-control">
                            <option value="" disabled="disabled" selected="selected">-- Pilihan Kunjungan --</option>
                            @if ($so->status_pemasangan === "Terpasang")
                              <option value="Maintenance">Maintenance</option>
                              <option value="Komplain">Komplain</option>
                              <option value="Tarik Barang">Tarik Barang</option>
                            @else
                              <option value="Pasang Baru">Pasang Baru</option>
                              <option value="Maintenance">Maintenance</option>
                              <option value="Komplain">Komplain</option>
                              <option value="Tarik Barang">Tarik Barang</option>
                            @endif                            
                          </select>                                            
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
                      <td rowspan="2"><input type="text" name="tanggal_laporan" class="form-control dateTime"></td>
                      <th class="text-center">TDS</th>
                      <td><input type="text" name="tds_sumber" class="form-control"></td>
                      <td><input type="text" name="tds_lv1" class="form-control"></td>
                      <td><input type="text" name="tds_lv2" class="form-control"></td>
                      <td><input type="text" name="tds_lv3" class="form-control"></td>
                      <td><input type="text" name="tds_lv4" class="form-control"></td>
                      <td><input type="text" name="tds_lv5" class="form-control"></td>
                      <td><input type="text" name="tds_lv6" class="form-control"></td>
                    </tr>
                    <tr>
                      <th class="text-center">pH</th>
                      <td>
                        <select name="ph_sumber" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select> 
                      </td>
                      <td>
                        <select name="ph_lv1" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select> 
                      </td>
                      <td>
                        <select name="ph_lv2" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select>
                      </td>
                      <td>
                        <select name="ph_lv3" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select>
                      </td>
                      <td>
                        <select name="ph_lv4" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select>
                      </td>
                      <td>
                        <select name="ph_lv5" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select>
                      </td>
                      <td>
                        <select name="ph_lv6" class="form-control">
                          <option value="" disabled="disabled" selected="selected">-- Pilihan Warna --</option>
                          <option value="Orange">Orange</option>
                          <option value="Kuning">Kuning</option>
                          <option value="Hijau">Hijau</option>
                          <option value="Biru">Biru</option>
                          <option value="Ungu">Ungu</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th colspan="9" class="text-center">keterangan</th>
                    </tr>
                    <tr>
                      <td colspan="9"><textarea name="keterangan" class="form-control" cols="30" rows="5"></textarea></td>
                    </tr>
                  </table>
                  <div class="bg-default content-box text-center pad20A mrg25T">
                    <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
                  </div>
                </form>
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
        </div> <!-- /.end tab content -->
      </div>
    </div><!-- /.col-md-12 -->
  </div><!-- /.row -->
  

  <div class="panel-footer">
    <a class="btn btn-border btn-alt border-black font-black btn-xs pull-right" href="/laporanTeknisi">
      <i class="fa fa-backward"></i> Kembali
    </a>
</div>

</div><!-- /.panel-body -->
    
@stop

@section('js')
    @parent    
@stop