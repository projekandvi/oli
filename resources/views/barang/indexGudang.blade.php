@extends('app')

@section('title')
	Data Gudang
@stop

@section('contentheader')
Daftar Gudang 
@stop

@section('breadcrumb')
Gudang 
@stop

@section('main-content')

<div class="panel-heading">		
	<a href="/tambahGudang" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-plus'></i> Tambah Gudang</a>

	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('BarangController@getIndex') }}"><i class="fa fa-eraser"></i> clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
	@endif
	
</div>

	<div class="panel-body">

		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead class="bg-gradient-1">
						<td class="text-center font-white">#</td>
						<td class="text-center font-white">Nama Gudang</td>
					</thead>
					<tbody>
						@foreach($gudang as $item)
							<tr>
								<td class="text-center">{{$loop->iteration}}</td>
								<td class="text-center">{{$item->nama_gudang}}</td>								
							</tr>	
							
						@endforeach
					</tbody>					
				</table>
			</div>
			<div class="col-md-12">
			<!--Pagination-->
		<div class="pull-right">
			{{ $gudang->links() }}
		</div>
		<!--Ends-->
			</div>
		</div>
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
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
								Nama Gudang
							</label>
							<div class="col-sm-9">
								{!! Form::text('nama_barang', Request::get('nama_barang'), ['class' => 'form-control']) !!}
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