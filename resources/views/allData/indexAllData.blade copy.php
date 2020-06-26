@extends('app')

@section('title')
	All Data
@stop

@section('contentheader')
All Data
@stop

@section('breadcrumb')
All Data
@stop

@section('main-content')

<style>
	.pilihanPencarian {
		display: none;
	}
</style>

<div class="panel-heading">		
	
	
	<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Data Perminggu</a>
	
	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="/allData"><i class="fa fa-eraser"></i> clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
	@endif
</div>

<div class="panel-body">
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<tr>
				<td class="text-center font-white">NO</td>
				<td colspan="2" class="text-center font-white">TANGGAL PENJUALAN</td>
				<td colspan="2" class="text-center font-white">TANGGAL UPGRADE</td>
				<td colspan="2" class="text-center font-white">NOMOR SO</td>
				<td colspan="2" class="text-center font-white">NAMA CUSTOMER</td>
				<td colspan="2" class="text-center font-white">TANGGAL LAHIR</td>
				<td colspan="2" class="text-center font-white">KEWARGANEGARAAN</td>
				<td colspan="2" class="text-center font-white">ALAMAT</td>
				<td colspan="2" class="text-center font-white">NO TELEPON</td>
				<td colspan="2" class="text-center font-white">HANDPHONE (1)</td>
				<td colspan="2" class="text-center font-white">HANDPHONE (2)</td>
				<td colspan="2" class="text-center font-white">NO KTP</td>
				<td colspan="2" class="text-center font-white">MANAGER</td>
				<td colspan="2" class="text-center font-white">SALES</td>
				<td colspan="2" class="text-center font-white">CRC CODE</td>
				<td colspan="2" class="text-center font-white">INVESTOR CODE</td>
				<td colspan="2" class="text-center font-white">LOKASI PEMBELIAN</td>
				<td colspan="2" class="text-center font-white">KECAMATAN</td>
				<td colspan="2" class="text-center font-white">KOTA / KABUPATEN</td>
				<td colspan="2" class="text-center font-white">PROVINSI</td>
				<td colspan="2" class="text-center font-white">MESIN NEW / UP / EXT</td>
				<td colspan="2" class="text-center font-white">MESIN TERPASANG</td>
				<td colspan="2" class="text-center font-white">FILTER TAMBAHAN</td>
				<td colspan="2" class="text-center font-white">PROGRAM</td>
				<td colspan="2" class="text-center font-white">NAMA PADA KARTU</td>
				<td colspan="2" class="text-center font-white">KARTU BANK</td>
				<td colspan="2" class="text-center font-white">NO KARTU</td>
				<td colspan="2" class="text-center font-white">TANGGAL AUTODEBIT</td>
				<td colspan="2" class="text-center font-white">TTD SURAT KUASA PENDEBITAN</td>
				<td colspan="2" class="text-center font-white">FREE SERVICE</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - TGL</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - TEKNISI</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - NO. INSTALASI</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - SUMBER</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - SEBELUM - TDS</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.1</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.2</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.3</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.4</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.5</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.6</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - SEBELUM - PH</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.1</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.2</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.3</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.4</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.5</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.6</td>
				<td colspan="2" class="text-center font-white">REMARKS</td>
				<td colspan="2" class="text-center font-white">HARGA</td>
				<td colspan="2" class="text-center font-white">DP</td>
				<td colspan="2" class="text-center font-white">PELUNASAN / CICILAN</td>
				<td colspan="2" class="text-center font-white">SISA</td>
				<td colspan="2" class="text-center font-white">SURAT PERJANJIAN</td>
				<td colspan="2" class="text-center font-white">STATUS SURAT PERJANJIAN - DIKELUARKAN</td>
				<td colspan="2" class="text-center font-white">STATUS SURAT PERJANJIAN - DITANDATANGANI</td>
				<td colspan="2" class="text-center font-white">KELENGKAPAN</td>
				<td colspan="2" class="text-center font-white">STATUS SEWA</td>
				<td colspan="2" class="text-center font-white">STATUS PASANG</td>
				<td colspan="2" class="text-center font-white">TANGGAL TARIK BARANG</td>
				<td colspan="2" class="text-center font-white">HABIS KONTRAK</td>
				<td colspan="2" class="text-center font-white">NO KARTU CUSTOMER</td>
				<td colspan="2" class="text-center font-white">BIAYA TRANSPORTASI</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - JADWAL</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - TEKNISI</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - TINDAKAN</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - BIAYA KUNJUNGAN</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - SUMBER</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - SEBELUM - TDS</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.1</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.2</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.3</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.4</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.5</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.6</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - SEBELUM - PH</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.1</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.2</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.3</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.4</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.5</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.6</td>
				<td colspan="2" class="text-center font-white">ACTION</td>
			</tr>
			
		</thead>						
		<tbody>
			@foreach($allData as $SO)	
			{!! Form::open(['url' => '/simpanUbahAllData','method' => 'post','class' => 'form-horizontal','id' => 'ism_form']) !!}			
				<tr>			
					<td class="text-center">{{$loop->iteration}}</td>

					<td class="text-center"><input type="text" id="so{{$SO->tanggal}}" value="{{date('d-m-Y', strtotime($SO->tanggal))}}"> </td>
					<td class="text-center"><input type="checkbox" id="ceklis{{$SO->tanggal}}" onclick="fungsiCeklis1{{$SO->tanggal}}()" name="vehicle1" value="Bike"> </td>

					<td class="text-center"><input type="text" value="{{date('d-m-Y', strtotime($SO->tanggal_upgrade))}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->id_slip_order}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->nama_customer}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{date('d-m-Y', strtotime($SO->customer->tanggal_lahir))}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->customer->kewarganegaraan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><textarea name="" id="" cols="40" rows="6">{{$SO->alamat_pemasangan}}</textarea> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->customer->no_telp}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->customer->no_hp}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->customer->no_hp2}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->customer->no_ktp}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->salesManagernya->nama_manajer}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->salesnya->nama_sales}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->crc_code}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->investor_code}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->lokasi_penjualan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->kecamatan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->kab_kot}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->provinsi}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center">
						@foreach ($SO->slipOrderDetail as $item)
							
							<input type="text" value="{{$item->kode_barang}}"> 
						@endforeach						
					</td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center">
						@foreach ($SO->slipOrderDetail as $item)
						<input type="text" value="{{$item->nama_barang}}"> 
						@endforeach						
					</td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>	

					<td class="text-center"><input type="text" value="BELUM DIISI"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->tipe_penjualan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->nama_pemilik_kartu_recurring}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>


					@if ($SO->jenis_bank_recurring != null)						
						<td class="text-center"><input type="text" value="{{$SO->bank->nama_bank}}">  <input type="text" value="{{$SO->jenis_kartu_kredit_recurring}}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@else
						<td class="text-center"><input type="text" value="{{$SO->jenis_bank_recurring}}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@endif

					<td class="text-center"><input type="text" value="{{$SO->nomor_kartu_recurring}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->tanggal_debit_recurring}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->ttd_sk_debit}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					
					@if ($SO->tempo_maintenance === '1970-01-01')						
						<td class="text-center"><input type="text" value=""> Mesin Belum Dipasang</td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@else
						<td class="text-center"><input type="text" value="{{date('d-m-Y', strtotime($SO->tempo_maintenance))}}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@endif
					
					@if ($SO->instalasi->tanggal_pemasangan === '1970-01-01')						
						<td class="text-center"><input type="text" value=""> Mesin Belum Dipasang</td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@else
						<td class="text-center"><input type="text" value="{{date('d-m-Y', strtotime($SO->instalasi->tanggal_pemasangan))}}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@endif

					<td class="text-center"><input type="text" value="{{$SO->instalasi->tek['nama_teknisi']}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value=" {{$SO->instalasi->kode_instalasi}}"></td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->sumber_air}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv1}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv6}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><textarea name="" id="" cols="40" rows="6">{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv1}}</textarea></td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv6}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->remark}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="Rp {{ number_format($SO->total_cart,0,'.','.') }}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					
					@foreach($SO->bayarDP->where('keterangan_pembayaran', 'PEMBAYARAN DP') as $isiDP)
						<td class="text-center"><input type="text" value="Rp {{ number_format($isiDP->nominal_pembayaran,0,'.','.') }}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@endforeach

					@foreach($SO->bayarDP->where('keterangan_pembayaran', 'CICILAN') as $isiCicilan)
						<td class="text-center"><input type="text" value="Rp {{ number_format($isiCicilan->nominal_pembayaran,0,'.','.') }}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@endforeach

					<td class="text-center"><input type="text" value="Rp {{ number_format($SO->sisa_tagihan,0,'.','.') }}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>	

					<td class="text-center"><input type="text" value="{{$SO->sp}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->sp_dikeluarkan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					
					<td class="text-center"><input type="text" value="{{$SO->sp_ditandatangani}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value=" {{$SO->kelengkapan}}"></td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->status_sewa}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->status_pemasangan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->tanggal_tarik_barang}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{date('d-m-Y', strtotime($SO->habis_kontrak))}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->no_kartu_customer}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="Rp {{ number_format($SO->biaya_transportasi,0,'.','.') }}"> </td>	
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					@if ($SO->service1->tanggal_perbaikan === '1970-01-01')						
						<td class="text-center"><input type="text" value="Belum Service"></td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@else
						<td class="text-center"><input type="text" value="{{date('d-m-Y', strtotime($SO->service1->tanggal_perbaikan))}}"> </td>
						<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>
					@endif

					<td class="text-center"><input type="text" value="{{$SO->service1->tek['nama_teknisi']}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->tindakan}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="Rp {{ number_format($SO->service1->biaya_kunjungan,0,'.','.') }}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->sumber_air}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_lv1}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->tds_lv6}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->ph_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><textarea name="" id="" cols="40" rows="6">{{$SO->service1->laporanTeknisiService1->ph_lv1}}</textarea></td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->ph_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->ph_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->ph_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->ph_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>

					<td class="text-center"><input type="text" value="{{$SO->service1->laporanTeknisiService1->ph_lv6}}"> </td>		
					<td class="text-center"><input type="checkbox" name="vehicle1" svalue="Bike"> </td>		
					
					<td class="text-center">
						<a href="allData/{{$SO->id_slip_order}}" class="btn btn-lg btn-primary">Proses Verifikasi</a>
					</td>		

				</tr>	
				{!! Form::close() !!}

				<script>
					function fungsiCeklis1{{$SO->tanggal}}() {
					  var checkBox = document.getElementById("ceklis1{{$SO->tanggal}}");
					  var text = document.getElementById("so1{{$SO->tanggal}}");
					  if (checkBox.checked == true){
						text.value = '';
						text.style.backgroundColor = "black";
						text.disabled = true;
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}
				  </script>

			@endforeach
		</tbody>
	</table>					
	<!--Pagination-->
	<div class="pull-right">
		{{ $allData->links() }}
	</div>
</div>

<div class="panel-footer">  
	<span style="padding: 10px;">	</span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrder">
		<i class="fa fa-backward"></i> Kembali
	</a>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	{{-- -----------------------------------------------------modal-------------------------------------- --}}

	

<!-- Slip Order search modal -->
<div class="modal fade" id="searchModal">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['class' => 'form-horizontal']) !!}
			{{-- <form action="/slipOrder/sewa/cari" enctype="multipart/form-data" class="form-horizontal" method="POST" id="ism_form"> --}}
				@csrf
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> search</h4>
			</div>

			<div class="modal-body">                  
				<div class="form-group">
					<label class="col-sm-3" style="text-align: left;">
						Pilihan Pencarian 
					</label>
					<div class="col-sm-9">
						<select id="pencarianSelector" class="form-control" onchange="munculPencarian()">
							<option value="" disabled selected>-- Pilihan Pencarian --</option>
							<option value="so">Slip Order</option>
							<option value="customer">Customer </option>
							<option value="manajer">Manajer Sales</option>
						</select>
					</div>					
				</div>
				<div class="pilihanPencarian" id="so">
					<div class="form-group  output">{{-- No. Slip Order  --}}
						<label class="col-sm-3" style="text-align: left;">
							No. Slip Order 
						</label>
						<div class="col-sm-9">
							{!! Form::text('slip_order_no', Request::get('slip_order_no'), ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>					
				<div class="pilihanPencarian" id="customer">
					<div class="form-group  output">{{-- Customer  --}}
						<label class="col-sm-3" style="text-align: left;">
							Customer
						</label>
						<div class="col-sm-9">
							{!! Form::select('customer', $customers, Request::get('customer'), ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select a customer']) !!}
						</div>
					</div>
				</div>					
				<div class="pilihanPencarian" id="manajer">
					<div class="form-group  output">
						<label class="col-sm-3" style="text-align: left;" >
							Manajer Sales
						</label>
						<div class="col-sm-9">
							{!! Form::text('manajer', Request::get('manajer'), ['class' => 'form-control','placeholder'=>"Isikan Nama Manajer Sales"]) !!}
						</div>
					</div>
				</div>		
				
				<div class="form-group">
					<label class="col-sm-3" style="text-align: left;" >
						Dari
					</label>
					<div class="col-sm-9">
						{!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
					</div>
				</div>	
				<div class="form-group">
					<label class="col-sm-3" style="text-align: left;" >
						Ke
					</label>
					<div class="col-sm-9">
						{!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
					</div>
				</div>																 
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
				{!! Form::submit('Search', ['class' => 'btn btn-primary', 'data-disable-with' => trans('searching')]) !!}
			</div>
			{!! Form::close() !!}
			{{-- </form> --}}
		</div>
	</div>
</div>
<!-- search modal ends -->



<!-- perminggu modal -->
<div class="modal fade" id="permingguModal">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['class' => 'form-horizontal'],['route'=> ['sewa.perminggu'], 'method'=>'post']) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Penjualan Sewa Perminggu</h4>
			</div>

			<div class="modal-body">                  
				
				<div class="form-group">
					<label class="col-sm-3" style="text-align: left;" >
						Dari
					</label>
					<div class="col-sm-9">
						{!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3" style="text-align: left;" >
						Ke
					</label>
					<div class="col-sm-9">
						{!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
					</div>
				</div>
																
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
				{!! Form::submit('Search', ['class' => 'btn btn-primary', 'data-disable-with' => trans('searching')]) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<!-- perminggu modal ends -->
@stop

@section('js')
@parent
<script>
	$(function() {
		$('#searchButton').click(function(event) {
			event.preventDefault();
			$('#searchModal').modal('show')
		});
	});

	$(function() {
		$('#convertButton').click(function(event) {
			event.preventDefault();
			$('#convertModal').modal('show')
		});
	});

	$('#permingguButton').click(function(event) {
			event.preventDefault();
			$('#permingguModal').modal('show')
		});

	$(function() {
		$('#pencarianSelector').change(function(){
			$('.pilihanPencarian').hide();
			$('#' + $(this).val()).show();
		});
    });

	$(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('0.000.000.000', {reverse: true});
    });

	
</script>



@stop