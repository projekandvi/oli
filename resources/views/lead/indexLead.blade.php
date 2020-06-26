@extends('app')

@section('title')
	Daftar Lead
@stop

@section('contentheader')
Daftar Lead
@stop

@section('breadcrumb')
Daftar Lead
@stop

@section('main-content')
<div class="panel-heading">		
	<a href="{{route('lead.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"><i class='fa fa-plus'></i>Tambah Lead</a>

	@if(count(Request::input()))
		<span class="pull-right">	
			<a class="btn btn-default btn-alt btn-xs" href="{{ action('LeadController@getIndex') }}"><i class="fa fa-eraser"></i>clear</a>
			<a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i>modify search</a>
		</span>
	@else
		<a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton"><i class="fa fa-search"></i>search</a>
	@endif
</div>
<div class="panel-body">
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<td class="text-center font-white">#</td>
			<td class="text-center font-white">Nama Lead</td>
			<td class="text-center font-white">No. HP</td>
			<td class="text-center font-white">Telp</td>
			<td class="text-center font-white">Alamat</td>
			<td class="text-center font-white">Email</td>
			<td class="text-center font-white">Action</td>
		</thead>
		<tbody>
			@foreach($leads as $lead)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$lead->nama_lead}}</td>
					<td class="text-center">{{$lead->no_hp}}</td>
					<td class="text-center">{{$lead->no_telp}}</td>
					<td class="text-center">{{$lead->alamat}}</td>
					<td class="text-center">{{$lead->email}}</td>						
					<td class="text-center">
						<div class="btn-group">
							<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								action<span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right">
								<li><a data-toggle="modal" data-target="#convertModal{{$lead->id}}"><i class="fa fa-edit" style="color: #edb426;"></i>Convert</a></li>
								<li><a href="{{route('lead.edit', $lead)}}" title="Edit"><i class="fa fa-edit" style="color: #069996;"></i>edit</a></li>
								<li><a data-toggle="modal" data-target="#deleteModal{{$lead->id}}"><i class="fa fa-trash" style="color: #edb426;"></i>Delete</a></li>
								<li><a href="{{route('lead.details', $lead)}}"><i class="fa fa-eye" style="color: #269fed;"></i>Details</a></li>
							</ul>
						</div>							
					</td>
				</tr>
				<!-- modal for convert lead to customer-->
				<div class="modal fade" id="convertModal{{$lead->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">Convert To Customer, Mohon lengkapi data tambahan</h4>
							</div>
							<div class="modal-body">
								{!! Form::open(['route'=> ['lead.convert'], 'method'=>'post', 'class' => 'form-horizontal']) !!}
									<div class="row">										
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Nama customer<span class="required">*</span></label>
												<input type="text" class="form-control" placeholder="Nama customer" name="nama_customer" value="{{$lead->nama_lead}}" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Jenis Kelamin<span class="required">*</span></label>
												<select name="jenis_kelamin" class="form-control">
													<option value="" disabled selected>-- Pilihan Jenis Kelamin --</option>
													<option value="Laki - Laki">Laki - Laki</option>
													<option value="Perempuan">Perempuan</option>
												</select>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Tanggal Lahir</label>
												<input type="date" class="form-control" placeholder="Tanggal Lahir" name="tanggal_lahir" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label class="control-label col-sm-3">No Telp</label>
												<input type="text" class="form-control" placeholder="No Telp" name="no_telp" value="{{$lead->no_telp}}" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>No. Hp 1<span class="required">*</span></label>
												<input type="text" class="form-control" placeholder="No. Hp" name="no_hp" value="{{$lead->no_hp}}" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>No. Hp 2</label>
												<input type="text" class="form-control" placeholder="No. Hp2" name="no_hp2"/>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Nomor Induk Kependudukan (NIK)<span class="required">*</span></label>
												<input type="text" class="form-control" placeholder="NIK" name="no_ktp" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>CRC Code</label>
												<input type="text" class="form-control" placeholder="CRC Code" name="crc_code" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>La Code</label>
												<input type="text" class="form-control" placeholder="LA Code" name="la_code" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Email</label>
												<input type="text" class="form-control" placeholder="Email" name="email" value="{{$lead->email}}" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Nama Keluarga Dekat yang Tidak Serumah</label>
												<input type="text" class="form-control" placeholder="Data Keluarga Dekat yang Tidak Serumah" name="keluarga"/>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>No. Hp Keluarga Dekat yang Tidak Serumah</label>
												<input type="text" class="form-control" placeholder="Email" name="hp_keluarga" />
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Alamat<span class="required">*</span></label>                           
												<textarea class="form-control" name="alamat" cols="30" rows="4">{{$lead->alamat}}</textarea>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Alamat Pemasangan<span class="required">*</span></label>                           
												<textarea class="form-control" name="alamat" cols="30" rows="4">{{$lead->alamat}}</textarea>
											</div>                                     
										</div>
										<div class="col-md-12">
											<div class="form-group form-group-sm">
												<label>Kewarganegaraan<span class="required">*</span></label>
												<select name="kewarganegaraan" class="form-control">
													<option value="WNI">WNI</option>
													<option value="WNA">WNA</option>
												</select>
											</div>                                     
										</div>	
									</div>
									{{-- --------------------------------------------------------------------------------- --}}
																	
																		
									<div class="form-group">
										
										
									</div>							
									<div class="form-group">
										
										
									</div>
								{!! Form::close() !!}
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
								<button type="submit" class="btn btn-success">Convert</button>
							</div>
						</div>
					</div>
					
				</div>
				<!-- convert lead modal ends here -->
				<!-- modal for delete leads -->
				<div class="modal fade" id="deleteModal{{$lead->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					{!! Form::open(['route'=> ['lead.delete', $lead], 'method'=>'delete']) !!}
					  	<div class="modal-dialog" role="document">
							<div class="modal-content">
						  		<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>							
									<h4 class="modal-title" id="myModalLabel">Delete Lead</h4>
						  		</div>
						  		<div class="modal-body" ><h4>Delete  <b>{{$lead->nama_lead}}</b>?</h4><br></div>
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
		{{ $leads->links() }}
	</div>
	<!--Ends-->
</div>
<div class="panel-footer">  
	<span style="padding: 10px;"></span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/"><i class="fa fa-backward"></i> Kembali</a>
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