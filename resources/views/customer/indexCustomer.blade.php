@extends('app')

@section('title')
	Customer
@stop

@section('contentheader')
Customer List
@stop

@section('breadcrumb')
Customer List
@stop

@section('main-content')

	<div class="panel-heading">
		@if (Auth::user()->status === 'STAFF ACCOUNTING')
			<a href="#" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"></a>
		@else
			<a href="{{route('customer.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-plus'></i> 
				Tambah Customer
			</a>

			<a href="{{route('getImportCustomer')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-plus'></i> 
				Import Excel
			</a>

			<a href="#" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">ID Terakhir : 
				@if (empty($idTerakhir->id))
					1
				@else
				{{$idTerakhir->id}}
				@endif	
			</a>

			<a href="/getTarikanBarang" class="btn btn-danger btn-alt btn-xs" style="border-radius: 0px !important;"> 
				Tarikan Barang
			</a>
		@endif		

		@if(count(Request::input()))
			<span class="pull-right">	
				<a class="btn btn-default btn-alt btn-xs" href="{{ action('CustomerController@getIndex') }}"><i class="fa fa-eraser"></i>
					clear
				</a>
				<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i>
					modify search
				</a>
	        </span>
        @else
            <a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton"><i class="fa fa-search"></i>search</a>
        @endif
	</div>

	<div class="panel-body">

		<table class="table table-bordered">
			<thead class="bg-gradient-1">
				<td class="text-center font-white">#</td>
				<td class="text-center font-white">Nama Customer</td>
				<td class="text-center font-white">NIK</td>
				<td class="text-center font-white">alamat</td>
				<td class="text-center font-white">No Telp</td>
				<td class="text-center font-white">No HP</td>
				<td class="text-center font-white">Email</td>
				<td class="text-center font-white">Action</td>
			</thead>

			<tbody>
				@foreach($customers as $customer)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">{{$customer->nama_customer}}</td>
						<td class="text-center">{{$customer->no_ktp}}</td>
						<td class="text-center">{{$customer->alamat_ktp}}</td>
						<td class="text-center">{{$customer->no_telp}}</td>
						<td class="text-center">{{$customer->no_hp}}</td>
						<td class="text-center">{{$customer->email}}</td>
						
						<td class="text-center">
							<div class="btn-group">
								<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  action<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									@if (Auth::user()->status === 'STAFF ACCOUNTING')
										<li><a href="customer/{{$customer->id}}/details"><i class="fa fa-eye" style="color: #269fed;"></i>Details</a></li>
									@else
										<li><a href="{{route('customer.edit', $customer)}}" title="Edit" ><i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>
										<li><a data-toggle="modal" data-target="#deleteModal{{$customer->id}}"><i class="fa fa-trash" style="color: #edb426;"></i>Delete</a></li>
										<li><a href="customer/{{$customer->id}}/details"><i class="fa fa-eye" style="color: #269fed;"></i>Details</a></li>
									@endif
									
								</ul>
							</div>							
						</td>
					</tr>

					<!-- modal for delete product -->
					<div class="modal fade" id="deleteModal{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						{!! Form::open(['route'=> ['customer.delete', $customer], 'method'=>'delete']) !!}
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">
								{{$customer->nama_customer}}
							</h4>
						  </div>
						  <div class="modal-body" >
							<h4 >
								Delete  <b>{{$customer->nama_customer}}</b>?
							</h4>
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
			{{ $customers->links() }}
		</div>
		<!--Ends-->
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;">
		
		</span> 
	  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
			<i class="fa fa-backward"></i> Kembali
		</a>
	</div>

	<!-- Customer search modal -->
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
                        {!! Form::label('Name', trans('Name'), ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-9">
							{{-- {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!} --}}
							{!! Form::select('customer', $cus, Request::get('customer'), ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select a customer']) !!}
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