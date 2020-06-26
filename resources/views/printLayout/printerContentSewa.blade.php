@extends('printLayout.printer')

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
                <h3 class="text-center">Slip Order</h3>
	            <table class="table">
	          	    <tr>
	          	 	    <td style="border: none;">No. OR</td>
	          	 	    <td style="border: none;">{{$so->id_slip_order}}</td>
	          	    </tr>	
	            </table>
	        </div>
          <!-- /.col -->
          <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table">
                            <tr>
                                <td class="text-left" style="border: none;">Tanggal</td>
                                <td class="text-left" style="border: none;">: <small>{{$so->tanggal}}</small></td>
                            </tr>           
                            <tr>
                                <td class="text-left" style="border: none;">Agency</td>
                                <td class="text-left" style="border: none;">: <small>{{$so->salesnya->nama_sales}}</small></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="border: none;">Lokasi</td>
                                <td class="text-left" style="border: none;">: <small>{{$so->lokasi_penjualan}}</small></td>
                            </tr>
                            <tr>
                                <td class="text-left" style="border: none;">Tipe Penjualan</td>
                                <td class="text-left" style="border: none;">: <small>{{$so->tipe_penjualan}}</small></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table">
                            <tr>
                                <td class="text-left" style="border: none;">VP / GM</td>
                                <td class="text-left" style="border: none;">: <small>{{$so->salesManagernya->nama_manajer}}</small></td>
                            </tr>           
                            <tr>
                                <td class="text-left" style="border: none;">Agency Code</td>
                                <td class="text-left" style="border: none;">: {{$so->salesnya->agency_code}}</td>
                            </tr>
                            <tr>
                                <td class="text-left" style="border: none;">CRC Code</td>
                                <td class="text-left" style="border: none;">: {{$so->crc_code}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead style="background-color: #FFF !important;color: black !important;">
                                <tr>
                                    <th width="5%">Item Produk</th>
                                    <th width="15%">Periode Sewa</th>
                                    <th width="15%">Harga</th>
                                </tr>
                            </thead>	          
                            <tbody>	
                                @foreach ($so->slipOrderDetail as $item)
                                <tr>
                                    <td class="text-center">{{$item->barang->nama_barang}}</td>
                                    <td class="text-center">{{$so->tipe_penjualan}} </td>                    
                                    <td class="text-center"><small> Rp {{ number_format($biaya_sewa->biaya_sewa,0,'.','.') }} / Bulan</small></td>
                                </tr>
                                @endforeach          	
                               
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table borderless">
                           <tr>
                                <td style="width: 50%" class="text-left" style="border: none;">DP / Down Payment</td>
                                <td style="width: 50%" class="text-right" style="border: none;">: Rp {{ number_format($pembayaran->nominal_pembayaran,0,'.','.') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">	        
                        <div class="col-sm-12">
                            <table class="table borderless">
                                <tr>
                                    <td style="border: none;">
                                        @if ($pembayaran->metode_pembayaran === 'visa')
                                        &#9989;        
                                        @else
                                        &#10065;
                                        @endif
                                    </td>
                                    <td class="text-left" style="border: none;">Visa</td>
                                    <td style="border: none;">
                                        @if ($pembayaran->metode_pembayaran === 'master')
                                        &#9989;        
                                        @else
                                        &#10065;
                                        @endif
                                    </td>
                                    <td class="text-left" style="border: none;">Master Card</td>
                                </tr>	          
                               
                                <tr>
                                    <td style="border: none;">
                                        @if ($pembayaran->metode_pembayaran === 'kartu_debit')
                                        &#9989;        
                                        @else
                                        &#10065;
                                        @endif
                                    </td>
                                    <td class="text-left" style="border: none;">Autodebit</td>
                                    <td style="border: none;">
                                        @if ($pembayaran->metode_pembayaran === 'tunai')
                                        &#9989;        
                                        @else
                                        &#10065;
                                        @endif
                                    </td>
                                    <td class="text-left" style="border: none;">Tunai / Cash</td>
                                </tr>
                            </table>
                        </div>
                                  
                    </div>
                </div>          
            </div>       	

	       <div class="col-sm-4">
	            <table class="table">
                    <tr>
                        <td class="text-left" style="border: none;">Nama Pembeli</td>
                        <td class="text-left" style="border: none;">: {{$so->nama_customer}}</td>
                    </tr>	          
                    <tr>
                        <td class="text-left" style="border: none;">NIK</td>
                        <td class="text-left" style="border: none;">: {{$so->no_ktp}}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Alamat</td>
                        <td class="text-left" style="border: none;">: {{$so->alamat_pemasangan}}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">No Telp</td>
                        <td class="text-left" style="border: none;">: {{$so->no_telp}}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">No HP</td>
                        <td class="text-left" style="border: none;">: {{$so->no_hp}}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Tempat Tinggal</td>
                        <td class="text-left" style="border: none;">: {{$so->milik_tempat_tinggal}}</td>
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
	    	<div class="col-sm-12">
	          	<span class="declaration_header">Note</span>
                  <br>
                  <small>
                  <ol type="1">
                    <li>Jika dalam waktu 3 bulan tidak ada pelunasan, maka uang (DP) akan hilang / tidak dapat dikembalikan</li>
                    <li>Semua alat pemasangan diluar paket sewa seperti kran angsa, selang air (lebih dari 4 meter) stop kontak listrik adalah tanggung jawab penyewa</li>
                    <li>Jika teknisi tiba dilokasi sesuai dengan jadwal pemasangan yang sudah disepakati tetapi dijadwalkan ulang karena alasan tertentu oleh customer, maka pada jadwal berikutnya customer dikenakan biaya Rp. 100.000,- untuk wilayah DKI Jakarta, Rp. 150.000,- untuk wilayah Depok, Bekasi Kota, Tangerang Kota dan Rp. 250.000,- untuk wilayah bogor, Bekasi Kabupaten, Tangerang Kabupaten.</li>
                    <li>Pembatalan sewa sepihak oleh Customer akan mengakibatkan uang muka (DP)</li>
                    <li>Syarat & Ketentuan Berlaku</li>
                  </ol> 
                </small>
	        </div>
	    </div>
  	</section>
	
@stop