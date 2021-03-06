@extends('app')

@section('title')
	Barang
@stop

@section('contentheader')
Barang List
@stop

@section('breadcrumb')
Barang List
@stop

@section('main-content')

<div class="panel-heading">		
	<a href="{{route('barang.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">
		<i class='fa fa-plus'></i> 
		Add new Barang
	</a>

	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('BarangController@getIndex') }}">	<i class="fa fa-eraser"></i> clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search</a>
	    </span>
    @else
    	<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
    @endif
</div>

<div class="panel-body">
	<div class="row">
		<div class="col-md-12">
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tersedia" data-toggle="tab">Tersedia</a>
					</li>
					<li>
						<a href="#tersewa" data-toggle="tab">Tersewa</a>
					</li>
					<li>
						<a href="#terbeli" data-toggle="tab">Terbeli</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="active tab-pane" id="tersedia">
						<table class="table table-bordered">
							<thead class="bg-gradient-1">
								<td class="text-center font-white">#</td>
								<td class="text-center font-white">ID</td>
								<td class="text-center font-white">Kode Barang</td>
								<td class="text-center font-white">Nama Barang</td>
								<td class="text-center font-white">Harga</td>
								<td class="text-center font-white">Kondisi Barang</td>
								<td class="text-center font-white">Lokasi Stok</td>
								{{-- <td class="text-center font-white">Daftar Sparepart</td> --}}
								<td class="text-center font-white">Status Barang</td>
								<td class="text-center font-white">Tanggal Masuk</td>
								<td class="text-center font-white">Action</td>
							</thead>
							<tbody>
								@foreach($barangs as $barang)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$barang->id_barang}}</td>
										<td class="text-center">{{$barang->kode_barang}}</td>
										<td class="text-center">{{$barang->nama_barang}}</td>
										<td class="text-center">{{$barang->harga}}</td>
										<td class="text-center">{{$barang->kondisi}}</td>
										<td class="text-center">{{$barang->lokstok->lokasi_stok}}</td>
										{{-- <td class="text-center">
											<ol class="text-left">
												@foreach ($barang->sparepart as $item)
													<li>{{$item->nama_sparepart}}</li>
												@endforeach
											</ol> 
											<a href="{{route('barang.sparepart', $barang)}}" title="Edit" >
												<i class="fa fa-edit" style="color: #069996;"></i>
												Tambah Sparepart
											</a>
										</td> --}}
										<td class="text-center">{{$barang->status_barang}}</td>
										<td class="text-center">{{$barang->created_at}}</td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													action<span class="caret"></span>
												</button>
												<ul class="dropdown-menu pull-right">
													<li>
														<a href="{{route('barang.edit', $barang->id_barang)}}" title="Edit" ><i class="fa fa-edit" style="color: #069996;"></i>edit</a>
													</li>
													<!-- Barang delete modal trigger -->
													<li>
														<a data-toggle="modal" data-target="#deleteModal{{$barang->id_barang}}"><i class="fa fa-trash" style="color: #edb426;"></i>	Delete</a>
													</li>												  
													<li>
													<!-- slider details button -->
														<a href="{{route('barang.details', $barang)}}">	<i class="fa fa-eye" style="color: #269fed;"></i>Details </a>
													</li>
												</ul>
											</div>							
										</td>
									</tr>
				
									<!-- modal for delete product -->
									<div class="modal fade" id="deleteModal{{$barang->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										{!! Form::open(['route'=> ['barang.delete', $barang], 'method'=>'delete']) !!}
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">{{$barang->nama_barang}}</h4>
													</div>
													<div class="modal-body" >
														<h4>Delete  <b>{{$barang->nama_barang}}</b>?</h4>
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
							{{ $barangs->links() }}
						</div>
						<!--Ends-->
				  		<hr>
	  				</div><!-- /.tab-pane tersedia -->
	  
				  	<div class="tab-pane" id="tersewa">
						<table class="table table-bordered">
							<thead class="bg-gradient-1">
								<td class="text-center font-white">#</td>
								<td class="text-center font-white">ID</td>
								<td class="text-center font-white">Kode Barang</td>
								<td class="text-center font-white">Nama Barang</td>
								<td class="text-center font-white">Harga</td>
								<td class="text-center font-white">Kondisi Barang</td>
								<td class="text-center font-white">ID Invoice</td>
								<td class="text-center font-white">Daftar Sparepart</td>
								<td class="text-center font-white">Status Barang</td>
								<td class="text-center font-white">Action</td>
							</thead>
							<tbody>
								@foreach($barangsewas as $barang)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$barang->id_barang}}</td>
										<td class="text-center">{{$barang->kode_barang}}</td>
										<td class="text-center">{{$barang->nama_barang}}</td>
										<td class="text-center">{{$barang->harga}}</td>
										<td class="text-center">{{$barang->kondisi}}</td>
										<td class="text-center">{{$barang->invoice->id_invoice}}</td>
										<td class="text-center">
											<ol class="text-left">
												@foreach ($barang->sparepart as $item)
													<li>{{$item->nama_sparepart}}</li>
												@endforeach
											</ol> 
											<a href="{{route('barang.sparepart', $barang)}}" title="Edit"><i class="fa fa-edit" style="color: #069996;"></i>Tambah Sparepart</a>
										</td>
										<td class="text-center">{{$barang->status_barang}}</td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  		action<span class="caret"></span>
												</button>
												<ul class="dropdown-menu pull-right">
											  		<li>
												  		<a href="{{route('barang.edit', $barang->id_barang)}}" title="Edit"><i class="fa fa-edit" style="color: #069996;"></i>edit</a>
											  		</li>
													<!-- Barang delete modal trigger -->
											  		<li>
														<a data-toggle="modal" data-target="#deleteModal{{$barang->id_barang}}"><i class="fa fa-trash" style="color: #edb426;"></i>	Delete</a>
											  		</li>
											  		<li>
														<!-- slider details button -->
														<a href="{{route('barang.details', $barang)}}">	<i class="fa fa-eye" style="color: #269fed;"></i>Details</a>
											  		</li>
												</ul>
										  	</div>							
										</td>
									</tr>
			
									<!-- modal for delete product -->
									<div class="modal fade" id="deleteModal{{$barang->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										{!! Form::open(['route'=> ['barang.delete', $barang], 'method'=>'delete']) !!}
								  			<div class="modal-dialog" role="document">
												<div class="modal-content">
									  				<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">{{$barang->nama_barang}}</h4>
									  				</div>
									  				<div class="modal-body" >
														<h4>Delete  <b>{{$barang->nama_barang}}</b>?</h4>
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
							{{ $barangsewas->links() }}
						</div>
						<!--Ends-->
					</div><!-- /.tab-pane tersewa -->
					<div class="tab-pane" id="terbeli">
						<table class="table table-bordered">
							<thead class="bg-gradient-1">
								<td class="text-center font-white">#</td>
								<td class="text-center font-white">ID</td>
								<td class="text-center font-white">Kode Barang</td>
								<td class="text-center font-white">Nama Barang</td>
								<td class="text-center font-white">Harga</td>
								<td class="text-center font-white">Kondisi Barang</td>
								<td class="text-center font-white">ID Invoice</td>
								<td class="text-center font-white">Daftar Sparepart</td>
								<td class="text-center font-white">Status Barang</td>
								<td class="text-center font-white">Action</td>
							</thead>
							<tbody>
								@foreach($barangbelis as $barang)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$barang->id_barang}}</td>
										<td class="text-center">{{$barang->kode_barang}}</td>
										<td class="text-center">{{$barang->nama_barang}}</td>
										<td class="text-center">{{$barang->harga}}</td>
										<td class="text-center">{{$barang->kondisi}}</td>
										<td class="text-center">{{$barang->invoice->id_invoice}}</td>
										<td class="text-center">
											<ol class="text-left">
												@foreach ($barang->sparepart as $item)
													<li>{{$item->nama_sparepart}}</li>
												@endforeach
											</ol> 
											<a href="{{route('barang.sparepart', $barang)}}" title="Edit" > <i class="fa fa-edit" style="color: #069996;"></i> Tambah Sparepart</a>
										</td>
										<td class="text-center">{{$barang->status_barang}}</td>
										<td class="text-center">
											<div class="btn-group">
												<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											  		action<span class="caret"></span>
												</button>
												<ul class="dropdown-menu pull-right">
											  		<li>
												  		<a href="{{route('barang.edit', $barang->id_barang)}}" title="Edit" > <i class="fa fa-edit" style="color: #069996;"></i> edit </a>
											  		</li>
													<!-- Barang delete modal trigger -->
											  		<li>
														<a data-toggle="modal" data-target="#deleteModal{{$barang->id_barang}}"> <i class="fa fa-trash" style="color: #edb426;"></i>Delete </a>
											  		</li>
											  		<li>
												  		<!-- slider details button -->
												  		<a href="{{route('barang.details', $barang)}}"> <i class="fa fa-eye" style="color: #269fed;"></i>Details</a>
											  		</li>
												</ul>
										  	</div>							
										</td>
									</tr>
			
									<!-- modal for delete product -->
									<div class="modal fade" id="deleteModal{{$barang->id_barang}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										{!! Form::open(['route'=> ['barang.delete', $barang], 'method'=>'delete']) !!}
								  			<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">{{$barang->nama_barang}}</h4>
									  				</div>
									  				<div class="modal-body" >
														<h4>Delete <b>{{$barang->nama_barang}}</b>?	</h4>
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
							{{ $barangbelis->links() }}
						</div>
						<!--Ends-->
				  	</div><!-- /.tab-pane terbeli -->
	  			</div><!-- /.tab-content -->
			</div><!-- /.nav-tabs-custom -->
		</div><!-- /.col -->
	</div>
	<!-- /.row -->
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
						{!! Form::label('Name', trans('Name'), ['class' => 'col-sm-3']) !!}
						<div class="col-sm-9">
							{!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
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