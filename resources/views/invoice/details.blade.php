@extends('app')

@section('title')
  {{$invoice->id_invoice}}
@stop

@section('contentheader')
  {{$invoice->id_invoice}} Details
@stop

@section('breadcrumb')
  <a href="{{route('akunting.index')}}">Invoice</a>
  <li>{{$invoice->id_invoice}}</li>
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
                <li class="active">
                  <a href="#details" data-toggle="tab">
                    Detail
                  </a>
                </li>
                <li>
                    <a href="#payment_history" data-toggle="tab">
                      Payment History
                    </a>
                </li>

                <li>
                    <a href="#make_payment" data-toggle="tab">
                      Make Payment
                    </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="details">
                    <form>				
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                  <div class="col-md-12">	
                                    <label>Tanggal</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->tanggal}}" disabled="true">
                                  </div>
                                  <div class="col-md-12">	
                                    <label>Team</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->team}}" disabled="true">
                                  </div>
                                  <div class="col-md-12">	
                                    <label>Nama Dealer</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->nama_seller}}" disabled="true">
                                  </div>
                                  <div class="col-md-12">	
                                    <label>Location</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->lokasi_penjualan}}" disabled="true">
                                  </div>
                                

                                
                                  <div class="col-md-12">	
                                    <label>CRC Code</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->crc_code}}" disabled="true">
                                  </div>
                                  <div class="col-md-12">	
                                    <label>LA Code</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->la_code}}" disabled="true">
                                  </div>
                                </div>

                               
                                
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>Nama Pembeli</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->nama_customer}}" disabled="true">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>No. KTP</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->no_ktp}}" disabled="true">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>Alamat</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->alamat_ktp}}" disabled="true">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>Alamat Pemasangan</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->alamat_pemasangan}}" disabled="true">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>No. Telp</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->no_telp}}" disabled="true">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label>No. HP.</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->no_hp}}" disabled="true">
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                    <label>Tempat Tinggal</label>                           
                                    <input type="text" class="form-control" value="{{$invoice->milik_tempat_tinggal}}" disabled="true">
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="tile-box tile-box-alt bg-gradient-9 font-white">
                                    <div class="tile-header">
                                      Sisa Tagihan
                                    </div>
                                    <div class="tile-content-wrapper">
                                      <i class="glyph-icon fa fa-money"></i>
                                      <div class="tile-content">
                                        <span>
                                            Rp {{ number_format($invoice->sisa_tagihan,0,'.','.') }}
                                          <small>
                                            {{-- Amount (
                                              Rp {{ number_format($totalTransaksiBelumLunas,0,'.','.') }}
                                              ) --}}
                                          </small>
                                        </span>
                                        </div>
                                    </div>
                                  </div>
                            </div><br><hr>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <br />
                                    <table class="table table-bordered">
                                      <thead class="bg-gradient-1">
                                        <td class="text-center font-white">Nama Barang</td>
                                        <td class="text-center font-white">Harga Barang</td>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="text-center">
                                            <ol class="text-left">
                                              @foreach ($invoice->tampung as $item)
                                              
                                                  <li>{{$item->nama_barang}}</li>
                                              
                                              @endforeach
                                            </ol>
                                          </td>
                                          
                                          <td class="text-center">Rp {{ number_format($invoice->harga,0,'.','.') }}</td>
                                        </tr>
                                      </tbody>
                                    </table>
                            </div>
                        </div>

                       
                    </form>
                                    
                                
                </div>
                <div class="tab-pane" id="payment_history">
                    <div class="col-md-12 text-center">
                        <label style="font-size: 20px;">Sisa Tagihan : Rp {{ number_format($invoice->sisa_tagihan,0,'.','.') }}</label>
                    </div><br><hr>

                    
                    @foreach ($pembayaran as $item)
                    <div class="row">
                        
                      <div class="col-md-12">
                          {{-- <label class="form-control">{{$item->metode_pembayaran}}</label>
                          <label class="form-control">{{$item->metode_pembayaran}}</label>
                          <label class="form-control">{{$item->jenis_bank}}</label>
                          <label class="form-control">Rp {{ number_format($item->jumlah,0,'.','.') }}</label> --}}
                        <form class="form-horizontal">
                          <div class="form-group">

                            <label class="col-sm-2 control-label"> 
                                {{$loop->iteration}}. Metode Pembayaran
                            </label>
                            <div class="col-sm-4">
                              <input class="form-control" type="text" value="{{$item->metode_pembayaran}}" disabled="">
                            </div>                  
                            <label class="col-sm-2 control-label"> 
                               Jenis Bank
                            </label>
                            <div class="col-sm-4">
                                <input type="text" disabled="" class="form-control" value="{{$item->jenis_bank}}">
                            </div>
                  
                          </div> <br>

                          <div class="form-group">

                            <label class="col-sm-2 control-label"> 
                             Nominal Pembayaran
                            </label>
                            <div class="col-sm-4">
                              <input class="form-control" type="text" value="Rp {{ number_format($item->jumlah,0,'.','.') }}" disabled="">
                            </div>                  
                            <label class="col-sm-2 control-label"> 
                               Catatan
                            </label>
                            <div class="col-sm-4">
                                {{-- <input type="text" disabled=""  value="{{$item->catatan}}"> --}}
                                <textarea class="form-control" id="" cols="30" rows="2" disabled=""> {{$item->catatan}} </textarea>
                            </div>
                  
                          </div>
                        </form>

                      </div>
                    </div>
                    
                    <br>
                    <hr>
                    @endforeach
                    
                </div>					
                <div class="tab-pane" id="make_payment">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <label style="font-size: 20px;">Sisa Tagihan : Rp {{ number_format($invoice->sisa_tagihan,0,'.','.') }}</label>
                        </div><br><hr>
                        {!! Form::model($invoice,['method' => 'post','action' => 'InvoiceController@bayar', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Nominal Pembayaran</label>                           
                                <input type="number" class="form-control" name="jumlah">
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" name="id_invoice"  value="{{$invoice->id_invoice}}">
                                <input type="hidden" name="id_customer"  value="{{$invoice->id_customer}}">
                                <input type="hidden" name="id_staf" value="{{Auth::user()->id}}" />	
                                <label>Metode Pembayaran</label>                           
                                {{-- <select name="metode_pembayaran" class="form-control">
                                    <option value="Visa">Visa</option>
                                    <option value="Master Card">Master Card</option>
                                    <option value="Kartu Kredit">Kartu Kredit</option>
                                    <option value="Tunai">Tunai</option>
                                </select> --}}
                                <select name="metode_pembayaran" id="colorselector" class="form-control">
                                  <option>-- Metode Pembayaran --</option>
                                  <option value="visa">Visa</option>
                                  <option value="master">Master Card </option>
                                  <option value="kartu_kredit">Kartu Kredit </option>
                                  <option value="tunai">Tunai</option>
                                </select>

                                
                            </div>
                            <div class="col-md-12">
                                <label>Jenis Bank</label>                           
                                <select name="jenis_bank" class="form-control">
                                    <option value="-">-- Bank List --</option>
                                    <option value="Bank BCA">Bank BCA</option>
                                    <option value="Bank Mandiri">Bank Mandiri</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            
                                <div class="col-md-12">
                                    <label>Catatan</label>                           
                                    <textarea name="catatan" class="form-control" id="" cols="30" rows="3"></textarea>
                                </div>
                            
                        </div>
                        <div class="col-md-12">
                        <div class="bg-default content-box text-center pad20A mrg25T">
                            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
                        </div>
                        </div>

                
                    {{ Form::close() }}
                    </div>
                </div>					
                                
              </div>
            

             </div>

                       
                
                       
                
                           
                     
             
  
              
                </div><!-- /.tab-pane -->
  
              <div class="tab-pane" id="timeline{{$invoice->id}}">
                  
               
               
                

              </div><!-- /.tab-pane -->
  
                
              </div><!-- /.tab-content -->
              <div class="panel-footer">  
                  <span style="padding: 10px;">
                  
                  </span> 
                <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="{{route('akunting.index')}}">
                      <i class="fa fa-backward"></i> {{trans('back')}}
                  </a>
              </div>
            </div><!-- /.nav-tabs-custom -->
          </div><!-- /.col -->

      </div>
      <!-- /.row -->

    </div>

    
@stop


@section('js')
    @parent
    <!-- <script>
        $('#search_field').on('keyup', function() {
          var value = $(this).val();
          var patt = new RegExp(value, "i");

          $('#myTable').find('tr').each(function() {
            if (!($(this).find('td').text().search(patt) >= 0)) {
              $(this).not('.myHead').hide();
            }
            if (($(this).find('td').text().search(patt) >= 0)) {
              $(this).show();
            }
          });

        });

    </script> -->
@stop