@extends('app')

@section('title')
	Laporan Teknisi
@stop

@section('contentheader')
Daftar Laporan Teknisi
@stop

@section('breadcrumb')
Daftar Laporan Teknisi
@stop

@section('main-content')

<style>
	.pilihanPencarian {
		display: none;
	}
</style>



<div class="panel-body">

	<h3 class="title-hero">Data Laporan Teknisi</h3>

	<div class="row">
		<div class="col-md-12">
			{!! Form::open(['class' => 'form-horizontal','id' => 'ism_form']) !!}
			{{-- <form action="/slipOrder/sewa/cari" enctype="multipart/form-data" class="form-horizontal" method="POST" id="ism_form"> --}}
				@csrf
			                 
				<div class="form-group">
					<label class="col-sm-3" style="text-align: left;">
						Pilihan Pencarian 
					</label>
					<div class="col-sm-9">
						<select id="pencarianSelector" class="form-control" onchange="munculPencarian()">
							<option value="" disabled selected>-- Pilihan Pencarian --</option>
							<option value="so">Slip Order</option>
							<option value="customer">Customer </option>
						</select>
					</div>					
				</div>
				<div class="pilihanPencarian" id="so">
					<div class="form-group  output">{{-- No. Slip Order  --}}
						<label class="col-sm-3" style="text-align: left;">
							No. Slip Order 
						</label>
						<div class="col-sm-9">
							{!! Form::select('slip_order_no', $slipOrder, Request::get('slip_order_no'), ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select a slip order']) !!}
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
			<div class="bg-default content-box text-center pad20A mrg25T">
				{{-- <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()"> --}}
				{!! Form::submit('Search', ['class' => 'btn btn-lg btn-primary', 'data-disable-with' => trans('searching'),'id' => 'submitButton','onclick' => 'submitted()']) !!}
			</div>
		{!! Form::close() !!}
		</div>
	</div>


	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<td class="text-center font-white">#</td>
			<td class="text-center font-white">ID Slip Order</td>
			<td class="text-center font-white">Nama Customer</td>
			<td class="text-center font-white">alamat</td>
			<td class="text-center font-white">No hp</td>
			<td class="text-center font-white">Action</td>
		</thead>						
		<tbody>
			@foreach($so as $item)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$item->id_slip_order}}</td>
					<td class="text-center">{{$item->nama_customer}}</td>
					<td class="text-center">{{$item->alamat_pemasangan}}</td>
					<td class="text-center">{{$item->no_hp}}</td>
					<td class="text-center">
						{!! Form::open(['url' => '/laporanTeknisi/SO','method' => 'post','class' => 'form-horizontal','id' => 'ism_form']) !!}
						<input type="hidden" value="{{$item->id_slip_order}}" name="id_slip_order">
						<input class="btn btn-primary btn-xs" type="submit" id="submitButton" value="Proses Verifikasi">
						{!! Form::close() !!}

						{{-- <a href="{{route('getLaporanTeknisi', $item->id_slip_order)}}" class="btn btn-primary btn-xs"> Membuat Laporan </a> --}}
													
					</td>
				</tr>
									
			@endforeach
		</tbody>
	</table>					
	<!--Pagination-->
	<div class="pull-right">
		{{ $so->links() }}
	</div>
</div>

<div class="panel-footer">  
	<span style="padding: 10px;">	</span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrder">
		<i class="fa fa-backward"></i> Kembali
	</a>
</div>

	{{-- -----------------------------------------------------modal-------------------------------------- --}}

<!-- Slip Order search modal -->
<div class="modal fade" id="searchModal">
	<div class="modal-dialog">
		<div class="modal-content">
			
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