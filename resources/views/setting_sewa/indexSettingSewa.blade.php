@extends('app')

@section('title')
	Biaya Sewa
@stop

@section('contentheader')
Biaya Sewa 
@stop

@section('breadcrumb')
Biaya Sewa 
@stop

@section('main-content')

	<div class="panel-body">

		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead class="bg-gradient-1">
						<td class="text-center font-white">Biaya Sewa</td>
						<td class="text-center font-white">Action</td>
					</thead>
					<tbody>
						<tr>
							<td class="text-center">Rp {{ number_format($biaya_sewa->biaya_sewa,0,'.','.') }}</td>
							<td class="text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-info btn-alt btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										action<span class="caret"></span>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a data-toggle="modal" data-target="#editModal"><i class="fa fa-edit" style="color: #edb426;"></i>	Ubah Biaya Sewa</a>
										</li>									
									</ul>
								</div>							
							</td>
						</tr>
		
						<!-- modal edit biaya sewa -->
						<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
							<form action="/editBiayaSewa" enctype="multipart/form-data" method="POST" class="form-horizontal">
								@csrf
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Mengubah Biaya Sewa</h4>
										</div>
										<div class="modal-body" >
											<div class="form-group">
												<label class="col-sm-4" style="text-align: left;" >
													Nominal Biaya Sewa
												</label>
												<div class="col-sm-8">
													<input type="text" name="nominal_biaya_sewa" class="form-control">
												</div>
											</div> <br>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
											<button type="submit" class="btn btn-success">Simpan</button>
										</div>
									</div>
								</div>
							</form>
						</div>
						<!-- edit biaya sewa modal ends here -->
						
					</tbody>
					
				</table>
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