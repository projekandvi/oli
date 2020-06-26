@extends('app')

@section('title')
	Fault Data Recurring
@stop

@section('contentheader')
Daftar Fault Data Recurring
@stop

@section('breadcrumb')
Daftar Fault Data Recurring
@stop

@section('main-content')

	<div class="panel-heading">		
		<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>
		<a id="inputDataFaultButton" class="btn btn-danger btn-alt btn-xs" style="border-radius: 0px !important;">Input Fault Data Recurring</a>
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
				<td class="text-center font-white">Action</td>
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
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									action<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li><a data-toggle="modal" data-target="#updateModal{{$SO->id_slip_order}}"> <i class="fa fa-edit" style="color: #069996;"></i>Update Status</a></li>
									<li><a href="{{route('SO.details', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>												
								</ul>
							</div>							
						</td>
					</tr>
					<!-- modal for update status fault recurring -->
					<div class="modal fade" id="updateModal{{$SO->id_slip_order}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<form action="/updateStatusFaultDataRecurring" enctype="multipart/form-data" method="POST">
							@csrf
							<input type="hidden" name="id_slip_order" value="{{$SO->id_slip_order}}" />
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">{{$SO->id_slip_order}}</h4>
									</div>
									<div class="modal-body" >
										<h4>Update Status Fault Recurring untuk nomor SO : <b>{{$SO->id_slip_order}}</b>?</h4>
										<br>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>
								</div>
							</div>
						</form>
					</div>
					<!-- delete modal ends here -->						
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
		<span style="padding: 10px;">		
		</span> 
	  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrderSewaRecurring">
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

	<!-- Fault Data Recurring modal -->
    <div class="modal fade" id="inputDataFaultModal">
        <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
				<div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
				</div>
				{!! Form::open(['url' => '/simpanUbahStatusRecurring','method' => 'post','class' => 'form-horizontal','id' => 'ism_form']) !!}
                <table class="table table-bordered" id="table_id">
					<thead class="bg-gradient-1">
						<td class="text-center font-white">#</td>
						<td class="text-center font-white">ID Slip Order</td>
						<td class="text-center font-white">Tanggal</td>
						<td class="text-center font-white">Tipe Penjualan</td>
						<td class="text-center font-white">Lokasi</td>
						<td class="text-center font-white">Nama Customer</td>
						<td class="text-center font-white">No hp</td>
						<td class="text-center font-white">Action</td>
						<td class="text-center font-white">Remark Recurring</td>
					</thead>						
					<tbody>						
						@foreach($inputRecurring as $_key => $SO)						
							<tr>
								<td class="text-center">{{$loop->iteration}}</td>
								<td class="text-center">{{$SO->id_slip_order}}</td>
								<td class="text-center">{{date('d-m-Y', strtotime($SO->tanggal))}}</td>
								<td class="text-center">{{$SO->tipe_penjualan}}</td>
								<td class="text-center">{{$SO->lokasi_penjualan}}</td>
								<td class="text-center">{{$SO->nama_customer}}</td>
								<td class="text-center">{{$SO->no_hp}}</td>								
								<td class="text-center">
									{{-- <input type="checkbox" name="status_recurring[]" value="{{ $SO->id_slip_order }}"> --}}
									<input type="hidden" name="id_rubah[]" value="{{$SO->id_slip_order}}">
									<select   class="form-control" name="status_recurring[]">
										<option value="berhasilRecurring">Berhasil Recurring</option>
										<option value="gagalRecurring">Gagal Recurring</option>
									</select>
								</td>	
								<td class="text-center">
									<textarea name="remark_recurring[]" cols="30" rows="2"></textarea>	
								</td>								
							</tr>																
						@endforeach						
					</tbody>
				</table>
				<div class="modal-footer">
					<input class="btn btn-primary" type="submit" value="Simpan" id="submitButton" onclick="submitted()">
					{!! Form::close() !!}	
                </div>	
            </div>
        </div>
    </div>
	<!-- Fault Data Recurring ends -->

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
            $('#inputDataFaultButton').click(function(event) {
                event.preventDefault();
                $('#inputDataFaultModal').modal({
            backdrop: 'static',
            keyboard: false,
            show:true
        })
            });
        });

		$('#permingguButton').click(function(event) {
                event.preventDefault();
                $('#permingguModal').modal('show')
            });
		
	</script>

@stop