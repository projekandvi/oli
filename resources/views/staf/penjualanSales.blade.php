@extends('app')

@section('title')
	Penjualan VP / GM
@stop

@section('contentheader')
Daftar Penjualan VP / GM
@stop

@section('breadcrumb')
Daftar Penjualan VP / GM
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
				<td class="text-center font-white">#</td>
				<td class="text-center font-white">Slip Order</td>
				<td class="text-center font-white">Agency</td>
			</thead>						
			<tbody>
				@foreach($penjualan as $item)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">
							@if ($item->tipe_penjualan === 'SewaRecurring')
								<a href="{{route('SO.details', $item->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->id_slip_order}} </a>
							@elseif($item->tipe_penjualan === 'SewaPeriode')
								<a href="{{route('SO.detailsPeriode', $item->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->id_slip_order}} </a>
							@else 
								<a href="{{route('SO.detailsPutus', $item->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->id_slip_order}} </a>
							@endif
						</td>
						<td class="text-center">{{$item->salesnya->nama_sales}}</td>					
					</tr>										
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