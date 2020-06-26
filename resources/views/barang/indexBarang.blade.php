@extends('app')

@section('title')
	Menu Barang
@stop

@section('contentheader')
	Daftar Barang 
@stop

@section('breadcrumb')
	Barang 
@stop

@section('main-content')

<div class="panel-heading">	
	@if (Auth::user()->status === 'STAFF WAREHOUSE')
		<a href="#" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"></a>
	@else
		<a href="{{route('barang.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">	<i class='fa fa-plus'></i> Tambah Barang</a>
	@endif	
	

	{{-- @if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('BarangController@getIndex') }}"><i class="fa fa-eraser"></i> clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
	@endif --}}
	
</div>

	<div class="panel-body">

		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered" id="table_id">
					<thead class="bg-gradient-1">
						<td class="text-center font-white">#</td>
						<td class="text-center font-white">ID Barang</td>
						<td class="text-center font-white">Kode Barang</td>
						<td class="text-center font-white">Nama Barang</td>
						<td class="text-center font-white">Harga</td>
						<td class="text-center font-white">Stok</td>
						<td class="text-center font-white">Tanggal Masuk Terakhir</td>
						@if (Auth::user()->status === 'STAFF WAREHOUSE')
						
						@else
							<td class="text-center font-white">Action</td>
						@endif
					</thead>
					<tbody>
						@foreach($tersedia as $barang)
							<tr>
								<td class="text-center">{{$loop->iteration}}</td>
								<td class="text-center">{{$barang->id_barang}}</td>
								<td class="text-center">{{$barang->kode_barang}}</td>
								<td class="text-center">{{$barang->nama_barang}}</td>
								<td class="text-center">Rp {{ number_format($barang->harga,0,'.','.') }}</td>
								<td class="text-center">{{$barang->stok}}</td>
								<td class="text-center">{{$barang->updated_at}}</td>
								@if (Auth::user()->status === 'STAFF WAREHOUSE')
						
								@else
									<td class="text-center">
										<div class="btn-group">
											<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												action<span class="caret"></span>
											</button>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="{{route('barang.editData', $barang->id_barang)}}" title="Edit" ><i class="fa fa-edit" style="color: #069996;"></i>edit Data</a>
												</li>
												<li>
													<a href="{{route('barang.updateStok', $barang->id_barang)}}" title="Edit" ><i class="fa fa-edit" style="color: #069996;"></i>Update Stok</a>
												</li>
												<li>
													<a data-toggle="modal" data-target="#deleteModal{{$barang->id_barang}}"><i class="fa fa-trash" style="color: #edb426;"></i>	Delete</a>
												</li>												  
												<li>
													<a href="{{route('barang.details', $barang)}}">	<i class="fa fa-eye" style="color: #269fed;"></i>Details </a>
												</li>
											</ul>
										</div>							
									</td>
								@endif
								
							</tr>
		
							<!-- modal for delete barang -->
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
					<table style="width: 50%; font-weight: bold;" align="right" class="table table-bordered" >
						<tr style="background-color: #F8F9F9; border: 1px solid #ddd;">
							<td style="text-align: right;">
								<b>Total Barang :</b>
							</td>
							<td style="text-align: right;">
								{{$totalBarangTersedia}}					
							</td>
						</tr>			
					</table> 
				</table>
			</div>
			<div class="col-md-12">
			<!--Pagination-->
		<div class="pull-right">
			{{ $tersedia->links() }}
		</div>
		<!--Ends-->
			</div>
		</div>
		
		
		  {{-- <hr> --}}

		  

		
		<!--Ends-->
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;">
		
		</span> 
	  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
			<i class="fa fa-backward"></i> Kembali
		</a>
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
								ID Barang 
							</label>
							<div class="col-sm-9">
								{!! Form::text('id_barang', Request::get('id_barang'), ['class' => 'form-control']) !!}
							</div>
						</div>
	
						<div class="form-group">
							<label class="col-sm-3" style="text-align: left;">
								Kode Barang 
							</label>
							<div class="col-sm-9">
								{!! Form::text('kode_barang', Request::get('kode_barang'), ['class' => 'form-control']) !!}
							</div>
						</div>	
						
						<div class="form-group">
							<label class="col-sm-3" style="text-align: left;">
								Nama Barang
							</label>
							<div class="col-sm-9">
								{!! Form::text('nama_barang', Request::get('nama_barang'), ['class' => 'form-control']) !!}
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