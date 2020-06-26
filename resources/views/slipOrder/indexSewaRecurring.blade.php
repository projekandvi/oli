@extends('app')

@section('title')
	Slip Order Sewa Recurring
@stop

@section('contentheader')
Daftar Slip Order Sewa Recurring
@stop

@section('breadcrumb')
Daftar Slip Order Sewa Recurring
@stop

@section('main-content')

<style>
	.pilihanPencarian {
		display: none;
	}
</style>

<div class="panel-heading">		
	<a data-toggle="modal" data-target="#recurring10" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-refresh'></i> Recurring Bank Tgl 10</a>
	<a data-toggle="modal" data-target="#recurring25" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-refresh'></i> Recurring Bank Tgl 25</a>
	<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Data Perminggu</a>
	<a href="/FaultDataRecurring" class="btn btn-danger btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i>Fault Data Recurring</a>
	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="/slipOrderSewaRecurring"><i class="fa fa-eraser"></i> clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
	@endif
</div>

<div class="panel-body">
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<td class="text-center font-white">#</td>
			<td class="text-center font-white">ID Slip Order</td>
			<td class="text-center font-white">Tanggal</td>
			<td class="text-center font-white">Tipe Penjualan</td>
			<td class="text-center font-white">Lokasi</td>
			<td class="text-center font-white">Sales Amount</td>
			<td class="text-center font-white">Nama Customer</td>
			<td class="text-center font-white">No hp</td>
			<td class="text-center font-white">Action</td>
		</thead>						
		<tbody>
			@foreach($sewa as $SO)
				@if ($SO->tarikan_barang === 'TRUE')
					<tr style="background-color: red">
				@elseif ($SO->instalasi === null)					
					<tr style="background-color: yellow">									
				@elseif ($SO->instalasi != null)
					@if ($SO->instalasi->tanggal_pemasangan > $hariIni)
						<tr style="background-color: green">
					@endif				
				@else
				<tr>
				@endif				
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$SO->id_slip_order}}</td>
					<td class="text-center">{{date('d-m-Y', strtotime($SO->tanggal))}}</td>
					<td class="text-center">{{$SO->tipe_penjualan}}</td>
					<td class="text-center">{{$SO->lokasi_penjualan}}</td>
					<td class="text-right">Rp {{ number_format($SO->pembayar->sum('nominal_pembayaran'),0,'.','.') }}</td>
					<td class="text-center">{{$SO->nama_customer}}</td>
					<td class="text-center">{{$SO->no_hp}}</td>
					<td class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								action<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right">
								@if (Auth::user()->status === 'STAFF ACCOUNTING')
									<li><a href="{{route('SO.details', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>	
								@else 
									<li><a href="{{route('customer.edit', $SO)}}" title="Edit"> <i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>
									<li><a href="{{route('SO.details', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>	
									<li><a data-toggle="modal" data-target="#deleteModal{{$SO->id_slip_order}}"> <i class="fa fa-trash" style="color: #edb426;"></i> Delete </a></li>
								@endif
								
							</ul>
						</div>							
					</td>
				</tr>
				<!-- modal for delete Sewa recurring -->
				<div class="modal fade" id="deleteModal{{$SO->id_slip_order}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					{{-- {!! Form::open(['route'=> ['customer.delete', $SO], 'method'=>'delete']) !!} --}}
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">{{$SO->id_slip_order}}</h4>
							</div>
							<div class="modal-body" >
								<h4>Delete  <b>{{$SO->id_slip_order}}</b>?</h4>
								<br>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
								<button type="submit" class="btn btn-danger">delete</button>
							</div>
						</div>
					</div>
					{{-- {!! Form::close() !!} --}}
				</div>
				<!-- delete modal ends here -->						
			@endforeach
		</tbody>
	</table>					
	<!--Pagination-->
	<div class="pull-right">
		{{ $sewa->links() }}
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

	<!-- konvert recurring 10 modal -->
	<div class="modal fade" id="recurring10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="/bank_format/10" enctype="multipart/form-data" method="POST" class="form-horizontal">
						@csrf
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Format Recurring Tanggal 10</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Nomor Merchant<span class="required">*</span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nomor_merchant"/>
							</div>					
						</div>									
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Merchant Category Code<span class="required">*</span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mcc"/>
							</div>					
						</div>									
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Tanggal Transaksi<span class="required">*</span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control dateTime" name="tanggal_transaksi"/>
							</div>					
						</div>									
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Sequence Control<span class="required">*</span> 
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="sequence_control"/>
							</div>					
						</div>							
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Proses</button>
					</div>
				</form>
				</div>
			</div>
		
	</div>
	<!-- konvert recurring 10 modal ends here -->

	<!-- konvert recurring 25 modal -->
	<div class="modal fade" id="recurring25" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<form action="/bank_format/25" enctype="multipart/form-data" method="POST" class="form-horizontal">
						@csrf
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Format Recurring Tanggal 25</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Nomor Merchant<span class="required">*</span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nomor_merchant"/>
							</div>					
						</div>									
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Merchant Category Code<span class="required">*</span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="mcc"/>
							</div>					
						</div>									
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Tanggal Transaksi<span class="required">*</span>
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control dateTime" name="tanggal_transaksi"/>
							</div>					
						</div>									
						<div class="form-group">
							<label class="col-sm-4" style="text-align: left;">
								Sequence Control<span class="required">*</span> 
							</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="sequence_control"/>
							</div>					
						</div>							
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Proses</button>
					</div>
				</form>
				</div>
			</div>
		
	</div>
	<!-- konvert recurring 25 modal ends here -->

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

<!-- bank format recurring modal -->
<div class="modal fade" id="convertModal">
	<div class="modal-dialog">
		<div class="modal-content">
			{{-- {!! Form::open(['class' => 'form-horizontal']) !!} --}}
			<form action="/bank_format" enctype="multipart/form-data" class="form-horizontal" method="POST">
				@csrf
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"> Konvert data ke format Recurring Bank</h4>
				</div>

				<div class="modal-body">                  
					<div class="form-group">
						<label class="col-sm-3" style="text-align: left;" >
							Dari
						</label>
						<div class="col-sm-9">
							{{-- {!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!} --}}
							<input type="text" name="dari" class="form-control dateTime" placeholder="yyyy-mm-dd">
						</div>
					</div>	
					<div class="form-group">
						<label class="col-sm-3" style="text-align: left;" >
							Ke
						</label>
						<div class="col-sm-9">
							{{-- {!! Form::text('to', Request::get('to'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!} --}}
							<input type="text" name="ke" class="form-control dateTime" placeholder="yyyy-mm-dd">
						</div>
					</div>																 
				</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
				{!! Form::submit('Search', ['class' => 'btn btn-primary', 'data-disable-with' => trans('searching')]) !!}
			</div>
			{{-- {!! Form::close() !!} --}}
			</form>
		</div>
	</div>
</div>
<!-- bank format recurring modal ends -->

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