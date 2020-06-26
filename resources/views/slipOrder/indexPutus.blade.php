@extends('app')

@section('title')
	Slip Order Putus
@stop

@section('contentheader')
Daftar Slip Order Putus
@stop

@section('breadcrumb')
Daftar Slip Order Putus
@stop

@section('main-content')

<div class="panel-heading">		
	<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>

	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('SlipOrderController@getIndexPutus') }}"><i class="fa fa-eraser"></i> clear</a>
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
				@foreach($putus as $SO)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">{{$SO->id_slip_order}}</td>
						<td class="text-center">{{$SO->tanggal}}</td>
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
									@if (Auth::user()->status === 'STAFF ACCOUNTING')
										<li><a href="{{route('SO.detailsPutus', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>	
									@else
										<li><a href="{{route('customer.edit', $SO)}}" title="Edit"> <i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>

										{{-- <li><a href="{{route('SO.detailsPutus', $SO->id_slip_order)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li> --}}
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
										<li><a data-toggle="modal" data-target="#deleteModal{{$SO->id_slip_order}}"> <i class="fa fa-trash" style="color: #edb426;"></i> Delete </a></li>
									@endif
									
								</ul>
							</div>							
						</td>
					</tr>
					<!-- modal for delete product -->
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
			{{ $putus->links() }}
		</div>

		<table style="width: 50%; font-weight: bold;" align="right" class="table table-bordered" >
			<tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
				<td style="text-align: right;">
					<b>Nett Total :</b>
				</td>
				<td style="text-align: right;">
					Rp {{ number_format($net_total,0,'.','.') }}
					
				</td>
			</tr>

			
		</table> 
		<!--Ends-->
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;">
		
		</span> 
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

	<!-- perminggu modal -->
    <div class="modal fade" id="permingguModal">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route'=> ['putus.perminggu'], 'method'=>'post']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Penjualan Beli Putus Perminggu</h4>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">tutup</button>
                    {!! Form::submit('Tampilkan', ['class' => 'btn btn-primary', 'data-disable-with' => trans('searching')]) !!}
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