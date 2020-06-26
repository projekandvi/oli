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
                                <td class="text-left" style="border: none;">: <small>Jual {{$so->tipe_penjualan}}</small></td>
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
                                    <th width="15%">Harga</th>
                                </tr>
                            </thead>	          
                            <tbody>	          	
                               @foreach ($so->slipOrderDetail as $item)
                                <tr>
                                    <td class="text-center"><small>{{$item->barang->nama_barang}}</small></td>
                                    <td class="text-center"><small>Rp {{ number_format($so->total_cart,0,'.','.') }}</small></td>  
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead style="background-color: #FFF !important;color: black !important;">
                                <tr>
                                    <th width="100%">Maintenance</th>
                                </tr>
                            </thead>	          
                            <tbody>	          	
                                <tr>
                                    <td> {{$so->layanan_service}} Bulan </td>
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
                        <td class="text-left" style="border: none;">: <small>{{$so->nama_customer}}</small></td>
                    </tr>	          
                    <tr>
                        <td class="text-left" style="border: none;">NIK</td>
                        <td class="text-left" style="border: none;">: <small>{{$so->no_ktp}}</small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Alamat</td>
                        <td class="text-left" style="border: none;">: <small>{{$so->alamat_pemasangan}}</small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">No Telp</td>
                        <td class="text-left" style="border: none;">: <small>{{$so->no_telp}}</small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">No HP</td>
                        <td class="text-left" style="border: none;">: <small>{{$so->no_hp}}</small></td>
                    </tr>
                    <tr>
                        <td class="text-left" style="border: none;">Tempat Tinggal</td>
                        <td class="text-left" style="border: none;">: <small>{{$so->milik_tempat_tinggal}}</small></td>
                    </tr>
	            </table>
	        </div>
	      <!-- /.col -->
	    </div> 
        <!-- header row ends-->    

	    <div class="row" >
	        <div class="col-sm-12"><h4 style="margin-top: -2%">Metode Pembayaran</h4></div>
	        <div class="col-sm-12">
	            <table class="table table-bordered center" style="width: 70%" align="center">
                    <thead style="background-color: #FFF !important;color: black !important;">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Metode Pembayaran</th>
                            <th width="10%">Bank</th>
                            <th width="10%">Nominal Pembayaran</th>
                        </tr>
                    </thead>	          
                    <tbody>	 @foreach ($pembayaran as $row)         	
                        <tr>                            
                            <td>{{$loop->iteration}}</td>
                            <td class="text-center">
                                @if ($row->metode_pembayaran === 'tunai')
                                   Tunai / Cash
                                @elseif($row->metode_pembayaran === 'visa')
                                   Visa
                                @elseif($row->metode_pembayaran === 'master')
                                    Master Card
                                @elseif($row->metode_pembayaran === 'kartu_debit')
                                    Kartu Debit
                                @elseif($row->metode_pembayaran === 'jcb')
                                    JCB
                                @endif 
                            </td> 
                            <td class="text-center">                                
                                @if ($row->id_bank != '-')
                                    {{$row->bank->nama_bank}}
                                @else
                                    {{$row->id_bank}}
                                @endif 
                            </td> 
                            <td class="text-right">Rp {{ number_format($row->nominal_pembayaran,0,'.','.') }}</td> 
                            
                        </tr>
                        @endforeach
                        <tr style="font-weight: bold; background-color: #F8F9F9;">
                            <td colspan="3" style="text-align: right;">Total :</td>
                            <td style="text-align: right; ">Rp {{ number_format($pembayaran->sum('nominal_pembayaran'),0,'.','.') }}</td>
                        </tr>
                        @if ($so->sisa_tagihan != 0)
                            <tr style="font-weight: bold; background-color: #F8F9F9;">
                                <td colspan="3" style="text-align: right;">Sisa Tagihan :</td>
                                <td style="text-align: right; ">Rp {{ number_format($so->sisa_tagihan,0,'.','.') }}</td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>

	      <!-- /.col -->
            </div>
            @if ($so->sisa_tagihan === 0 || $so->sisa_tagihan === 0.00)
                <div class="col-sm-12">	<img src="{!! asset('img/lunas.png') !!}" style="height: 110px;"></div>
            @endif
            
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