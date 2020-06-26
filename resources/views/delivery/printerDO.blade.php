@extends('delivery.printer')

<style>
	thead tr th{
		text-align: center;
		font-size: 14px !important;
	}

	tbody tr td{
		font-size: 13px !important;
	}    
</style>

@section('main-content')
	<section class="invoice">
	    <div class="row">
	        <div class="col-sm-8">	          
              	<img src="{!! asset('img/logo_lifewater.png') !!}" style="height: 110px;">
                    <div class="row">
                        <div class="col-sm-12">
                            Ruko Sedayu Square Blok J No. 7, Cengkareng Jakarta Barat <br>
                            Care Center : 1500-877 <br><small>(working Hour Senin - Jumat 09.00 - 17.00 / Sabtu 09.00 - 11.000 )</small><br>
                            WhatsApp Care : 0811 913 1717 <small>(Chat Only)</small>                        
                        </div>                   
                    </div>                
	        </div>       	

	        <div class="col-sm-4" style="padding-top: 2%">
                <h3 class="text-left" style="text-decoration:underline">Delivery Order</h3>
                <h4 class="text-left">SURAT JALAN</h4>
	            
	        </div>
          <!-- /.col -->
          <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <td class="text-left" style="border: none;">No. Delivery Order</td>
                                <td class="text-left" style="border: none;">: <small>{{$do->id_do}}</small></td>
                            </tr>           
                            <tr>
                                <td class="text-left" style="border: none;">Tanggal</td>
                                <td class="text-left" style="border: none;">: <small>{{$tanggalan}}</small></td>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead style="background-color: #FFF !important;color: black !important;">
                                <tr>
                                    <th width="15%">Item Produk</th>
                                    <th width="15%">Barcode</th>
                                    <th width="15%">Lokasi Keluar Barang</th>
                                    <th width="5%">Jumlah</th>
                                </tr>
                            </thead>	          
                            <tbody>	
                                @foreach ($do->deliveryOrderDetail as $item)
                                <tr>
                                    <td class="text-center">{{$item->nama_barang}}</td>
                                    <td class="text-center">[{{$item->barcode1}},{{$item->barcode2}},{{$item->barcode3}},{{$item->barcode4}},{{$item->barcode5}}] </td>                    
                                    <td class="text-center">{{$item->lokasi->gudang->nama_gudang}} </td>                    
                                    <td class="text-center">{{$item->qty}} </td>
                                </tr>
                                @endforeach          	
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                         
            </div>       	

	       <div class="col-sm-4">
	            <table class="table">
                    <tr>
                        <td class="text-left" style="border: none;">No. Slip Order</td>
                        <td class="text-left" style="border: none;">: <small>{{$do->id_slip_order}}</small></td>
                    </tr>	          
                    <tr>
                        <td class="text-left" style="border: none;">Tanggal Penjualan</td>
                        <td class="text-left" style="border: none;">: <small>{{date('d-m-Y', strtotime($do->so->tanggal))}} </small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Lokasi Penjualan</td>
                        <td class="text-left" style="border: none;">: <small>{{$do->so->lokasi_penjualan}}</small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Nama Customer</td>
                        <td class="text-left" style="border: none;">: <small>{{$do->so->nama_customer}}</small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Alamat Kirim</td>
                        <td class="text-left" style="border: none;">: <small>{{$do->so->alamat_pemasangan}}</small></td>
                    </tr>
                </table>
	        </div>
	      <!-- /.col -->
	    </div> 
        <!-- header row ends-->    

	    <div class="row" >
	       
	      <!-- /.col -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	    	<div class="col-sm-4">
                
                    <table class="table table-bordered">
                      <tr>
                        <th><span style="text-decoration:underline">ISSUED BY :</span><br>DIKELUARKAN OLEH : <br><br><br><br></th>
                      </tr>
                    </table>
	        </div>
	    	<div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                      <th><span style="text-decoration:underline">RECEIVED & CHECKED BY :</span><br>DITERIMA DAN DIPERIKSA OLEH :<br><br><br><br></th>
                    </tr>
                  </table>
	        </div>
	    	<div class="col-sm-4">
                <table class="table table-bordered">
                    <tr>
                      <th><span style="text-decoration:underline">REMARK :</span><br>CATATAN :<br><br><br><br></th>
                    </tr>
                  </table>
	        </div>
	    </div>
  	</section>
	
@stop