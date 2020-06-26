@extends('app')

@section('title')
  Akunting Detail
@stop

@section('contentheader')
Akunting Slip Order : {{$so->id_slip_order}} Details
@stop

@section('breadcrumb')
  <a href="/slipOrder">Akunting</a> / 
  <a href="/slipOrderSewaRecurring">Slip Order</a>
  <li>{{$so->id_slip_order}}</li>
@stop

@section('main-content')
<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<!-- Main content -->
<div class="panel-body">

  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active">  <a href="#payment_history" data-toggle="tab"> Payment History  </a> </li>
          
        </ul>
        <div class="tab-content">
          
          <div class="active tab-pane"  id="payment_history">
            <div class="row">
              <div class="col-md-12">
                <h2>Pembayaran Pertama</h2>
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Metode Pembayaran </label>
                        <div class="col-sm-4">
                          <input class="form-control" type="text" value="{{$so->pembayaran}}" disabled="">
                        </div>               
                          <label class="col-sm-2 control-label"> Jenis Bank </label>
                            <div class="col-sm-4">
                              <input type="text" disabled="" class="form-control" value="{{$so->jenis_bank}}">
                            </div>                  
                    </div> <br>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Nominal Pembayaran </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="Rp {{ number_format($so->nominal_pembayaran,0,'.','.') }}" disabled="">
                      </div>  
                      <label class="col-sm-2 control-label"> Tanggal Pembayaran </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="{{$so->tanggal}}" disabled="">
                      </div>                  
                    </div>
                  </form>

              </div>
            </div>
            <br>
            <hr>
              @foreach ($pembayaran as $item)
              <div class="row">                  
                <div class="col-md-12">
                    <h2>Recurring Bulan ke-{{$loop->iteration}}. </h2>
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Nama Pemilik Kartu </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="{{$item->nama_pemilik_kartu}}" disabled="">
                      </div>                  
                      <label class="col-sm-2 control-label"> Jenis Bank  </label>
                      <div class="col-sm-4">
                          <input type="text" disabled="" class="form-control" value="{{$item->jenis_bank}}">
                      </div>            
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Jenis Kartu Kredit </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="{{$item->jenis_kartu_kredit}}" disabled="">
                      </div>
                      <label class="col-sm-2 control-label"> Nomor Kartu Kredit </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="{{$item->nomor_kartu}}" disabled="">
                      </div>  
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Tanggal Debit </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="{{$item->tanggal_debit}}" disabled="">
                      </div> 
                      <label class="col-sm-2 control-label"> Masa Kartu Expired </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="{{$item->masa_kartu_expired}}" disabled="">
                      </div> 
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Nominal Debit </label>
                      <div class="col-sm-4">
                        <input class="form-control" type="text" value="Rp {{ number_format($item->nominal_pembayaran,0,'.','.') }}" disabled="">
                      </div> 
                    </div>
                  </form>
                </div>
              </div>                    
              <br>
              <hr>
              @endforeach
                    
          </div>
                                
        </div>
      </div>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
  <div class="panel-footer">
    <a class="btn btn-border btn-alt border-black font-black btn-xs pull-right" href="/slipOrderSewaRecurring">
      <i class="fa fa-backward"></i> Kembali
    </a>
</div>
</div><!-- /.nav-tabs-custom -->
          
@stop
@section('js')
    @parent    
@stop