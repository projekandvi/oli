@extends('app')

@section('title')
	Maintenance
@stop

@section('contentheader')
Maintenance List
@stop

@section('breadcrumb')
Maintenance List
@stop

@section('main-content')

<div class="panel-heading">
		
<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>

@if(count(Request::input()))
	<span class="pull-right">	
		<a class="btn btn-default btn-alt btn-xs" href="{{ action('MaintenanceController@getIndex') }}">
			<i class="fa fa-eraser"></i>clear
		</a>

		<a class="btn btn-primary btn-alt btn-xs" id="searchButton">
			<i class="fa fa-search"></i>modify search
		</a>
	</span>
@else
	<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">
		<i class="fa fa-search"></i>search
	</a>
@endif
</div>

<div class="panel-body">	
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<td class="text-center font-white">#</td>
			<td class="text-center font-white">ID Slip Order</td>
			<td class="text-center font-white">Nama Customer</td>
			<td class="text-center font-white">Lokasi Pemasangan</td>
			<td class="text-center font-white">Jadwal Maintenance</td>
			<td class="text-center font-white">Nama Barang</td>
			<td class="text-center font-white">Teknisi</td>
			<td class="text-center font-white">Action</td>
		</thead>						
		<tbody>
			@foreach($maintenance as $item)
				{!! Form::open(['url' => '/maintenance/proses/simpan','method' => 'post','class' => 'form-horizontal']) !!}	
					@csrf
					<input type="hidden" name="id_rubah" value="{{$item->id}}">
					<tr>
						<td class="text-center">{{$loop->iteration}}</td>
						<td class="text-center" style="width: 7%;">{{$item->id_slip_order}}</td>
						<td class="text-center">{{$item->customer->nama_customer}}</td>
						<td class="text-center" style="width: 20%;">{{$item->so['alamat_pemasangan']}}</td>
						<td class="text-center" style="width: 10%;">
							@if ($item->tanggal_perbaikan != null)
								{{date('d-m-Y', strtotime($item->tanggal_perbaikan))}}
							@else
								Belum Instalasi
							@endif
						</td>
						<td class="text-center">
							@foreach ($item->soDetail as $row)
								<li>{{ $row['nama_barang'] }}</li>
							@endforeach
						</td>
						<td class="text-center">{{$item->teknisi}}</td>
						<td>
							<div class="btn-group">
								<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									action<span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right">
									<li><a data-toggle="modal" data-target="#inputTeknisiModal{{$item->id_slip_order}}"><i class="fa fa-edit" style="color: #069996;"></i> Input Teknisi Maintenance</a></li>
									@if ($item->tanggal_perbaikan != null)
										<li><a href="ubahJadwalMaintenance/{{$item->id_slip_order}}" title="teknisi"> <i class="fa fa-edit" style="color: #069996;"></i>Ubah Jadwal Maintenance</a></li>
									@endif									
									{{-- <li><a href=""><i class="fa fa-eye" style="color: #269fed;"></i> Details </a></li>	 --}}
								</ul>
							</div>
						</td>
					</tr>	
				</form>
				<!-- input teknisi modal -->
				<div class="modal fade" id="inputTeknisiModal{{$item->id_slip_order}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<form action="/simpanInputTeknisiMaintenance" enctype="multipart/form-data" method="POST" class="form-horizontal">
						@csrf
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Form Input Teknisi</h4>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id_rubah" value="{{$item->id}}">									
									<div class="row">										
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>ID Sales Order<span class="required">*</span></label>                           
												<input type="text" class="form-control" value="{{$item->id_slip_order}}" disabled/>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Nama Customer<span class="required">*</span></label>                           
												<input type="text" class="form-control" value="{{$item->customer->nama_customer}}" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Alamat Pemasangan<span class="required">*</span></label>                           
												<textarea class="form-control"  cols="30" rows="4" disabled>{{$item->so['alamat_pemasangan']}}</textarea>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Teknisi<span class="required">*</span></label>                           
												@if ($item->teknisi != null)
												<input type="text" class="form-control" value="{{$item->teknisi}}" disabled />
												@else
												<select class="form-control gampang" name="teknisi" style="width: 100%">
													<option value="">Pilih</option>
													<option value="RIKI">RIKI</option>
													<option value="KRYESNA">KRYESNA</option>
													<option value="AGUNG">AGUNG</option>
													<option value="ALIF">ALIF</option>
													<option value="ILHAM">ILHAM</option>
												</select>
												@endif
											</div>                                     
										</div>	
									</div>									
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
									<button type="submit" class="btn btn-success">Simpan</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!-- delete modal ends here -->

			@endforeach
		</tbody>
	</table>					
	<!--Pagination-->
	<div class="pull-right">
		{{ $maintenance->links() }}
	</div>
	<!--Ends-->			

</div><!-- /.panel body -->

<div class="panel-footer">  
	<span style="padding: 10px;"></span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
		<i class="fa fa-backward"></i> Kembali
	</a>
</div>  
<!-- maintenance search modal -->
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
						<label class="col-sm-3" style="text-align: left;">Customer</label>
						<div class="col-sm-9">
							{!! Form::select('customer', $customers, Request::get('customer'), ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'placeholder' => 'Please select a customer']) !!}
						</div>
					</div>						

					<div class="form-group">
						<label class="col-sm-3" style="text-align: left;" >	Dari</label>
						<div class="col-sm-9">
							{!! Form::text('from', Request::get('from'), ['class' => 'form-control dateTime','placeholder'=>"yyyy-mm-dd"]) !!}
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3" style="text-align: left;" >	Ke</label>
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

	<!-- perminggu modal -->
<div class="modal fade" id="permingguModal">
	<div class="modal-dialog">
		<div class="modal-content">
			{!! Form::open(['class' => 'form-horizontal'],['route'=> ['maintenance.perminggu'], 'method'=>'post']) !!}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"> Maintenance Perminggu</h4>
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
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
				{!! Form::submit('Search', ['class' => 'btn btn-primary', 'data-disable-with' => trans('searching')]) !!}
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

		$('#inputTeknisiButton').click(function(event) {
                event.preventDefault();
                $('#inputTeknisiModal').modal('show')
            });
	</script>

@stop