@extends('app')

@section('title')
	Proses Delivery Order
@stop

@section('contentheader')
Proses Delivery Order 
@stop

@section('breadcrumb')
Proses Delivery Order 
@stop

@section('main-content')
	<div class="panel-body">
		<h2>Sales Order Number : {{$do->id_do}}</h2>
		<table class="table table-bordered">
			<thead class="bg-gradient-1">
				<td class="text-center font-white">#</td>
				<td class="text-center font-white">ID Delivery Order</td>
				<td class="text-center font-white">ID Barang</td>
				<td class="text-center font-white">Nama Barang</td>
				<td class="text-center font-white">Barcode 1</td>
				<td class="text-center font-white">Barcode 2</td>
				<td class="text-center font-white">Barcode 3</td>
				<td class="text-center font-white">Barcode 4</td>
				<td class="text-center font-white">Barcode 5</td>
				<td class="text-center font-white">Lokasi Keluar Barang</td>
				<td class="text-center font-white">Action</td>
			</thead>
			<tbody>
				@foreach($do->deliveryOrderDetail as $item)
					<form action="/deliveryOrder/proses/simpan" enctype="multipart/form-data" method="POST" id="ism_form">
						@csrf
						<input type="hidden" name="id" value="{{$item->id}}">
						<input type="hidden" name="id_do" value="{{$item->id_do}}">
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="text-center">{{$item->id_do}}</td>
							<td class="text-center">{{$item->id_barang}}</td>
							<td class="text-center">{{$item->nama_barang}}</td>
							<td class="text-center">
								@if ($item->barcode1 != null)
								{{$item->barcode1}}
								@else
								<input type="text" class="form-control" name="barcode1">
								@endif
							</td>
							<td class="text-center">
								@if ($item->barcode2 != null)
								{{$item->barcode2}}
								@else
								<input type="text" class="form-control" name="barcode2">
								@endif
							</td>
							<td class="text-center">
								@if ($item->barcode3 != null)
								{{$item->barcode3}}
								@else
								<input type="text" class="form-control" name="barcode3">
								@endif
							</td>
							<td class="text-center">
								@if ($item->barcode4 != null)
								{{$item->barcode4}}
								@else
								<input type="text" class="form-control" name="barcode4">
								@endif
							</td>
							<td class="text-center">
								@if ($item->barcode5 != null)
								{{$item->barcode5}}
								@else
								<input type="text" class="form-control" name="barcode5">
								@endif
							</td>
							
							<td class="text-center">
								@if ($item->lokasi_keluar_barang != null)
								{{$item->lokasi_keluar_barang}}
								@else
									<select name="lokasi_keluar_barang" class="form-control">
										<option value="" disabled selected>-- Pilihan Lokasi Gudang --</option>
										@foreach ($lokasi as $item)
											<option value="{{$item->id}}">{{$item->gudang->nama_gudang}} ({{$item->stok}})</option>
										@endforeach
									</select>
								@endif
							</td>
							<td class="text-center">
								@if ($item->lokasi_keluar_barang == null)
								<input class="btn btn-primary" type="submit" id="submitButton{{$loop->iteration}}" value="Simpan" onclick="submitted()">
								@endif
							</td>					
						</tr>
					</form>
				@endforeach
			</tbody>
		</table>		
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;"></span> 
	  	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/delivery">
			<i class="fa fa-backward"></i> Kembali
		</a>
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