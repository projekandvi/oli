@extends('app')

@section('title')
	Gudang : {{$gudangnya->nama_gudang}}
	{{-- {{$lokasi->gudang->nama_gudang}} --}}
@stop

@section('contentheader')
Daftar Barang Gudang : {{$gudangnya->nama_gudang}}
{{-- {{$lokasi->gudang->nama_gudang}} --}}
@stop

@section('breadcrumb')
Gudang  : {{$gudangnya->nama_gudang}}
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
						<td class="text-center font-white">Kode Barang</td>
						<td class="text-center font-white">Nama Barang</td>
						<td class="text-center font-white">Stok</td>
					</thead>
					<tbody>
						@foreach($lokasi as $row)
							<tr>
								<td class="text-center">{{$loop->iteration}}</td>
								<td class="text-center">{{$row->barang->id_barang}}</td>
								<td class="text-center">{{$row->barang->nama_barang}}</td>
								<td class="text-center">{{$row->stok}}</td>								
							</tr>
		
							
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
			{{ $lokasi->links() }}
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