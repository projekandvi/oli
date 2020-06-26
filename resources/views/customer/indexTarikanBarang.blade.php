@extends('app')

@section('title')
	Index Tarikan Barang
@stop

@section('contentheader')
Index Tarikan Barang
@stop

@section('breadcrumb')
Index Tarikan Barang
@stop

@section('main-content')

<div class="panel-heading">		
	<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>
	<a data-toggle="modal" class="btn btn-danger btn-alt btn-xs" data-target="#formTarikanBarangModal">Tarikan Barang</a>
	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('SlipOrderController@getIndexSewa') }}"><i class="fa fa-eraser"></i> clear</a>
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
				<td class="text-center font-white">Nama Customer</td>
				<td class="text-center font-white">No hp</td>
				<td class="text-center font-white">Remarks</td>
			</thead>						
			<tbody>
				@foreach($sewa as $SO)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">{{$SO->id_slip_order}}</td>
						<td class="text-center">{{date('d-m-Y', strtotime($SO->tanggal))}}</td>
						<td class="text-center">{{$SO->tipe_penjualan}}</td>
						<td class="text-center">{{$SO->lokasi_penjualan}}</td>
						<td class="text-center">{{$SO->nama_customer}}</td>
						<td class="text-center">{{$SO->no_hp}}</td>
						<td class="text-center">{{$SO->remarks_tarikan}}</td>
					</tr>										
				@endforeach
			</tbody>
		</table>					
		<!--Pagination-->
		<div class="pull-right">
			{{ $sewa->links() }}
		</div>		
		{{-- -------------------------------------------------------------------------------- --}}		
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
							No. Slip Order 
						</label>
						<div class="col-sm-9">
							{!! Form::text('slip_order_no', Request::get('slip_order_no'), ['class' => 'form-control']) !!}
						</div>
					</div>					
					<div class="form-group">
						<label class="col-sm-3" style="text-align: left;">
							Customer
						</label>
						<div class="col-sm-9">
							{!! Form::select('customer', $customers, Request::get('customer'), ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select a customer']) !!}
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

	<!-- input teknisi modal -->
	<div class="modal fade" id="formTarikanBarangModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<form action="/simpanTarikanBarang" enctype="multipart/form-data" method="POST" class="form-horizontal">
			@csrf
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Form Tarikan Barang</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label class="col-sm-3" style="text-align: left;">
								ID Slip Order
							</label>
							<div class="col-sm-9">
								{!! Form::select('id_slip_order', $so, Request::get('id_slip_order'), ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select a ID Slip Order']) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" style="text-align: left;">
								Remarks
							</label>
							<div class="col-sm-9">
								{{-- {!! Form::text('remarks', Request::get('remarks'), ['class' => 'form-control','placeholder'=>"Remarks"]) !!} --}}
								{!! Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none']) !!}
							</div>
						</div>
														
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
						<button type="submit" class="btn btn-success">Simpan</button>
					</div>
				</div>
			</div>
		
	</div>
	<!-- delete modal ends here -->

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
	</script>

@stop