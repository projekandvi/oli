@extends('app')

@section('title')
	All Data Check Detail
@stop

@section('contentheader')
All Data Check
@stop

@section('breadcrumb')
All Data Check
@stop

@section('main-content')

<style>
	.pilihanPencarian {
		display: none;
	}
</style>

<div class="panel-body">
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<tr>
				<td colspan="2" class="text-center font-white">TANGGAL PENJUALAN [1]</td>
				<td colspan="2" class="text-center font-white">TANGGAL UPGRADE [2]</td>
				<td colspan="2" class="text-center font-white">NOMOR SO [3]</td>
				<td colspan="2" class="text-center font-white">NAMA CUSTOMER [4]</td>
				<td colspan="2" class="text-center font-white">TANGGAL LAHIR [5]</td>
				<td colspan="2" class="text-center font-white">KEWARGANEGARAAN [6]</td>
				<td colspan="2" class="text-center font-white">ALAMAT [7]</td>
				<td colspan="2" class="text-center font-white">NO TELEPON [8]</td>
				<td colspan="2" class="text-center font-white">HANDPHONE (1) [9]</td>
				<td colspan="2" class="text-center font-white">HANDPHONE (2) [10]</td>
				<td colspan="2" class="text-center font-white">NO KTP [11]</td>
				<td colspan="2" class="text-center font-white">MANAGER [12]</td>
				<td colspan="2" class="text-center font-white">SALES [13]</td>
				<td colspan="2" class="text-center font-white">CRC CODE [14]</td>
				<td colspan="2" class="text-center font-white">INVESTOR CODE [15]</td>
				<td colspan="2" class="text-center font-white">LOKASI PEMBELIAN [16]</td>
				<td colspan="2" class="text-center font-white">KECAMATAN [17]</td>
				<td colspan="2" class="text-center font-white">KOTA / KABUPATEN [18]</td>
				<td colspan="2" class="text-center font-white">PROVINSI [19]</td>
				<td colspan="2" class="text-center font-white">MESIN NEW / UP / EXT [20]</td>
				<td colspan="2" class="text-center font-white">MESIN TERPASANG [21]</td>
				<td colspan="2" class="text-center font-white">FILTER TAMBAHAN [22]</td>
				<td colspan="2" class="text-center font-white">PROGRAM [23]</td>
				<td colspan="2" class="text-center font-white">NAMA PADA KARTU [24]</td>
				<td colspan="2" class="text-center font-white">KARTU BANK [25]</td>
				<td colspan="2" class="text-center font-white">NO KARTU [26]</td>
				<td colspan="2" class="text-center font-white">TANGGAL AUTODEBIT [27]</td>
				<td colspan="2" class="text-center font-white">TTD SURAT KUASA PENDEBITAN [28]</td>
				<td colspan="2" class="text-center font-white">FREE SERVICE [29]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - TGL [30]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - TEKNISI [31]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - NO. INSTALASI [32]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - SUMBER [33]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - SEBELUM - TDS [34]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.1 [35]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.2 [36]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.3 [37]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.4 [38]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.5 [39]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - TDS LV.6 [40]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - SEBELUM - PH [41]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.1 [42]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.2 [43]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.3 [44]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.4 [45]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.5 [46]</td>
				<td colspan="2" class="text-center font-white">PEMASANGAN - HASIL - PH LV.6 [47]</td>
				<td colspan="2" class="text-center font-white">REMARKS [48]</td>
				<td colspan="2" class="text-center font-white">HARGA [49]</td>
				<td colspan="2" class="text-center font-white">DP [50]</td>
				<td colspan="2" class="text-center font-white">PELUNASAN / CICILAN [51]</td>
				<td colspan="2" class="text-center font-white">SISA [52]</td>
				<td colspan="2" class="text-center font-white">SURAT PERJANJIAN [53]</td>
				<td colspan="2" class="text-center font-white">STATUS SURAT PERJANJIAN - DIKELUARKAN [54]</td>
				<td colspan="2" class="text-center font-white">STATUS SURAT PERJANJIAN - DITANDATANGANI [55]</td>
				<td colspan="2" class="text-center font-white">KELENGKAPAN [56]</td>
				<td colspan="2" class="text-center font-white">STATUS SEWA [57]</td>
				<td colspan="2" class="text-center font-white">STATUS PASANG [58]</td>
				<td colspan="2" class="text-center font-white">TANGGAL TARIK BARANG [59]</td>
				<td colspan="2" class="text-center font-white">HABIS KONTRAK [60]</td>
				<td colspan="2" class="text-center font-white">NO KARTU CUSTOMER [61]</td>
				<td colspan="2" class="text-center font-white">BIAYA TRANSPORTASI [62]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - JADWAL [63]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - TEKNISI [64]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - TINDAKAN [65]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - BIAYA KUNJUNGAN [66]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - SUMBER [67]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - SEBELUM - TDS [68]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.1 [69]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.2 [70]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.3 [71]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.4 [72]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.5 [73]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - TDS LV.6 [74]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - SEBELUM - PH [75]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.1 [76]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.2 [77]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.3 [78]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.4 [79]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.5 [80]</td>
				<td colspan="2" class="text-center font-white">SERVICE 1 - HASIL - PH LV.6 [81]</td>
				<td colspan="2" class="text-center font-white">ACTION [82]</td>
			</tr>
			
		</thead>						
		<tbody>				
			{!! Form::open(['url' => '/simpanUbahAllData','method' => 'post','class' => 'form-horizontal','id' => 'ism_form']) !!}
				<input type="hidden" name="id_slip_order" value="{{$SO->id_slip_order}}">			
				<input type="hidden" name="id_customer" value="{{$SO->id_customer}}">			
				<tr>
					{{-- <td class="text-center"><input type="text" name="satu" id="so1" value="{{date('d-m-Y', strtotime($SO->tanggal))}}"> </td> --}}
					<td class="text-center"><input type="text" name="satu" id="so1" value="{{$SO->tanggal}}"> </td>
					<td class="text-center"><input type="checkbox" id="1" onclick="fungsiCeklis1()" > </td>

					{{-- <td class="text-center"><input type="text" name="dua" id="so2" value="{{date('d-m-Y', strtotime($SO->tanggal_upgrade))}}"> </td> --}}
					<td class="text-center"><input type="text" name="dua" id="so2" value="{{$SO->tanggal_upgrade}}"> </td>
					<td class="text-center"><input type="checkbox" id="2" onclick="fungsiCeklis2()"> </td>

					<td class="text-center"><input type="text" name="tiga" id="so3" value="{{$SO->id_slip_order}}"> </td>
					<td class="text-center"><input type="checkbox" id="3" onclick="fungsiCeklis3()"> </td>

					<td class="text-center"><input type="text" name="empat" id="so4" value="{{$SO->nama_customer}}"> </td>
					<td class="text-center"><input type="checkbox" id="4" onclick="fungsiCeklis4()"> </td>

					{{-- <td class="text-center"><input type="text" name="lima" id="so5" value="{{date('d-m-Y', strtotime($SO->customer->tanggal_lahir))}}"> </td> --}}
					<td class="text-center"><input type="text" name="lima" id="so5" value="{{$SO->customer->tanggal_lahir}}"> </td>
					<td class="text-center"><input type="checkbox" id="5" onclick="fungsiCeklis5()"> </td>

					<td class="text-center"><input type="text" name="enam" id="so6" value="{{$SO->customer->kewarganegaraan}}"> </td>
					<td class="text-center"><input type="checkbox" id="6" onclick="fungsiCeklis6()"> </td>

					<td class="text-center"><textarea name="tujuh" id="so7" cols="40" rows="6">{{$SO->alamat_pemasangan}}</textarea> </td>
					<td class="text-center"><input type="checkbox" id="7" onclick="fungsiCeklis7()"> </td>

					<td class="text-center"><input type="text" name="delapan" id="so8" value="{{$SO->customer->no_telp}}"> </td>
					<td class="text-center"><input type="checkbox" id="8" onclick="fungsiCeklis8()"> </td>

					<td class="text-center"><input type="text" name="sembilan" id="so9" value="{{$SO->customer->no_hp}}"> </td>
					<td class="text-center"><input type="checkbox" id="9" onclick="fungsiCeklis9()"> </td>

					<td class="text-center"><input type="text" name="sepuluh" id="so10" value="{{$SO->customer->no_hp2}}"> </td>
					<td class="text-center"><input type="checkbox" id="10" onclick="fungsiCeklis10()"> </td>

					<td class="text-center"><input type="text" name="sebelas" id="so11" value="{{$SO->customer->no_ktp}}"> </td>
					<td class="text-center"><input type="checkbox" id="11" onclick="fungsiCeklis11()"> </td>

					<td class="text-center"><input type="text" name="duabelas" id="so12" value="{{$SO->salesManagernya->nama_manajer}}"> </td>
					<td class="text-center"><input type="checkbox" id="12" onclick="fungsiCeklis12()"> </td>

					<td class="text-center"><input type="text" name="tigabelas" id="so13" value="{{$SO->salesnya->nama_sales}}"> </td>
					<td class="text-center"><input type="checkbox" id="13" onclick="fungsiCeklis13()"> </td>

					<td class="text-center"><input type="text" name="empatbelas" id="so14" value="{{$SO->crc_code}}"> </td>
					<td class="text-center"><input type="checkbox" id="14" onclick="fungsiCeklis14()"> </td>

					<td class="text-center"><input type="text" name="limabelas" id="so15" value="{{$SO->investor_code}}"> </td>
					<td class="text-center"><input type="checkbox" id="15" onclick="fungsiCeklis15()"> </td>

					<td class="text-center"><input type="text" name="enambelas" id="so16" value="{{$SO->lokasi_penjualan}}"> </td>
					<td class="text-center"><input type="checkbox" id="16" onclick="fungsiCeklis16()"> </td>

					<td class="text-center"><input type="text" name="tujuhbelas" id="so17" value="{{$SO->kecamatan}}"> </td>
					<td class="text-center"><input type="checkbox" id="17" onclick="fungsiCeklis17()"> </td>

					<td class="text-center"><input type="text" name="delapanbelas" id="so18" value="{{$SO->kab_kot}}"> </td>
					<td class="text-center"><input type="checkbox" id="18" onclick="fungsiCeklis18()"> </td>

					<td class="text-center"><input type="text" name="sembilanbelas" id="so19" value="{{$SO->provinsi}}"> </td>
					<td class="text-center"><input type="checkbox" id="19" onclick="fungsiCeklis19()"> </td>

					<td class="text-center">
						@foreach ($SO->slipOrderDetail as $item)							
							<input type="text" name="duapuluh" id="so20" value="{{$item->kode_barang}}"> 
						@endforeach						
					</td>
					<td class="text-center"><input type="checkbox" id="20" onclick="fungsiCeklis20()"> </td>

					<td class="text-center">
						@foreach ($SO->slipOrderDetail as $item)
						<input type="text" name="duapuluhsatu" id="so21" value="{{$item->nama_barang}}"> 
						@endforeach						
					</td>
					<td class="text-center"><input type="checkbox" id="21" onclick="fungsiCeklis21()"> </td>	

					<td class="text-center"><input type="text" name="duapuluhdua" id="so22" value="BELUM DIISI"> </td>
					<td class="text-center"><input type="checkbox" id="22" onclick="fungsiCeklis22()"> </td>

					<td class="text-center"><input type="text" name="duapuluhtiga" id="so23" value="{{$SO->tipe_penjualan}}"> </td>
					<td class="text-center"><input type="checkbox" id="23" onclick="fungsiCeklis23()"> </td>

					<td class="text-center"><input type="text" name="duapuluhempat" id="so24" value="{{$SO->nama_pemilik_kartu_recurring}}"> </td>
					<td class="text-center"><input type="checkbox" id="24" onclick="fungsiCeklis24()"> </td>


					@if ($SO->jenis_bank_recurring != null)						
						<td class="text-center">
							<input type="text" name="duapuluhlima" id="so25" value="{{$SO->bank->nama_bank}}"> 
							&nbsp;&nbsp;<input type="checkbox" id="25" onclick="fungsiCeklis25()"> 
							<input type="text" name="duapuluhenam" id="so26" value="{{$SO->jenis_kartu_kredit_recurring}}">
							&nbsp;&nbsp;<input type="checkbox" id="26" onclick="fungsiCeklis26()">  
						</td>
						<td class="text-center"></td>
					@else
						<td class="text-center"><input type="text" name="duapuluhtujuh" id="so27" value="{{$SO->jenis_bank_recurring}}"> </td>
						<td class="text-center"><input type="checkbox" id="27" onclick="fungsiCeklis27()"> </td>
					@endif

					<td class="text-center"><input type="text" name="duapuluhdelapan" id="so28" value="{{$SO->nomor_kartu_recurring}}"> </td>
					<td class="text-center"><input type="checkbox" id="28" onclick="fungsiCeklis28()"> </td>

					<td class="text-center"><input type="text" name="duapuluhsembilan" id="so29" value="{{$SO->tanggal_debit_recurring}}"> </td>
					<td class="text-center"><input type="checkbox" id="29" onclick="fungsiCeklis29()"> </td>

					<td class="text-center"><input type="text" name="tigapuluh" id="so30" value="{{$SO->ttd_sk_debit}}"> </td>
					<td class="text-center"><input type="checkbox" id="30" onclick="fungsiCeklis30()"> </td>
					
					@if ($SO->tempo_maintenance === '1970-01-01')						
						<td class="text-center"><input type="text" name="tigapuluhsatu" id="so31" value="Mesin Belum Dipasang"> </td>
						<td class="text-center"><input type="checkbox" id="31" onclick="fungsiCeklis31()"> </td>
					@else
						{{-- <td class="text-center"><input type="text" name="tigapuluhdua" id="so32" value="{{date('d-m-Y', strtotime($SO->tempo_maintenance))}}"> </td> --}}
						<td class="text-center"><input type="text" name="tigapuluhdua" id="so32" value="{{$SO->tempo_maintenance}}"> </td>
						<td class="text-center"><input type="checkbox" id="32" onclick="fungsiCeklis32()"> </td>
					@endif
					
					@if ($SO->instalasi->tanggal_pemasangan === '1970-01-01')						
						<td class="text-center"><input type="text" name="tigapuluhtiga" id="so33" value="Mesin Belum Dipasang"> </td>
						<td class="text-center"><input type="checkbox" id="33" onclick="fungsiCeklis33()"> </td>
					@else
						{{-- <td class="text-center"><input type="text" name="tigapuluhempat" id="so34" value="{{date('d-m-Y', strtotime($SO->instalasi->tanggal_pemasangan))}}"> </td> --}}
						<td class="text-center"><input type="text" name="tigapuluhempat" id="so34" value="{{$SO->instalasi->tanggal_pemasangan}}"> </td>
						<td class="text-center"><input type="checkbox" id="34" onclick="fungsiCeklis34()"> </td>
					@endif

					<td class="text-center"><input type="text" name="tigapuluhlima" id="so35" value="{{$SO->instalasi->tek['nama_teknisi']}}"> </td>
					<td class="text-center"><input type="checkbox" id="35" onclick="fungsiCeklis35()"> </td>

					<td class="text-center"><input type="text" name="tigapuluhenam" id="so36" value=" {{$SO->instalasi->kode_instalasi}}"></td>
					<td class="text-center"><input type="checkbox" id="36" onclick="fungsiCeklis36()"> </td>

					<td class="text-center"><input type="text" name="tigapuluhtujuh" id="so37" value="{{$SO->instalasi->laporanTeknisiInstalasi->sumber_air}}"> </td>
					<td class="text-center"><input type="checkbox" id="37" onclick="fungsiCeklis37()"> </td>

					<td class="text-center"><input type="text" name="tigapuluhdelapan" id="so38" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" id="38" onclick="fungsiCeklis38()"> </td>

					<td class="text-center"><input type="text" name="tigapuluhsembilan" id="so39" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv1}}"> </td>
					<td class="text-center"><input type="checkbox" id="39" onclick="fungsiCeklis39()"> </td>

					<td class="text-center"><input type="text" name="empatpuluh" id="so40" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" id="40" onclick="fungsiCeklis40()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhsatu" id="so41" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" id="41" onclick="fungsiCeklis41()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhdua" id="so42" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" id="42" onclick="fungsiCeklis42()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhtiga" id="so43" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" id="43" onclick="fungsiCeklis43()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhempat" id="so44" value="{{$SO->instalasi->laporanTeknisiInstalasi->tds_lv6}}"> </td>
					<td class="text-center"><input type="checkbox" id="44" onclick="fungsiCeklis44()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhlima" id="so45" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" id="45" onclick="fungsiCeklis45()"> </td>

					<td class="text-center"><textarea name="empatpuluhenam" id="so46" cols="40" rows="6">{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv1}}</textarea></td>
					<td class="text-center"><input type="checkbox" id="46" onclick="fungsiCeklis46()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhtujuh" id="so47" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" id="47" onclick="fungsiCeklis47()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhdelapan" id="so48" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" id="48" onclick="fungsiCeklis48()"> </td>

					<td class="text-center"><input type="text" name="empatpuluhsembilan" id="so49" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" id="49" onclick="fungsiCeklis49()"> </td>

					<td class="text-center"><input type="text" name="limapuluh" id="so50" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" id="50" onclick="fungsiCeklis50()"> </td>

					<td class="text-center"><input type="text" name="limapuluhsatu" id="so51" value="{{$SO->instalasi->laporanTeknisiInstalasi->ph_lv6}}"> </td>
					<td class="text-center"><input type="checkbox" id="51" onclick="fungsiCeklis51()"> </td>

					<td class="text-center"><textarea name="limapuluhdua" id="so46" cols="40" rows="6">{{$SO->remark}}</textarea></td>
					<td class="text-center"><input type="checkbox" id="52" onclick="fungsiCeklis52()"> </td>

					{{-- <td class="text-center"><input type="text" name="limapuluhtiga" id="so53" value="Rp {{ number_format($SO->total_cart,0,'.','.') }}"> </td> --}}
					<td class="text-center"><input type="text" name="limapuluhtiga" id="so53" value="{{$SO->total_cart}}"> </td>
					<td class="text-center"><input type="checkbox" id="53" onclick="fungsiCeklis53()"> </td>
					
					@foreach($SO->bayarDP->where('keterangan_pembayaran', 'PEMBAYARAN DP') as $isiDP)
						{{-- <td class="text-center"><input type="text" name="limapuluhempat" id="so54" value="Rp {{ number_format($isiDP->nominal_pembayaran,0,'.','.') }}"> </td> --}}
						<td class="text-center"><input type="text" name="limapuluhempat" id="so54" value="{{$isiDP->nominal_pembayaran}}"> </td>
						<td class="text-center"><input type="checkbox" id="54" onclick="fungsiCeklis54()"> </td>
					@endforeach

					@foreach($SO->bayarDP->where('keterangan_pembayaran', 'CICILAN') as $isiCicilan)
						{{-- <td class="text-center"><input type="text" name="limapuluhlima" id="so55" value="Rp {{ number_format($isiCicilan->nominal_pembayaran,0,'.','.') }}"> </td> --}}
						<td class="text-center"><input type="text" name="limapuluhlima" id="so55" value="{{$isiCicilan->nominal_pembayaran}}"> </td>
						<td class="text-center"><input type="checkbox" id="55" onclick="fungsiCeklis55()"> </td>
					@endforeach

					{{-- <td class="text-center"><input type="text" name="limapuluhenam" id="so56" value="Rp {{ number_format($SO->sisa_tagihan,0,'.','.') }}"> </td> --}}
					<td class="text-center"><input type="text" name="limapuluhenam" id="so56" value="{{$SO->sisa_tagihan}}"> </td>
					<td class="text-center"><input type="checkbox" id="56" onclick="fungsiCeklis56()"> </td>	

					<td class="text-center"><input type="text" name="limapuluhtujuh" id="so57" value="{{$SO->sp}}"> </td>
					<td class="text-center"><input type="checkbox" id="57" onclick="fungsiCeklis57()"> </td>

					<td class="text-center"><input type="text" name="limapuluhdelapan" id="so58" value="{{$SO->sp_dikeluarkan}}"> </td>
					<td class="text-center"><input type="checkbox" id="58" onclick="fungsiCeklis58()"> </td>
					
					<td class="text-center"><input type="text" name="limapuluhsembilan" id="so59" value="{{$SO->sp_ditandatangani}}"> </td>
					<td class="text-center"><input type="checkbox" id="59" onclick="fungsiCeklis59()"> </td>

					<td class="text-center"><input type="text" name="enampuluh" id="so60" value=" {{$SO->kelengkapan}}"></td>
					<td class="text-center"><input type="checkbox" id="60" onclick="fungsiCeklis60()"> </td>

					<td class="text-center"><input type="text" name="enampuluhsatu" id="so61" value="{{$SO->status_sewa}}"> </td>
					<td class="text-center"><input type="checkbox" id="61" onclick="fungsiCeklis61()"> </td>

					<td class="text-center"><input type="text" name="enampuluhdua" id="so62" value="{{$SO->status_pemasangan}}"> </td>
					<td class="text-center"><input type="checkbox" id="62" onclick="fungsiCeklis62()"> </td>

					<td class="text-center"><input type="text" name="enampuluhtiga" id="so63" value="{{$SO->tanggal_tarik_barang}}"> </td>
					<td class="text-center"><input type="checkbox" id="63" onclick="fungsiCeklis63()"> </td>

					{{-- <td class="text-center"><input type="text" name="enampuluhempat" id="so64" value="{{date('d-m-Y', strtotime($SO->habis_kontrak))}}"> </td> --}}
					<td class="text-center"><input type="text" name="enampuluhempat" id="so64" value="{{$SO->habis_kontrak}}"> </td>
					<td class="text-center"><input type="checkbox" id="64" onclick="fungsiCeklis64()"> </td>

					<td class="text-center"><input type="text" name="enampuluhlima" id="so65" value="{{$SO->no_kartu_customer}}"> </td>
					<td class="text-center"><input type="checkbox" id="65" onclick="fungsiCeklis65()"> </td>

					{{-- <td class="text-center"><input type="text" name="enampuluhenam" id="so66" value="Rp {{ number_format($SO->biaya_transportasi,0,'.','.') }}"> </td>	 --}}
					<td class="text-center"><input type="text" name="enampuluhenam" id="so66" value="{{$SO->biaya_transportasi}}"> </td>	
					<td class="text-center"><input type="checkbox" id="66" onclick="fungsiCeklis66()"> </td>

					@if ($SO->service1->tanggal_perbaikan === '1970-01-01')						
						<td class="text-center"><input type="text" name="enampuluhtujuh" id="so67" value="Belum Service"></td>
						<td class="text-center"><input type="checkbox" id="67" onclick="fungsiCeklis67()"> </td>
					@else
						{{-- <td class="text-center"><input type="text" name="enampuluhdelapan" id="so68" value="{{date('d-m-Y', strtotime($SO->service1->tanggal_perbaikan))}}"> </td> --}}
						<td class="text-center"><input type="text" name="enampuluhdelapan" id="so68" value="{{$SO->service1->tanggal_perbaikan}}"> </td>
						<td class="text-center"><input type="checkbox" id="68" onclick="fungsiCeklis68()"> </td>
					@endif

					<td class="text-center"><input type="text" name="enampuluhsembilan" id="so69" value="{{$SO->service1->tek['nama_teknisi']}}"> </td>
					<td class="text-center"><input type="checkbox" id="69" onclick="fungsiCeklis69()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluh" id="so70" value="{{$SO->service1->tindakan}}"> </td>
					<td class="text-center"><input type="checkbox" id="70" onclick="fungsiCeklis70()"> </td>

					{{-- <td class="text-center"><input type="text" name="tujuhpuluhsatu" id="so71" value="Rp {{ number_format($SO->service1->biaya_kunjungan,0,'.','.') }}"> </td> --}}
					<td class="text-center"><input type="text" name="tujuhpuluhsatu" id="so71" value="{{ $SO->service1->biaya_kunjungan}}"> </td>
					<td class="text-center"><input type="checkbox" id="71" onclick="fungsiCeklis71()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhdua" id="so72" value="{{$SO->service1->laporanTeknisiService1->sumber_air}}"> </td>
					<td class="text-center"><input type="checkbox" id="72" onclick="fungsiCeklis72()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhtiga" id="so73" value="{{$SO->service1->laporanTeknisiService1->tds_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" id="73" onclick="fungsiCeklis73()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhempat" id="so74" value="{{$SO->service1->laporanTeknisiService1->tds_lv1}}"> </td>
					<td class="text-center"><input type="checkbox" id="74" onclick="fungsiCeklis74()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhlima" id="so75" value="{{$SO->service1->laporanTeknisiService1->tds_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" id="75" onclick="fungsiCeklis75()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhenam" id="so76" value="{{$SO->service1->laporanTeknisiService1->tds_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" id="76" onclick="fungsiCeklis76()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhtujuh" id="so77" value="{{$SO->service1->laporanTeknisiService1->tds_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" id="77" onclick="fungsiCeklis77()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhdelapan" id="so78" value="{{$SO->service1->laporanTeknisiService1->tds_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" id="78" onclick="fungsiCeklis78()"> </td>

					<td class="text-center"><input type="text" name="tujuhpuluhsembilan" id="so79" value="{{$SO->service1->laporanTeknisiService1->tds_lv6}}"> </td>
					<td class="text-center"><input type="checkbox" id="79" onclick="fungsiCeklis79()"> </td>

					<td class="text-center"><input type="text" name="delapanpuluh" id="so80" value="{{$SO->service1->laporanTeknisiService1->ph_sumber}}"> </td>
					<td class="text-center"><input type="checkbox" id="80" onclick="fungsiCeklis80()"> </td>

					<td class="text-center"><textarea name="delapanpuluhsatu" id="so81" cols="40" rows="6">{{$SO->service1->laporanTeknisiService1->ph_lv1}}</textarea></td>
					<td class="text-center"><input type="checkbox" id="81" onclick="fungsiCeklis81()"> </td>

					<td class="text-center"><input type="text" name="delapanpuluhdua" id="so82" value="{{$SO->service1->laporanTeknisiService1->ph_lv2}}"> </td>
					<td class="text-center"><input type="checkbox" id="82" onclick="fungsiCeklis82()"> </td>

					<td class="text-center"><input type="text" name="delapanpuluhtiga" id="so83" value="{{$SO->service1->laporanTeknisiService1->ph_lv3}}"> </td>
					<td class="text-center"><input type="checkbox" id="83" onclick="fungsiCeklis83()"> </td>

					<td class="text-center"><input type="text" name="delapanpuluhempat" id="so84" value="{{$SO->service1->laporanTeknisiService1->ph_lv4}}"> </td>
					<td class="text-center"><input type="checkbox" id="84" onclick="fungsiCeklis84()"> </td>

					<td class="text-center"><input type="text" name="delapanpuluhlima" id="so85" value="{{$SO->service1->laporanTeknisiService1->ph_lv5}}"> </td>
					<td class="text-center"><input type="checkbox" id="85" onclick="fungsiCeklis85()"> </td>

					<td class="text-center"><input type="text" name="delapanpuluhenam" id="so86" value="{{$SO->service1->laporanTeknisiService1->ph_lv6}}"> </td>		
					<td class="text-center"><input type="checkbox" id="86" onclick="fungsiCeklis86()"> </td>		
					
					<td class="text-center">
						<input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="Simpan" onclick="submitted()">
					</td>		

				</tr>	
				{!! Form::close() !!}

				<script>

					function fungsiCeklis1() {
					  var checkBox = document.getElementById("1");
					  var text = document.getElementById("so1");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis2() {
					  var checkBox = document.getElementById("2");
					  var text = document.getElementById("so2");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis3() {
					  var checkBox = document.getElementById("3");
					  var text = document.getElementById("so3");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis4() {
					  var checkBox = document.getElementById("4");
					  var text = document.getElementById("so4");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis5() {
					  var checkBox = document.getElementById("5");
					  var text = document.getElementById("so5");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis6() {
					  var checkBox = document.getElementById("6");
					  var text = document.getElementById("so6");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis7() {
					  var checkBox = document.getElementById("7");
					  var text = document.getElementById("so7");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis8() {
					  var checkBox = document.getElementById("8");
					  var text = document.getElementById("so8");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis9() {
					  var checkBox = document.getElementById("9");
					  var text = document.getElementById("so9");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis10() {
					  var checkBox = document.getElementById("10");
					  var text = document.getElementById("so10");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis11() {
					  var checkBox = document.getElementById("11");
					  var text = document.getElementById("so11");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis12() {
					  var checkBox = document.getElementById("12");
					  var text = document.getElementById("so12");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis13() {
					  var checkBox = document.getElementById("1");
					  var text = document.getElementById("so13");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis14() {
					  var checkBox = document.getElementById("14");
					  var text = document.getElementById("so14");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis15() {
					  var checkBox = document.getElementById("15");
					  var text = document.getElementById("so15");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis16() {
					  var checkBox = document.getElementById("16");
					  var text = document.getElementById("so16");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis17() {
					  var checkBox = document.getElementById("17");
					  var text = document.getElementById("so17");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis17() {
					  var checkBox = document.getElementById("17");
					  var text = document.getElementById("so17");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis18() {
					  var checkBox = document.getElementById("18");
					  var text = document.getElementById("so18");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis19() {
					  var checkBox = document.getElementById("19");
					  var text = document.getElementById("so19");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis20() {
					  var checkBox = document.getElementById("20");
					  var text = document.getElementById("so20");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis21() {
					  var checkBox = document.getElementById("21");
					  var text = document.getElementById("so21");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis22() {
					  var checkBox = document.getElementById("22");
					  var text = document.getElementById("so22");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis23() {
					  var checkBox = document.getElementById("23");
					  var text = document.getElementById("so23");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis24() {
					  var checkBox = document.getElementById("24");
					  var text = document.getElementById("so24");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis25() {
					  var checkBox = document.getElementById("25");
					  var text = document.getElementById("so25");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis26() {
					  var checkBox = document.getElementById("26");
					  var text = document.getElementById("so26");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis27() {
					  var checkBox = document.getElementById("27");
					  var text = document.getElementById("so27");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis28() {
					  var checkBox = document.getElementById("28");
					  var text = document.getElementById("so28");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis29() {
					  var checkBox = document.getElementById("29");
					  var text = document.getElementById("so29");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis30() {
					  var checkBox = document.getElementById("30");
					  var text = document.getElementById("so30");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis31() {
					  var checkBox = document.getElementById("31");
					  var text = document.getElementById("so31");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis32() {
					  var checkBox = document.getElementById("32");
					  var text = document.getElementById("so32");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis33() {
					  var checkBox = document.getElementById("33");
					  var text = document.getElementById("so33");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis34() {
					  var checkBox = document.getElementById("34");
					  var text = document.getElementById("so34");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis35() {
					  var checkBox = document.getElementById("35");
					  var text = document.getElementById("so35");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis36() {
					  var checkBox = document.getElementById("36");
					  var text = document.getElementById("so36");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis37() {
					  var checkBox = document.getElementById("37");
					  var text = document.getElementById("so37");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis38() {
					  var checkBox = document.getElementById("38");
					  var text = document.getElementById("so38");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis39() {
					  var checkBox = document.getElementById("39");
					  var text = document.getElementById("so39");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis40() {
					  var checkBox = document.getElementById("40");
					  var text = document.getElementById("so40");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis41() {
					  var checkBox = document.getElementById("41");
					  var text = document.getElementById("so41");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis42() {
					  var checkBox = document.getElementById("42");
					  var text = document.getElementById("so42");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis43() {
					  var checkBox = document.getElementById("43");
					  var text = document.getElementById("so43");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis44() {
					  var checkBox = document.getElementById("44");
					  var text = document.getElementById("so44");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis45() {
					  var checkBox = document.getElementById("45");
					  var text = document.getElementById("so45");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis46() {
					  var checkBox = document.getElementById("46");
					  var text = document.getElementById("so46");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis47() {
					  var checkBox = document.getElementById("47");
					  var text = document.getElementById("so47");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis48() {
					  var checkBox = document.getElementById("48");
					  var text = document.getElementById("so48");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis49() {
					  var checkBox = document.getElementById("49");
					  var text = document.getElementById("so49");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis50() {
					  var checkBox = document.getElementById("50");
					  var text = document.getElementById("so50");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis51() {
					  var checkBox = document.getElementById("51");
					  var text = document.getElementById("so51");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis52() {
					  var checkBox = document.getElementById("52");
					  var text = document.getElementById("so52");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis53() {
					  var checkBox = document.getElementById("53");
					  var text = document.getElementById("so53");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis54() {
					  var checkBox = document.getElementById("54");
					  var text = document.getElementById("so54");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis55() {
					  var checkBox = document.getElementById("55");
					  var text = document.getElementById("so55");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis56() {
					  var checkBox = document.getElementById("56");
					  var text = document.getElementById("so56");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis57() {
					  var checkBox = document.getElementById("57");
					  var text = document.getElementById("so57");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis58() {
					  var checkBox = document.getElementById("58");
					  var text = document.getElementById("so58");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis59() {
					  var checkBox = document.getElementById("59");
					  var text = document.getElementById("so59");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis60() {
					  var checkBox = document.getElementById("60");
					  var text = document.getElementById("so60");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis61() {
					  var checkBox = document.getElementById("61");
					  var text = document.getElementById("so61");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis62() {
					  var checkBox = document.getElementById("62");
					  var text = document.getElementById("so62");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis63() {
					  var checkBox = document.getElementById("63");
					  var text = document.getElementById("so63");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis64() {
					  var checkBox = document.getElementById("64");
					  var text = document.getElementById("so64");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis65() {
					  var checkBox = document.getElementById("65");
					  var text = document.getElementById("so65");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis66() {
					  var checkBox = document.getElementById("66");
					  var text = document.getElementById("so66");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis67() {
					  var checkBox = document.getElementById("67");
					  var text = document.getElementById("so6");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis68() {
					  var checkBox = document.getElementById("68");
					  var text = document.getElementById("so68");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis69() {
					  var checkBox = document.getElementById("69");
					  var text = document.getElementById("so6");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis70() {
					  var checkBox = document.getElementById("70");
					  var text = document.getElementById("so70");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis71() {
					  var checkBox = document.getElementById("71");
					  var text = document.getElementById("so71");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis72() {
					  var checkBox = document.getElementById("72");
					  var text = document.getElementById("so72");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis73() {
					  var checkBox = document.getElementById("73");
					  var text = document.getElementById("so73");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis74() {
					  var checkBox = document.getElementById("74");
					  var text = document.getElementById("so74");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis75() {
					  var checkBox = document.getElementById("75");
					  var text = document.getElementById("so75");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis76() {
					  var checkBox = document.getElementById("6");
					  var text = document.getElementById("so76");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis77() {
					  var checkBox = document.getElementById("77");
					  var text = document.getElementById("so77");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis78() {
					  var checkBox = document.getElementById("78");
					  var text = document.getElementById("so78");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis79() {
					  var checkBox = document.getElementById("79");
					  var text = document.getElementById("so79");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis80() {
					  var checkBox = document.getElementById("80");
					  var text = document.getElementById("so80");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis81() {
					  var checkBox = document.getElementById("81");
					  var text = document.getElementById("so81");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis82() {
					  var checkBox = document.getElementById("82");
					  var text = document.getElementById("so82");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis83() {
					  var checkBox = document.getElementById("83");
					  var text = document.getElementById("so83");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis84() {
					  var checkBox = document.getElementById("84");
					  var text = document.getElementById("so84");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis85() {
					  var checkBox = document.getElementById("85");
					  var text = document.getElementById("so85");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}

					function fungsiCeklis86() {
					  var checkBox = document.getElementById("86");
					  var text = document.getElementById("so86");
					  if (checkBox.checked == true){
						text.style.backgroundColor = "black";
					  } else {
						text.style.backgroundColor = "white";
						text.disabled = false;
					  }
					}
				  </script>

			
		</tbody>
	</table>					
	
</div>

<div class="panel-footer">  
	<span style="padding: 10px;">	</span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrder">
		<i class="fa fa-backward"></i> Kembali
	</a>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

	{{-- -----------------------------------------------------modal-------------------------------------- --}}

	


@stop

@section('js')
@parent
<script>
	$(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('0.000.000.000', {reverse: true});
    });

	
</script>



@stop