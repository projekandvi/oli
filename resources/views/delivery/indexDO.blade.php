@extends('app')

@section('title')
	Delivery Order
@stop

@section('contentheader')
	Delivery Order List
@stop

@section('breadcrumb')
	Delivery Order List
@stop

@section('main-content')

{{-- <div class="panel-heading">		
	<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>
	
	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('DeliveryOrderController@getIndex') }}">
				<i class="fa fa-eraser"></i> 
				clear
			</a>
	
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton">
				<i class="fa fa-search"></i> 
				modify search
			</a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">
			<i class="fa fa-search"></i>
			search
		</a>
	@endif
</div> --}}

	<div class="panel-body">
		<table class="table table-bordered" id="table_id">
			<thead class="bg-gradient-1">
				<td class="text-center font-white">#</td>
				<td class="text-center font-white">ID Delivery Order</td>
				<td class="text-center font-white">ID Slip Order</td>
				<td class="text-center font-white">Tanggal</td>
				<td class="text-center font-white">Diproses Oleh</td>
				<td class="text-center font-white">Action</td>
			</thead>
			<tbody>
				@foreach($deliverys as $delivery)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">{{$delivery->id_do}}</td>
						<td class="text-center">{{$delivery->id_slip_order}}</td>
						<td class="text-center">{{$delivery->created_at}}</td>						
						<td class="text-center">
							@if ($delivery->id_staf != null)
							{{$delivery->usernya->nama}}
							@else
								-
							@endif
							
						</td>						
						<td class="text-center">
							<div class="btn-group">
								@foreach ($delivery->deliveryOrderDetail as $item)
									@if ($item->barcode1 != null)
									<a class="btn btn-alt btn-warning btn-xs" target="_BLINK" href="/printDO/{{$delivery->id_do}}">
										<i class="fa fa-print"></i>
											Print Delivery Order
									</a>
									@else
									<a href="{{route('delivery.proses', $delivery)}}" title="Proses" class="btn btn-info btn-alt btn-xs" >
										<i class="fa fa-refresh"></i>
										Proses
									</a>
									@endif
								@endforeach
								
								

							</div>							
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;"></span> 
		<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
		  <i class="fa fa-backward"></i> Kembali
		</a>
	</div>

	<!-- delivery search modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['class' => 'form-horizontal']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> search</h4>
                </div>

                <div class="modal-body">
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
            </div>
        </div>
    </div>
	<!-- search modal ends -->

	<!-- perminggu modal -->
    <div class="modal fade" id="permingguModal">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route'=> ['delivery.perminggu'], 'method'=>'post']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Delivery Order Perminggu</h4>
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

		$('#permingguButton').click(function(event) {
                event.preventDefault();
                $('#permingguModal').modal('show')
            });
	</script>

@stop