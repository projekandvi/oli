@extends('app')

@section('title')
	Instalasi Terpasang
@stop

@section('contentheader')
	Daftar Instalasi Terpasang
@stop

@section('breadcrumb')
	Daftar Instalasi Terpasang
@stop

@section('main-content')

	<div class="panel-heading">
		<a id="permingguButton" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>

		@if(count(Request::input()))
			<span class="pull-right">	
				<a class="btn btn-default btn-alt btn-xs" href="{{ action('InstalasiController@getIndexDataTerpasang') }}">
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
				<li class="active">	<a href="#instalasi" data-toggle="tab">Instalasi Terpasang</a></li>
			</ul>
			<div class="tab-content">
				<div class="active tab-pane" id="instalasi">
						<table class="table table-bordered">
							<thead class="bg-gradient-1">
								<td class="text-center font-white">#</td>
								<td class="text-center font-white">ID Slip Order</td>
								<td class="text-center font-white">Tanggal Slip Order</td>
								<td class="text-center font-white">ID Barang</td>
								<td class="text-center font-white">ID Customer</td>
								<td class="text-center font-white">Lokasi Pemasangan</td>
								<td class="text-center font-white">Catatan</td>
								<td class="text-center font-white">Tanggal Pemasangan</td>
								<td class="text-center font-white">Teknisi</td>
								<td class="text-center font-white">Remark</td>
							</thead>						
							<tbody>
								@foreach($instalasi as $item)
									<tr>
										<td class="text-center">{{$loop->iteration}}</td>
										<td class="text-center">{{$item->id_slip_order}}</td>
										<td class="text-center">
											{{$item->so['tanggal']}}
										</td>
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
											{{$item->tanggal_pemasangan}}
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
									</tr>	
								</form>	
									
									<!-- input teknisi modal -->
									<div class="modal fade" id="prosesInstalasiModal{{$item->id_slip_order}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<form action="/instalasi/proses/simpan" enctype="multipart/form-data" method="POST" class="form-horizontal">
											@csrf
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Form Input Teknisi</h4>
													</div>
													<div class="modal-body">
														<input type="hidden" name="id_rubah" value="{{$item->id}}">	
														<input type="hidden" name="id_staf" value="{{Auth::user()->id}}">								
														<div class="row">										
															<div class="col-md-12">
																<div class="form-group form-group-sm">
																	<label>Tanggal Pemasangan<span class="required">*</span></label>
																	@if ($item->tanggal_pemasangan != null)
																	<input type="text" class="form-control" value="{{$item->tanggal_pemasangan}}" disabled />
																	<input type="hidden" name="tanggal_pemasangan" class="form-control" value="{{$item->tanggal_pemasangan}}" />
																	@else
																	<input type="text" class="form-control dateTime" name="tanggal_pemasangan" placeholder="yyyy-mm-dd">
																	@endif
																</div>                                     
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-sm">
																	<label>Teknisi<span class="required">*</span></label>                           
																	@if ($item->teknisi != null)
																	<input type="text" class="form-control" value="{{$item->teknisi}}" disabled />
																	<input type="hidden" class="form-control" name="teknisi" value="{{$item->teknisi}}" />
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
															<div class="col-md-12">
																<div class="form-group form-group-sm">
																	<label>Remark<span class="required">*</span></label>
																	@if ($item->remark != null)
																	<textarea name="remark" class="form-control" cols="30" rows="3" disabled>{{$item->remark}}</textarea>
																	<input type="hidden" name="remark" class="form-control" value="{{$item->remark}}" />
																	@else
																	<textarea name="remark" class="form-control" cols="30" rows="3"></textarea>
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
							{{ $instalasi->links() }}
						</div>
						<!--Ends-->
					<hr>
				</div><!-- /.tab-pane tersedia -->
	
			</div><!-- /.tab-content -->
		</div><!-- /.nav-tabs-custom -->
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	{{-- <div class="panel-footer">  
		<span style="padding: 10px;"></span> 
		<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
		  <i class="fa fa-backward"></i> Kembali
		</a>
	  </div>   --}}

	  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

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