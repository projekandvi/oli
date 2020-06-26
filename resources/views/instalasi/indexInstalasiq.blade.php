@extends('app')

@section('title')
	Instalasi
@stop

@section('contentheader')
	Instalasi List
@stop

@section('breadcrumb')
	Instalasi List
@stop

@section('main-content')

	<div class="panel-heading">
		<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>

		@if(count(Request::input()))
			<span class="pull-right">	
				<a class="btn btn-default btn-alt btn-xs" href="{{ action('InstalasiController@getIndex') }}">
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
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">	<a href="#instalasi" data-toggle="tab">Instalasi</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="instalasi">
						<table class="table table-bordered">
							<thead class="bg-gradient-1">
								<td class="text-center font-white">#</td>
								<td class="text-center font-white">ID Slip Order</td>
								<td class="text-center font-white">Tanggal Slip Order</td>
								<td class="text-center font-white">ID Barang</td>
								<td class="text-center font-white">Nama Customer</td>
								<td class="text-center font-white">Lokasi Pemasangan</td>
								<td class="text-center font-white">Catatan</td>
								<td class="text-center font-white">Tanggal Pemasangan</td>
								<td class="text-center font-white">Teknisi</td>
								<td class="text-center font-white">Remark</td>
								<td class="text-center font-white">Action</td>
							</thead>						
							<tbody>
								@foreach($instalasi as $item)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$item->id_slip_order}}</td>
										<td class="text-center">{{date('d-m-Y', strtotime($item->so['tanggal']))}}</td>
										<td class="text-center">
											@foreach ($item->soDetail as $row)
												{{ $row['nama_barang'] }}												
											@endforeach
										</td>
										<td class="text-center">{{$item->so['nama_customer']}}</td>
										<td class="text-center">{{$item->so['alamat_pemasangan']}}</td>
										<td class="text-center"> 
											@if ($item->so['tipe_penjualan'] === 'SewaRecurring' && $item->so['catatan_recurring'] != null)
												<p style="background-color: yellow;">{{$item->so['catatan_recurring']}}</p>
											@elseif($item->so['tipe_penjualan'] === 'SewaRecurring' && $item->so['catatan_recurring'] === null)
												-
											@endif												
										</td>
										<td class="text-center">
											@if ($item->tanggal_pemasangan != null)
												{{date('d-m-Y', strtotime($item->tanggal_pemasangan))}}
											@else
												Tanggal Instalasi Belum Dipilih
											@endif
										</td>
										<td class="text-center">
											@if ($item->teknisi != null)
												{{$item->teknisi}}
											@else
												Teknisi Belum Dipilih
											@endif												
										</td>
										<td class="text-center">{{$item->remark}}</td>
										<td class="text-center">
											@if ($item->tanggal_pemasangan != null)
												<a href="{{route('inputTeknisiInstalasi', $item->id)}}" class="btn btn-warning"> <i class="fa fa-edit"></i>Ubah Jadwal Instalasi</a>
											@else
												<a href="{{route('inputTeknisiInstalasi', $item->id)}}" class="btn btn-primary"> <i class="fa fa-edit"></i>Atur Jadwal Instalasi</a>
											@endif
											
										</td>
									</tr>		
								@endforeach
							</tbody>
						</table>					
						<!--Pagination-->
						<div class="pull-right">
							{{ $instalasi->links() }}
						</div>
						<!--Ends-->
					<hr>
				</div><!-- /.tab-pane tersedia -->
	
			</div><!-- /.tab-content -->
		</div><!-- /.nav-tabs-custom -->
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;"></span> 
		<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
		  <i class="fa fa-backward"></i> Kembali
		</a>
	  </div>  

	<!-- instalasi search modal -->
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

	<!-- perminggu modal -->
    <div class="modal fade" id="permingguModal">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['route'=> ['instalasi.perminggu'], 'method'=>'post']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Instalasi Perminggu</h4>
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
	</script>

@stop