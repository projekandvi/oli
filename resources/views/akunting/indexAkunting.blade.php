@extends('app')

@section('title')
	Akunting
@stop

@section('contentheader')
Akunting List
@stop

@section('breadcrumb')
Akunting List
@stop

@section('main-content')
<style>
	.pilihanPencarian {
		display: none;
	}
</style>
	<div class="panel-heading">
		
		<a href="#" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"></a>

		@if(count(Request::input()))
			<span class="pull-right">	
	            <a class="btn btn-default btn-alt btn-xs" href="{{ action('SlipOrderController@getAkunting') }}"><i class="fa fa-eraser"></i> clear</a>
	            <a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
	        </span>
        @else
            <a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
        @endif
	</div>

	<div class="panel-body">
		<div class="row ">
			@foreach ($bank as $item)    
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake">			
					<div class="tile-box tile-box-alt bg-gradient-1 font-white">
						<div class="tile-header">
							Akun {{$item->nama_bank}}
						</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-shopping-cart"></i>
							<div class="tile-content">
								<span>Rp. {{ number_format($item->uangnya->sum('nominal_pembayaran'),0,'.','.') }}</span>
							</div>
						</div>
						<a href="/akunting/{{$item->kode_bank}}" class="tile-footer tooltip-button" data-placement="bottom" title="View Detail">
							View Detail
							<i class="glyph-icon icon-arrow-right"></i>
						</a>
					</div>			
				</div> 
			@endforeach	
		</div>
		<br>
		<hr>
		{{-- -------------------------------------------------------------------------------- --}}
		<div class="row "> 			
			<table class="table table-bordered">
				<thead class="bg-gradient-1">
					<td class="text-center font-white">#</td>
					<td class="text-center font-white">ID Slip Order</td>
					<td class="text-center font-white">Tipe Penjualan</td>
					<td class="text-center font-white">Debet</td>
					<td class="text-center font-white">Kredit</td>
					<td class="text-center font-white">Action</td>
				</thead>						
				<tbody>
					@foreach($slipOrder as $SO)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="text-center">{{$SO->id_slip_order}}</td>
							<td class="text-center">{{$SO->tipe_penjualan}}</td>
							<td class="text-center">-</td>
							<td class="uang text-right">

								@if ($SO->tipe_penjualan === 'Putus')
								Rp {{ number_format(($SO->total_cart - $SO->sisa_tagihan),0,'.','.') }}
								@endif
								@if ($SO->tipe_penjualan === 'SewaRecurring')
								Rp {{ number_format($SO->pembayar->where('id_slip_order',$SO->id_slip_order)->sum('nominal_pembayaran'),0,'.','.') }}
								@endif
								@if ($SO->tipe_penjualan === 'SewaPeriode')
								Rp {{ number_format($SO->pembayar->where('id_slip_order',$SO->id_slip_order)->sum('nominal_pembayaran'),0,'.','.') }}
								@endif
								
							</td>							
							<td class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										action<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											@if ($SO->tipe_penjualan === 'SewaRecurring')
												<a href="{{route('SO.details', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a>
												{!! Form::open(['url' => '/SO/detailsPutus','method' => 'post','class' => 'form-horizontal','id' => 'ism_form']) !!}
												<input type="hidden" value="{{$SO->id_slip_order}}" name="id_slip_order">
												{{-- <input class="btn btn-primary btn-xs" type="submit" id="submitButton" value="<i class="fa fa-eye" style="color: #269fed;"></i> Details"> --}}
												<button type="submit" style="background-color: Transparent;
												background-repeat:no-repeat;
												border: none;
												cursor:pointer;
												overflow: hidden;
												outline:none;">
													&nbsp;
													<i class="fa fa-eye" style="color: #269fed;"></i> Details
												</button>
												{!! Form::close() !!}
											@elseif($SO->tipe_penjualan === 'SewaPeriode') 
											<a href="{{route('SO.details', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a>
											@else
											{{-- <a href="{{route('SO.detailsPutus', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details</a> --}}
												{!! Form::open(['url' => '/SO/detailsPutus','method' => 'post','class' => 'form-horizontal','id' => 'ism_form']) !!}
												<input type="hidden" value="{{$SO->id_slip_order}}" name="id_slip_order">
												{{-- <input class="btn btn-primary btn-xs" type="submit" id="submitButton" value="<i class="fa fa-eye" style="color: #269fed;"></i> Details"> --}}
												<button type="submit" style="background-color: Transparent;
												background-repeat:no-repeat;
												border: none;
												cursor:pointer;
												overflow: hidden;
												outline:none;">
													&nbsp;
													<i class="fa fa-eye" style="color: #269fed;"></i> Details
												</button>
												{!! Form::close() !!}
											@endif
										</li>														
									</ul>
								</div>
							</td>
						</tr>											
					@endforeach
				</tbody>
			</table>

			<table style="width: 50%; font-weight: bold;" align="right" class="table table-bordered" >
				<tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
					<td style="text-align: right;"><b>Grand Total :</b></td>
					<td style="text-align: right;">Rp {{ number_format($dataPembayaran->sum('nominal_pembayaran'),0,'.','.') }}</td>
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
		$('#pencarianSelector').change(function(){
			$('.pilihanPencarian').hide();
			$('#' + $(this).val()).show();
		});
    });
	</script>

@stop