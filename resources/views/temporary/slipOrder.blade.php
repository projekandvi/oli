@extends('app')

@section('title')
	Persetujuan Ubah Slip Order
@stop

@section('contentheader')
Daftar Permintaan Perubahan Data Slip Order
@stop

@section('breadcrumb')
Daftar Permintaan Perubahan Data Slip Order
@stop

@section('main-content')

<div class="panel-heading">		
	<a href="#" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"></a>

	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('InvoiceController@getIndexSewa') }}"><i class="fa fa-eraser"></i> clear</a>
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
				<td class="text-center font-white">Total</td>
				<td class="text-center font-white">Action</td>
			</thead>						
			<tbody>
				@foreach($temporary as $invoice)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">{{$invoice->id_invoice}}</td>
						<td class="text-center">{{$invoice->tanggal}}</td>
						<td class="text-center">{{$invoice->tipe_penjualan}}</td>
						<td class="text-center">{{$invoice->lokasi_penjualan}}</td>
						<td class="text-center">{{$invoice->nama_customer}}</td>
						<td class="text-center">{{$invoice->no_hp}}</td>
						<td class="text-center">Rp {{ number_format($invoice->harga,0,'.','.') }}</td>
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									action<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li><a href="{{route('customer.edit', $invoice)}}" title="Edit"> <i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>
									<!-- Barang delete modal trigger -->
									<li><a data-toggle="modal" data-target="#deleteModal{{$invoice->id_invoice}}"> <i class="fa fa-trash" style="color: #edb426;"></i> Delete </a></li>
									<li><!-- slider details button --><a href="{{route('temporarySO.details', $invoice->id_invoice)}}"><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>														
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
			{{ $temporary->links() }}
		</div>

		
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
								No. Slip Order 
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