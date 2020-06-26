@extends('app')

@section('title')
  Temporary Slip Order
@stop

@section('contentheader')
Temporary Slip Order Details
@stop

@section('breadcrumb')
  <a href="{{route('barang.index')}}">Temporary Slip Order</a>
  <li>Temporary Slip Order</li>
@stop

@section('main-content')

<div class="panel-body" style="min-height: 1020px;">
  <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <!-- <li class="active">
              <a href="#details" data-toggle="tab">
                General Settings
              </a>
            </li> -->
            <li class="active bg-gradient-2 font-white">
              <a href="#editSettings" data-toggle="tab" class="bg-gradient-2 font-white no-border">
                General Settings
              </a>
            </li>
        </ul>

        <div class="tab-content">            

            <!--Tab For Edit Settings-->
            <div class="active tab-pane animated fadeIn" id="editSettings">
              {!! Form::open(['route'=> ['temporary.terima', $temporary], 'method'=>'post']) !!}
        <div class="example-box-wrapper">
        <div class="form-horizontal bordered-row">

          <div class="form-group bg-khaki">
            <h3 class="control-label col-sm-2 title-hero">
                    Permintaan Perubahan
                </h3>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">
              Nama Customer
            </label>
            <div class="col-sm-4 "> 
              <input class="form-control" name="site_name" type="text" value="{{$asli->nama_customer}}">
              <!--  -->
              </div>

              <label class="control-label col-sm-2">
                Perubahan 
              </label>
            <div class="col-sm-4"> 
              @if ($asli->nama_customer === $temporary->nama_customer)
              <i class="fa fa-times fa-2x" style="color: red;"></i>
              @else
              <input class="form-control" name="slogan" type="text" value="Stock management.">
              @endif
              
              </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">
              Team
            </label>
            <div class="col-sm-4 "> 
              <input class="form-control" name="site_name" type="text" value="{{$asli->team}}">
              <!--  -->
              </div>

              <label class="control-label col-sm-2">
                Perubahan 
              </label>
            <div class="col-sm-4"> 
              @if ($asli->team === $temporary->team)
              <i class="fa fa-times fa-2x" style="color: red;"></i>
              @else
              <input class="form-control" name="slogan" type="text" value="{{$temporary->team}}">
              @endif
              
              </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2">
              Nama Seller
            </label>
            <div class="col-sm-4 "> 
              <input class="form-control" name="site_name" type="text" value="{{$asli->nama_seller}}">
              <!--  -->
              </div>

              <label class="control-label col-sm-2">
                Perubahan 
              </label>
            <div class="col-sm-4"> 
              @if ($asli->nama_seller === $temporary->nama_seller)
              <i class="fa fa-times fa-2x" style="color: red;"></i>
              @else
              <input class="form-control" name="slogan" type="text" value="{{$temporary->nama_seller}}">
              @endif
              
              </div>
          </div>    
          <div class="bg-default content-box text-center pad20A mrg25T">
            <a class="btn btn-lg btn-danger" data-toggle="modal" data-target="#tolakModal{{$temporary->id_invoice}}">Tolak</a>
            <button class="btn btn-lg btn-primary" type="submit">       Setujui    </button>
          </div>
        </div>		
        </div>
    {!! Form::close() !!}            
</div>
            <!--Ends-->
        </div><!--Tab Content Ends-->
    </div> <!--nav-tabs-custom-->
</div>

    <div class="panel-footer">  
        <span style="padding: 10px;">
        
        </span> 
      <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="{{route('barang.index')}}">
            <i class="fa fa-backward"></i> {{trans('back')}}
        </a>
    </div>

    <!-- modal for delete product -->
    <div class="modal fade" id="tolakModal{{$temporary->id_invoice}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      {!! Form::open(['route'=> ['temporary.tolak', $temporary], 'method'=>'post']) !!}

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">{{$temporary->id_invoice}}</h4>
            </div>
            <div class="modal-body" >
              <h4>Tolak Pengajuan Perubahan Data  <b>{{$temporary->id_invoice}}</b>?</h4>
              <br>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              <button type="submit" class="btn btn-danger">Tolak</button>
            </div>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
    <!-- delete modal ends here -->

@stop


@section('js')
    @parent
@stop