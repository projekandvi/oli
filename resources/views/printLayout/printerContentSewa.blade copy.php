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
              	<img src="{!! asset('img/logo_jajalin.png') !!}" style="height: 110px;">
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
                                <td class="text-left" style="border: none;">: {{$so->tanggal}}</td>
                            </tr>           
                            <tr>
                                <td class="text-left" style="border: none;">Nama Seller</td>
                                <td class="text-left" style="border: none;">: {{$so->salesnya->nama_sales}}</td>
                            </tr>
                            <tr>
                                <td class="text-left" style="border: none;">Location</td>
                                <td class="text-left" style="border: none;">: {{$so->lokasi_penjualan}}</td>
                            </tr>
                            <tr>
                                <td class="text-left" style="border: none;">CRC Code</td>
                                <td class="text-left" style="border: none;">: {{$so->crc_code}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table">
                            <tr>
                                <td class="text-left" style="border: none;">Team</td>
                                <td class="text-left" style="border: none;">: {{$so->salesManagernya->nama_manajer}}</td>
                            </tr>           
                            <tr>
                                <td class="text-left" style="border: none;">SPO Code</td>
                                <td class="text-left" style="border: none;">: </td>
                            </tr>
                            <tr>
                                <td class="text-left" style="border: none;">La Code</td>
                                <td class="text-left" style="border: none;">: {{$so->la_code}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead style="background-color: #FFF !important;color: black !important;">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="5%">Item Produk</th>
                                    <th width="15%">Periode Sewa</th>
                                    <th width="15%">Harga</th>
                                </tr>
                            </thead>	          
                            <tbody>	          	
                                <tr>
                                    <td>1</td>
                                    <td class="text-center">Lifewater 2.0 </td>
                                    <td class="text-center">1 Thn </td>                    
                                    <td class="text-center">600.000 / Bulan</td>
                                </tr>
                            </tbody>
                        </table>
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
                        <td class="text-left" style="border: none;">: {{$so->alamat}}</td>
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
	        <div class="col-sm-4">
	            <table class="table">
                    <tr>
                        <td class="text-left" style="border: none;">Harga Sewa</td>
                        <td class="text-left" style="border: none;">: 7.200.000 / Tahun</td>
                    </tr>	          
                    <tr>
                        <td class="text-left" style="border: none;">DP / Down Payment</td>
                        <td class="text-left" style="border: none;">: Rp {{ number_format($so->dp,0,'.','.') }}</td>
                    </tr>
                    {{-- <tr>
                        <td class="text-left" style="border: none;">&#10065; Sisa </td>
                        <td class="text-left" style="border: none;">: Rp. 6.600.000</td>
                    </tr> --}}
                    <tr>
                        <td class="text-left" style="border: none;">&#10065; Pelunasan </td>
                        <td class="text-left" style="border: none;">: ....</td>
                    </tr>
                </table>
	        </div>
	        <div class="col-sm-8">	        
                <div class="col-sm-6">
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
                        </tr>	          
                        <tr>
                            <td style="border: none;">
                                @if ($pembayaran->metode_pembayaran === 'Master Card')
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
                        </tr>
                        <tr>
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
                <div class="col-sm-6"> 
                    <textarea name="" placeholder="Catatan" id="" cols="20" rows="5"></textarea>
                </div>           
	        </div>
	      <!-- /.col -->
	    </div>
	    <!-- /.row -->
	    <div class="row">
	    	<div class="col-sm-8">
	          	<span class="declaration_header">Note</span>
                  <br>
                  <small>
                  <ol type="1">
                    <li>Jika dalam waktu 3 bulan tidak ada pelunasan, maka uang (DP) akan hilang / tidak dapat dikembalikan</li>
                    <li>Semua alat pemasangan diluar paket sewa seperti kran angsa, selang air (lebih dari 4 meter) stop kontak listrik adalah tanggung jawab penyewa</li>
                    <li>Jika teknisi tiba dilokasi sesuai dengan jadwal pemasangan yang sudah disepakati tetapi dijadwalkan ulang karena alasan tertentu oleh customer, maka pada jadwal berikutnya customer dikenakan biaya Rp. 100.000,- untuk wilayah DKI Jakarta, Rp. 150.000,- untuk wilayah Depok, Bekasi Kota, Tangerang Kota dan Rp. 250.000,- untuk wilayah bogor, Bekasi Kabupaten, Tangerang Kabupaten.</li>
                    <li>Pembatalan sewa sepihak oleh Customer akan mengakibatkan uang muka (DP) senilai Rp. 600.000,- tidak dapat dikembalikan ditambah dengan biaya administrasi senilai 20% dari total nilai administrasi</li>
                    <li>Syarat & Ketentuan Berlaku</li>
                  </ol> 
                </small>
	        </div>
	    </div>
  	</section>
	
@stop