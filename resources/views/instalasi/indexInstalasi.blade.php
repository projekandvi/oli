<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> @section('title') Cosan CRM @show </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <script src="{{ asset('/assets/js-core/modernizr.js') }}"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('/build/base.a860b4298c9d804b3c70.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css-core/custom.css') }}">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('/assets/css-core/bootstrap.rtl.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css-core/theme-rtl.css') }}">
        @endif
        <link href="{{ asset('/img/intelle_stock.png') }}" rel="icon" type="image/gif" sizes="16x16">
        <script src="{{ asset('/build/vendor.a860b4298c9d804b3c70.js') }}"></script>        
    </head>
      
<body class="add-transition pt-page-rotatePullTop-init">
  
  <div id="page-wrapper">        
    @include('partials.mainheader') 
    @include('partials.sidebar')   
    
    <div id="page-content-wrapper" >
      <div id="page-content" style="min-height: 600px;">
        <div class="container">
          <!-- Content Header (Page header) -->
          <div id="page-title">
            <h2>
              @section('contentheader') 
                COSAN CRM
                  <small style=" font-size: 12px; letter-spacing: 2px;">
                    <b>{{Auth::user()->name}}</b>
                </small>
              @show
            </h2>
            <p>@section('contentheader_description') COSAN CRM @show</p>
              <ol class="breadcrumb">
                <li> <a href="/"> <i class="fa fa-dashboard"></i> Dashboard </a> </li>
                <li class="active">  @section('breadcrumb') @show </li>
              </ol>
          </div>
          @if(( isset($errors) && $errors->any()) || Session::has('error') || isset($error) || Session::has('message') || isset($message))
            <div id="messageBar" class="animated fadeInDown">
              @if($errors->any())
                <div class="alert alert-close alert-danger">
                  <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                  <div class="bg-red alert-icon">
                      <i class="glyph-icon fa fa-times fa-2x"></i>
                  </div>
                  <div class="alert-content">
                      <h4 class="alert-title">Error</h4>
                      <p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{!! $error !!}</li>
                            @endforeach
                        </ul>
                      </p>
                  </div>
              </div>
              @endif

              @if(isset($message) || Session::has('message'))

              <div class="alert alert-close alert-info">
                  <a href="#" title="Close" class="glyph-icon alert-close-btn icon-remove"></a>
                  <div class="bg-info alert-icon">
                      <i class="fa {{ (isset($icon)) ? $icon : (Session::has('icon') ? Session::get('icon') : 'fa-info-circle') }} fa-2x text-info"></i>
                  </div>
                  <div class="alert-content">
                      <h4 class="alert-title">Info</h4>
                      <p>
                          {!! isset($message) ? $message : Session::get('message') !!}
                      </p>
                  </div>
              </div>

              @endif
        
            </div>
          @endif

          @if(isset($success) || Session::has('success'))
              @section('js')
                  @parent
                  <script>
                      $(document).ready(function() {
                          swal({
                              title: '',
                              text: 'Changes Saved',
                              type: 'success',
                              confirmButtonText: 'Ok'
                          });
                      });
                  </script>
              @stop
          @endif

          @if(isset($quantityerror) || Session::has('quantityerror'))
              @section('js')
                  @parent
                  <script>
                      $(document).ready(function() {
                          swal({
                              title: '',
                              text: {!! json_encode(isset($quantityerror) ? $quantityerror : Session::get('quantityerror')) !!},
                              type: 'warning',
                          })
                          .then(() => {
                          window.location.href = '{{route("sell.index")}}';
                          });
                      });
                  </script>
              @stop
          @endif

          @if(isset($warning) || Session::has('warning'))
              @section('js')
                  @parent
                  <script>
                      $(document).ready(function() {
                          swal({
                              title: '',
                              text: {!! json_encode(isset($warning) ? $warning : Session::get('warning')) !!},
                              type: 'warning',
                              confirmButtonText: {!! json_encode(trans('core.ok')) !!}
                          });
                      });
                  </script>
              @stop
          @endif
          <div class="panel">
            <style>
                .output {
                  margin: 0 auto;
                }
                .colors {
                  display: none;
                }
                .output_recurring {
                  margin: 0 auto;
                }
                .recurring {
                  display: none;
                }
                
                .debit_output {
                  margin: 0 auto;
                }
                .debit_colors {
                  display: none;
                }
                input[type=number]::-webkit-inner-spin-button, 
                input[type=number]::-webkit-outer-spin-button { 
                  -webkit-appearance: none; 
                  margin: 0; 
                }
			</style>
			
			<div id="dw">
				<div class="panel-heading">		
					<a data-toggle="modal" class="btn btn-success btn-alt btn-xs" data-target="#permingguModal"><i class='fa fa-sort-numeric-asc'></i> Tampilkan Data Perminggu</a>
					<a data-toggle="modal" class="btn btn-success btn-alt btn-xs" data-target="#newTeknisi"><i class='fa fa-plus'></i> Teknisi</a>                          
					
					@if(count(Request::input()))
						<span class="pull-right">	
							<a class="btn btn-default btn-alt btn-xs" href="{{ action('InstalasiController@getIndex') }}"><i class="fa fa-eraser"></i> clear</a>			
							<a data-toggle="modal" class="btn btn-primary btn-alt btn-xs" data-target="#searchModal"><i class="fa fa-search"></i>modify search</a>                          
						</span>
					@else
						<a data-toggle="modal" class="btn btn-primary btn-alt btn-xs pull-right" data-target="#searchModal"><i class="fa fa-search"></i>search</a>                          
					@endif
				</div>
				<!-- Main content -->
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
										<td class="text-center font-white">ID Customer</td>
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
												<td class="text-center">{{$item->so['tanggal']}}
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
												<td class="text-center">
													{{-- <input class="btn btn-primary" type="submit" id="submitButton{{$loop->iteration}}" value="Simpan" onclick="submitted()"> --}}
													<a class="btn btn-primary" data-toggle="modal" data-target="#prosesInstalasiModal{{$item->id_slip_order}}"><i class="fa fa-edit" style="color: #069996;"></i> Input Teknisi Instalasi</a>
												</td>
											</tr>												
											
											<!-- input teknisi modal -->
											<div class="modal fade" id="prosesInstalasiModal{{$item->id_slip_order}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
															<h4 class="modal-title" id="myModalLabel">Form Input Teknisi</h4>
														</div>
														<div class="modal-body">
															<form action="/instalasi/proses/simpan" enctype="multipart/form-data" method="POST" class="form-horizontal" id="simpanProses{{$item->id_slip_order}}">
																@csrf
																<input type="hidden" name="id_rubah" value="{{$item->id}}" >	
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
																			<label>Teknisi<span class="required">*</span></label><button type="button" class="btn btn-success btn-alt btn-xs" @click="refreshTeknisi()"><i class='fa fa-refresh'></i></button>                            
																			@if ($item->teknisi != null)
																			<input type="text" class="form-control" value="{{$item->teknisi}}" disabled />
																			<input type="hidden" class="form-control" name="teknisi" value="{{$item->teknisi}}" />
																			@else
																			<select class='form-control gampang' name="teknisi">
																				<option value="" disabled selected>-- Pilihan Teknisi --</option>
																				<option v-for='data in daftarTeknisi' v-bind:value='data.id'>@{{ data.nama_teknisi }}</option>
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
															</form>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
															
																{{-- <button type="submit" class="btn btn-success" onclick="event.preventDefault();  document.getElementById('simpanProses{{$item->id_slip_order}}').submit();">Simpan</button> --}}
																
																<button type="submit" class="btn btn-success">Simpan</button>
																{{-- <input type="submit" class="btn btn-success" value="submit"/> --}}
																{{-- <a class="btn btn-successs" onclick="event.preventDefault();  document.getElementById('simpanProses').submit();"> Save</a>       --}}
															</div>
														</div>
													</div>
												
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
							</div><!-- /.tab-pane instalasi -->
				
						</div><!-- /.tab-content -->
					</div><!-- /.nav-tabs-custom -->
					{{-- -------------------------------------------------------------------------------- --}}		
				</div>
				<!-- input new teknisi modal -->
				<div class="modal fade" id="newTeknisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">                          
					<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Form Input Teknisi Baru</h4>
						</div>
						<div class="modal-body">
						<div class="form-group" style="margin-bottom: 40px;">
							<label class="col-sm-4" style="text-align: left;">Nama Teknisi</label>
							<div class="col-sm-8">
							<input type="text"  v-model="formTeknisi.nama_teknisi" class="form-control" name="b">
							</div>
						</div>         
						</div>
						<div class="modal-footer" style="margin-top: 5%;">
						<button type="button" class="btn btn-primary" data-dismiss="modal" @click="saveTeknisi()">save</button>
						</div>
					</div>
					</div>
			
				</div>
				<!-- new teknisi modal ends here -->
			</div><!--end dw -->
            <div class="panel-footer">
              <span style="padding: 10px;"></span> 
              <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/"> <i class="fa fa-backward"></i> Kembali </a>
			</div> 
						
			<!-- search modal -->
			<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">                          
				<div class="modal-dialog" role="document">
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
			  <!-- search modal ends here -->

			<!-- Perminggu modal -->
			<div class="modal fade" id="permingguModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">                          
				<div class="modal-dialog" role="document">
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
			  <!-- Perminggu modal ends here -->




			

		  </div>
		  

        </div>
      </div>
      @include('partials.footer') 
    </div>        
  </div>
  @include('instalasiScript')

</body>
</html>