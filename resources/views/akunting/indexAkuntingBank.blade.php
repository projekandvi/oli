@extends('app')

@section('title')
	Detail Akunting Bank {{$nama_bank->nama_bank}}
@stop

@section('contentheader')
Detail Akunting Bank {{$nama_bank->nama_bank}}
@stop

@section('breadcrumb')
Detail Akunting Bank {{$nama_bank->nama_bank}}
@stop

@section('main-content')

	<div class="panel-heading">
		
	<a href="/exportExcelPerBank/{{$nama_bank->kode_bank}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">Export to Excel</a>

		@if(count(Request::input()))
			<span class="pull-right">	
	            <a class="btn btn-default btn-alt btn-xs" href="{{ action('InvoiceController@getIndex') }}"><i class="fa fa-eraser"></i> clear</a>
	            <a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
	        </span>
        @else
            <a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
        @endif
	</div>

	<div class="panel-body">
		<div class="row "> 				

			<table class="table table-bordered">
				<thead class="bg-gradient-1">
					<td class="text-center font-white">#</td>
					<td class="text-center font-white">Tanggal Pembayaran</td>
					<td class="text-center font-white">ID Slip Order</td>
					<td class="text-center font-white">Keterangan Pembayaran</td>
					<td class="text-center font-white">Debet</td>
					<td class="text-center font-white">Kredit</td>
				</thead>						
				<tbody>
					@foreach($bank as $item)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="text-center">{{$item->tanggal_pembayaran}}</td>
							<td class="text-center">
								@if ($item->keterangan_pembayaran === 'Pembayaran Recurring')
									<a href="{{route('SO.details', $item->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->id_slip_order}} </a>
								@elseif($item->keterangan_pembayaran === 'Pembayaran Periode')
									<a href="{{route('SO.details', $item->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->id_slip_order}} </a>
								@else 
									<a href="{{route('SO.detailsPutus', $item->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> {{$item->id_slip_order}} </a>
								@endif						
							</td>
							<td class="text-center">{{$item->keterangan_pembayaran}}</td>
							<td class="text-center">-</td>
							<td class="uang text-right">Rp. {{ number_format($item->nominal_pembayaran,0,'.','.') }}</td>							
						</tr>											
					@endforeach
				</tbody>
			</table>

			<table style="width: 50%; font-weight: bold;" align="right" class="table table-bordered" >
				<tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
					<td style="text-align: right;"><b>Grand Total :</b></td>
					<td style="text-align: right;">Rp {{ number_format($bank->sum('nominal_pembayaran'),0,'.','.') }}</td>
				</tr>				
			</table> 			
		</div>
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;"></span> 
	  	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
			<i class="fa fa-backward"></i> Kembali
		</a>
	</div>	
@stop

@section('js')
	@parent
	<script>
		$(function() {
            $('#searchButton').click(function(event) {
                event.preventDefault();
                $('#searchModal').modal('show')
            });
        })
	</script>

@stop