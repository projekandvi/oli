<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>@section('title') Cosan CRM @show
        </title>
        <meta
            content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
            name='viewport'>
        <script src="{{ asset('/assets/js-core/modernizr.js') }}"></script>
        <!-- CSS -->
        <link
            rel="stylesheet"
            href="{{ asset('/build/base.a860b4298c9d804b3c70.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css-core/custom.css') }}">
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css"
            rel="stylesheet"/>
        @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('/assets/css-core/theme-rtl.css') }}">
            @endif
            <link
                href="{{ asset('/img/intelle_stock.png') }}"
                rel="icon"
                type="image/gif"
                sizes="16x16">
            <script src="{{ asset('/build/vendor.a860b4298c9d804b3c70.js') }}"></script>
    </head>

    <body class="add-transition pt-page-rotatePullTop-init">
        <div id="page-wrapper">
            @include('partials.mainheader') 
            @include('partials.sidebar')
            <div id="page-content-wrapper">
                <div id="page-content" style="min-height: 600px;">
                    <div class="container">
                        <!-- Content Header (Page header) -->
                        <div id="page-title">
                            <h2>
                                @section('contentheader') COSAN CRM
                                    <small style=" font-size: 12px; letter-spacing: 2px;">
                                        <b>{{Auth::user()->name}}</b>
                                    </small>
                                    @show
                            </h2>
                            <p>@section('contentheader_description') COSAN CRM @show</p>
                            <ol class="breadcrumb">
                                <li> <a href="/"> <i class="fa fa-dashboard"></i>  Dashboard  </a> </li>
                                <li class="active"> @section('breadcrumb') @show </li>
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
                                        <p>{!! isset($message) ? $message : Session::get('message') !!} </p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        @endif 
                        @if(isset($success) || Session::has('success')) 
                            @section('js') @parent
                            <script>
                                $(document).ready(function () {
                                    swal( {title: '', text: 'Changes Saved', type: 'success', confirmButtonText: 'Ok'} );
                                });
                            </script>
                            @stop 
                        @endif 
                        @if(isset($quantityerror) || Session::has('quantityerror'))
                            @section('js') @parent
                            <script>
                                $(document).ready(function () {
                                    swal({
                                        title: '',
                                        text: {
                                            !!json_encode(
                                                isset($quantityerror)
                                                    ? $quantityerror
                                                    : Session::get('quantityerror')
                                            )!!
                                        },
                                        type: 'warning'
                                    }).then(() => {
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
                                $(document).ready(function () {
                                    swal({
                                        title: '',
                                        text: {
                                            !!json_encode(
                                                isset($warning)
                                                    ? $warning
                                                    : Session::get('warning')
                                            )!!
                                        },
                                        type: 'warning',
                                        confirmButtonText: {
                                            !!json_encode(trans('core.ok'))!!
                                        }
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
                                    .nampilinBank {
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
                                <!-- Main content -->
                                <div class="panel-body" id="dw">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="nav-tabs-custom">
                                                {{-- tab title start --}}
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                    <a href="#inputTeknisi" data-toggle="tab">Input Teknisi Instalasi SO {{$data->id_slip_order}}</a>
                                                    </li>
                                                </ul>
                                                {{-- tab title end --}}

                                                <div class="tab-content">
                                                    {{-- tab pertama start --}}
                                                    <div class="active tab-pane" id="inputTeknisi">

                                                        <form action="/instalasi/proses/simpan" enctype="multipart/form-data" method="POST" id="isi_teknisi">
                                                            @csrf
                                                            <input type="hidden" name="id_rubah" value="{{$data->id}}" >	
															<input type="hidden" name="id_staf" value="{{Auth::user()->id}}">	
                                                            
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            @if ($data->tanggal_pemasangan != null)
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-group-sm">
                                                                                            <label>Tanggal Pemasangan<span class="required"></span></label>                           
                                                                                            <input type="text" class="form-control" value="{{date('d-m-Y', strtotime($data->tanggal_pemasangan))}}" disabled />
                                                                                            <input type="hidden" name="tanggal_pemasangan2" value="{{$data->tanggal_pemasangan}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group form-group-sm">
                                                                                            <label>Tanggal Pembaruan<span class="required">*</span></label>                           
                                                                                            <input type="date" class="form-control" name="tanggal_pemasangan" placeholder="yyyy-mm-dd">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group form-group-sm">
                                                                                    <label>Tanggal Pemasangan<span class="required">*</span></label>                           
                                                                                    <input type="date" class="form-control" name="tanggal_pemasangan" placeholder="yyyy-mm-dd">
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            @if ($data->tanggal_pemasangan != null)
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group form-group-sm">
                                                                                            <label>Teknisi<span class="required"></span></label>                           
                                                                                            <input type="text" class="form-control" value="{{$data->teknisi}}" disabled />
                                                                                            <input type="hidden" class="form-control" name="teknisi" value="{{$data->teknisi}}">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <div class="form-group form-group-sm">
                                                                                            <label>Teknisi Pembaruan<span class="required">*</span></label>  
                                                                                            <a data-toggle="modal" class="btn btn-success btn-alt btn-xs" data-target="#newTeknisi"><i class='fa fa-plus'></i> Teknisi</a>                          
                                                                                            <button type="button" class="btn btn-success btn-alt btn-xs" @click="refreshTeknisi()"><i class='fa fa-refresh'></i></button>   
                                                                                            <select class='form-control gampang' name="teknisi">
                                                                                                <option value="" disabled selected>-- Pilihan Teknisi --</option>
                                                                                                <option v-for='data in daftarTeknisi' v-bind:value='data.id'>@{{ data.nama_teknisi }}</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group form-group-sm">
                                                                                    <label>Teknisi<span class="required">*</span></label>  
                                                                                    <a data-toggle="modal" class="btn btn-success btn-alt btn-xs" data-target="#newTeknisi"><i class='fa fa-plus'></i> Teknisi</a>                          
                                                                                    <button type="button" class="btn btn-success btn-alt btn-xs" @click="refreshTeknisi()"><i class='fa fa-refresh'></i></button>   
                                                                                    <select class='form-control gampang' name="teknisi">
                                                                                        <option value="" disabled selected>-- Pilihan Teknisi --</option>
                                                                                        <option v-for='data in daftarTeknisi' v-bind:value='data.id'>@{{ data.nama_teknisi }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            @endif
                                                                          	                                    
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="row">
                                                                        
                                                                        <div class="col-md-12">	
                                                                          <div class="form-group form-group-sm">
                                                                            <label>Remark</label>                           
                                                                            @if ($data->remark != null)
																			<textarea name="remark" class="form-control" cols="30" rows="3" disabled>{{$data->remark}}</textarea>
																			<input type="hidden" name="remark" class="form-control" value="{{$data->remark}}" />
																			@else
																			<textarea name="remark" class="form-control" cols="30" rows="3"></textarea>
																			@endif
                                                                          </div>                          
                                                                        </div>
                                                                    </div>              
                                                                    
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                        </form>
                                                            {{-- isi tab pertama end --}}
                                                            <hr>
                                                            <div class="bg-default content-box text-center pad20A mrg25T">
                                                                 <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted(); document.getElementById('isi_teknisi').submit();">
                                                            </div>
                                                        </div>
                                                        <!-- /.tab-pane beli putus-->
                                                        {{-- tab pertama end --}}
                                                    </div>
                                                    <!-- /.tab-content -->
                                                </div>
                                                <!-- /.nav-tabs-custom -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

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
                                    </div>                                   

                                    <div class="panel-footer">
                                        <span style="padding: 10px;"></span>
                                        <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrder">
                                            <i class="fa fa-backward"></i>
                                            {{trans('back')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('partials.footer')
                    </div>
                </div>

                @include('InstalasiScript')

            </body>
        </html>