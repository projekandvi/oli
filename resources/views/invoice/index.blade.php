@extends('app')

@section('title')
	Slip Order
@stop

@section('contentheader')
Slip Order List
@stop

@section('breadcrumb')
Slip Order List
@stop

@section('main-content')

	<div class="panel-heading">
		
		<a href="{{route('slipOrder.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">	<i class='fa fa-plus'></i> Add new Slip Order</a>

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
		
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">	<a href="#sewa" data-toggle="tab">Sewa</a></li>
				<li><a href="#putus" data-toggle="tab">Jual Beli Putus</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="sewa">
						<table class="table table-bordered">
							<thead class="bg-gradient-1">
								<td class="text-center font-white">#</td>
								<td class="text-center font-white">ID Slip Order</td>
								<td class="text-center font-white">Tanggal</td>
								<td class="text-center font-white">Tipe Penjualan</td>
								<td class="text-center font-white">lokasi</td>
								<td class="text-center font-white">Nama Customer</td>
								<td class="text-center font-white">no hp</td>
								<td class="text-center font-white">harga</td>
								<td class="text-center font-white">Riwayat Pembayaran</td>
								<td class="text-center font-white">Action</td>
							</thead>						
							<tbody>
								@foreach($sewa as $invoice)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$invoice->id_invoice}}</td>
										<td class="text-center">{{$invoice->tanggal}}</td>
										<td class="text-center">{{$invoice->tipe_penjualan}}</td>
										<td class="text-center">{{$invoice->lokasi_penjualan}}</td>
										<td class="text-center">{{$invoice->nama_customer}}</td>
										<td class="text-center">{{$invoice->no_hp}}</td>
										<td class="text-center">Rp {{ number_format($invoice->harga,0,'.','.') }}</td>
										<td class="text-left">
											@foreach ($invoice->payment as $item)
												<li>Rp {{ number_format($item->jumlah,0,'.','.') }}</li>{{--  - {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y i') }} --}}
											@endforeach
										</td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													action<span class="caret"></span>
												</button>
												<ul class="dropdown-menu pull-right">
													<li><a href="{{route('customer.edit', $invoice)}}" title="Edit"> <i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>
													<!-- Barang delete modal trigger -->
													<li><a data-toggle="modal" data-target="#deleteModal{{$invoice->id_invoice}}"> <i class="fa fa-trash" style="color: #edb426;"></i> Delete </a></li>
													<li><!-- slider details button --><a href="{{route('SO.details', $invoice)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>														
												</ul>
											</div>							
										</td>
									</tr>
									<!-- modal for delete product -->
									<div class="modal fade" id="deleteModal{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										{!! Form::open(['route'=> ['customer.delete', $invoice], 'method'=>'delete']) !!}
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">{{$invoice->id_invoice}}</h4>
												</div>
												<div class="modal-body" >
													<h4>Delete  <b>{{$invoice->id_invoice}}</b>?</h4>
													<br>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
													<button type="submit" class="btn btn-danger">delete</button>
												</div>
											</div>
										</div>
										{!! Form::close() !!}
									</div>
									<!-- delete modal ends here -->						
								@endforeach
							</tbody>
						</table>					
						<!--Pagination-->
						<div class="pull-right">
							{{ $sewa->links() }}
						</div>
						<!--Ends-->
					<hr>
				</div><!-- /.tab-pane tersedia -->
	
				<div class="tab-pane" id="putus">
					<table class="table table-bordered">
						<thead class="bg-gradient-1">
							<td class="text-center font-white">#</td>
							<td class="text-center font-white">ID Slip Order</td>
							<td class="text-center font-white">Tanggal</td>
							<td class="text-center font-white">Tipe Penjualan</td>
							<td class="text-center font-white">lokasi</td>
							<td class="text-center font-white">Nama Customer</td>
							<td class="text-center font-white">no hp</td>
							<td class="text-center font-white">harga</td>
							<td class="text-center font-white">Riwayat Pembayaran</td>
							<td class="text-center font-white">Action</td>
						</thead>						
						<tbody>
							@foreach($putus as $invoice)
								<tr>
									<td class="text-center">{{$loop->iteration}}</td>
									<td class="text-center">{{$invoice->id_invoice}}</td>
									<td class="text-center">{{$invoice->tanggal}}</td>
									<td class="text-center">{{$invoice->tipe_penjualan}}</td>
									<td class="text-center">{{$invoice->lokasi_penjualan}}</td>
									<td class="text-center">{{$invoice->nama_customer}}</td>
									<td class="text-center">{{$invoice->no_hp}}</td>
									<td class="text-center">Rp {{ number_format($invoice->harga,0,'.','.') }}</td>
									<td class="text-left">
										@foreach ($invoice->payment as $item)
											<li>Rp {{ number_format($item->jumlah,0,'.','.') }}</li>
										@endforeach
									</td>
									<td class="text-center">
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												action<span class="caret"></span>
											</button>
											<ul class="dropdown-menu pull-right">
												<li><a href="{{route('customer.edit', $invoice)}}" title="Edit"> <i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>
												<!-- Barang delete modal trigger -->
												<li><a data-toggle="modal" data-target="#deleteModal{{$invoice->id_invoice}}"> <i class="fa fa-trash" style="color: #edb426;"></i> Delete </a></li>
												<li><!-- slider details button --><a href="{{route('SO.details', $invoice)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>														
											</ul>
										</div>							
									</td>
								</tr>
								<!-- modal for delete product -->
								<div class="modal fade" id="deleteModal{{$invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
									{!! Form::open(['route'=> ['customer.delete', $invoice], 'method'=>'delete']) !!}
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
												<h4 class="modal-title" id="myModalLabel">{{$invoice->id_invoice}}</h4>
											</div>
											<div class="modal-body" >
												<h4>Delete <b>{{$invoice->id_invoice}}</b>?</h4>
												<br>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
												<button type="submit" class="btn btn-danger">delete</button>
											</div>
										</div>
									</div>
									{!! Form::close() !!}
								</div>
								<!-- delete modal ends here -->						
							@endforeach
						</tbody>
					</table>				
					<!--Pagination-->
					<div class="pull-right">
						{{ $putus->links() }}
					</div>
					<!--Ends-->
				</div><!-- /.tab-pane tersewa -->
				
			</div><!-- /.tab-content -->
		</div><!-- /.nav-tabs-custom -->
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	<!-- barang search modal -->
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
								{{trans('core.invoice_no')}}
							</label>
							<div class="col-sm-9">
								{!! Form::text('invoice_no', Request::get('invoice_no'), ['class' => 'form-control']) !!}
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
								{{trans('core.from')}}
							</label>
							<div class="col-sm-9">
								{!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-sm-3" style="text-align: left;" >
								{{trans('core.to')}}
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