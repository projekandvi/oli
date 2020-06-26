@extends('app')

@section('title')
	Agency
@stop

@section('contentheader')
Daftar Sales VP / GM : {{$vp->nama_manajer}}
@stop

@section('breadcrumb')
Daftar Sales
@stop

@section('main-content')
<style>
	.pilihanPencarian {
		display: none;
	}
</style>
<div class="panel-heading">		
	<a class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"></a>
	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('SlipOrderController@getIndexSewaPeriode') }}"><i class="fa fa-eraser"></i> clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
	@endif
</div>

	<div class="panel-body">
		{{-- <a href="/konvert"> konvert</a> --}}

		<table class="table table-bordered">
			<thead class="bg-gradient-1">
				{{-- <td class="text-center font-white">#</td> --}}
				<td class="text-center font-white">Agency</td>
				<td class="text-center font-white">Total Penjualan</td>
			</thead>						
			<tbody>
				@foreach($sales as $item)
					<tr>
						{{-- <td class="text-center">{{$loop->iteration}}</td> --}}
						<td class="text-center">
							<a href="{{route('dataPenjualanSales', $item->id)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->nama_sales}} </a>
							</td>						
						<td class="text-center">{{$item->so->count('id_slip_order')}}</td>						
					</tr>										
				@endforeach
			</tbody>
		</table>
		<h2 class="text-center">Detail <br>
		<a href="/salesReportExcel/{{$vp->id}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">Export to Excel</a>
		</h2><br>
		<table class="table table-bordered">
			<thead class="bg-gradient-1">
				<tr>
					<th>VP / GM</th>
					<th>Agency</th>
					<th>ID Slip Order</th>
					<th>Jenis Penjualan</th>
					<th>Nominal Transaksi</th>
					<th>ID Customer</th>
					<th>Nama Customer</th>
				</tr>
			</thead>
			<tbody>
				@foreach($sales as $item)
					@php ($first = true)  @endphp
					@foreach($item->so as $row)
						<tr>
						@if($first == true)
							<td rowspan="{{$item->so->count('id_slip_order')}}"> {{$item->salesManager->nama_manajer}}</td>
							<td rowspan="{{$item->so->count('id_slip_order')}}"> {{$item->nama_sales}}</td>
							@php ($first = false) @endphp
						@endif
							<td> {{ $row->id_slip_order}} </td>
							<td> 
								{{ $row->tipe_penjualan }}
								@if ($row->tipe_penjualan === 'SewaPeriode')
									&nbsp; ({{ $row->periode_sewa }} Bulan)
								@endif
							</td>
							<td>
								@if ($row->tipe_penjualan === 'SewaRecurring')
									Rp. {{ number_format($biaya_sewa->biaya_sewa,0,'.','.') }}
								@else
									Rp. {{ number_format($row->total_cart,0,'.','.') }}
								@endif
							</td>
							<td>{{ $row->id_customer }}</td>
							<td>{{ $row->nama_customer }}</td>
						</tr>
					@endforeach
				@endforeach
			</tbody>
		</table>
					
				
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;">
		
		</span> 
	  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
			<i class="fa fa-backward"></i> Kembali
		</a>
	</div>

	{{-- -----------------------------------------------------modal-------------------------------------- --}}

	
@stop

@section('js')
	@parent
	<script>
		
	</script>

@stop