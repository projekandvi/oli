@extends('app')

@section('title')
	Sparepart
@stop

@section('contentheader')
Sparepart List
@stop

@section('breadcrumb')
Sparepart List
@stop

@section('main-content')

	<div class="panel-heading">
		
			<a href="{{route('sparepart.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;">
				<i class='fa fa-plus'></i> 
				Add new Sparepart
			</a>

		@if(count(Request::input()))
			<span class="pull-right">	
	            <a class="btn btn-default btn-alt btn-xs" href="{{ action('SparepartController@getIndex') }}">
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
	</div>

	<div class="panel-body">

		<table class="table table-bordered">
			<thead class="bg-gradient-1">
				<td class="text-center font-white">#</td>
				<td class="text-center font-white">Kode Sparepart</td>
				<td class="text-center font-white">Nama Sparepart</td>
				<td class="text-center font-white">Harga</td>
				<td class="text-center font-white">Kondisi Sparepart</td>
				<td class="text-center font-white">Lokasi Stok</td>
				<td class="text-center font-white">action</td>
			</thead>

			<tbody>
				@foreach($spareparts as $sparepart)
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center">{{$sparepart->kode_sparepart}}</td>
						<td class="text-center">{{$sparepart->nama_sparepart}}</td>
						<td class="text-center">{{$sparepart->harga}}</td>
						<td class="text-center">{{$sparepart->kondisi}}</td>
						<td class="text-center">{{$sparepart->lokasi_stok}}</td>
						
						<td class="text-center">

							<div class="btn-group">
								<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  action<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
								  <li>
									  <a href="{{route('sparepart.edit', $sparepart)}}" title="Edit" >
										  <i class="fa fa-edit" style="color: #069996;"></i>
										  edit
									  </a>
								  </li>

								  <!-- sparepart delete modal trigger -->
								  <li>
									  <a data-toggle="modal" data-target="#deleteModal{{$sparepart->id}}">
										  <i class="fa fa-trash" style="color: #edb426;"></i>
										   Delete
									  </a>
								  </li>
								  
								  <li>
									  <!-- slider details button -->
									  <a href="{{route('sparepart.details', $sparepart)}}">
										  <i class="fa fa-eye" style="color: #269fed;"></i>
										   Details
									  </a>
								  </li>
								
								</ul>
							  </div>							
						</td>
					</tr>

					<!-- modal for delete product -->
					<div class="modal fade" id="deleteModal{{$sparepart->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						{!! Form::open(['route'=> ['sparepart.delete', $sparepart], 'method'=>'delete']) !!}
					  <div class="modal-dialog" role="document">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel">
								{{$sparepart->nama_sparepart}}
							</h4>
						  </div>
						  <div class="modal-body" >
							<h4 >
								Delete  <b>{{$sparepart->nama_sparepart}}</b>?
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
			{{ $spareparts->links() }}
		</div>
		<!--Ends-->
	</div>

	<!-- sparepart search modal -->
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