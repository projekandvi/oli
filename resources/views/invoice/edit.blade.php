@extends('app')

@section('contentheader')
Editing Sales Order <b>{{$invoice->id_invoice}}</b>
@stop

@section('breadcrumb')
  Edit Slip Order
@stop

@section('main-content')
<style>
.output {
  margin: 0 auto;
}
.colors {
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
            <a href="#beli_putus" data-toggle="tab">Edit Data</a>
          </li>
        </ul>
        {{-- tab title end --}}
        <div class="tab-content">
          {{-- tab pertama start --}}
          <div class="active tab-pane" id="beli_putus">
          {{-- isi tab pertama start --}}
            {{-- {!! Form::model($invoice, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!} --}}
            <form action="/slipOrderPutusEdit" method="post" enctype="multipart/form-data" class="form-horizontal bordered-row" id="ism_form">
              @csrf
              <input type="hidden" name="id_staf" value="{{Auth::user()->id}}" />				
                <input type="hidden" name="status_barang" value="Terbeli" />				
                  <div class="row">
                    <div class="col-md-6"></div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6">Nomor Slip Order<span class="required">*</span></label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control" name="id_invoice" value="{{$invoice->id_invoice}}" />                                         
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">	
                          <label>Tanggal</label>                           
                           <input type="date" class="form-control" name="tanggal" value="{{$invoice->tanggal}}" />
                        </div>
                        <div class="col-md-6">	
                          <label>Team</label>                           
                          <input type="text" class="form-control" placeholder="team" name="team" value="{{$invoice->team}}" />
                        </div>
                      </div>
                          
                      <div class="row">
                        <div class="col-md-6">	
                          <label>Nama Seller</label>                           
                          <input type="text" class="form-control" placeholder="nama seller" name="nama_seller" value="{{$invoice->nama_seller}}" />
                        </div>
                        <div class="col-md-6">	
                          <label>Location</label>                           
                          <input type="text" class="form-control" placeholder="lokasi" name="lokasi_penjualan" value="{{$invoice->lokasi_penjualan}}" />
                        </div>
                      </div>

                      {{-- <div class="row">
                        <div class="col-md-6">	
                          <label>CRC Code</label>                           
                          <input type="text" class="form-control" placeholder="crc code" name="crc_code" value="{{$invoice->crc_code}}" />
                        </div>
                        <div class="col-md-6">	
                          <label>LA Code</label>                           
                          <input type="text" class="form-control" placeholder="la code" name="la_code" value="{{$invoice->la_code}}" />
                        </div>
                      </div>                --}}
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Nama Customer</label>                           
                          <select name="id_customer" id="product_id" class="form-control" required width="100%">
                            <option value="">Pilih</option>
                            @foreach ($customers as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $invoice->id_customer ? 'selected':'' }}>
                                    {{ ucfirst($row->nama_customer) }}
                                </option>
                            @endforeach                         
                          </select>
                          {{-- <label class="form-control">{{$invoice->nama_customer}}</label> --}}
                          <input type="hidden" class="form-control" name="id_customer" value="{{$invoice->id_customer}}" />
                          <input type="hidden" class="form-control" name="nama_customer" value="{{$invoice->nama_customer}}" />
                        </div>
                      </div>
                      

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>No. KTP</label>                           
                          
                          <input type="text" class="form-control" name="no_ktp" v-model="product.no_ktp" value="" />
                          
                        </div>
                      </div> --}}

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>Alamat KTP</label>         
                            <input type="text" class="form-control"  name="alamat_ktp" v-model="product.alamat" value="" />
                           
                        </div>
                      </div> --}}

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>Alamat Pemasangan</label>                           
                          @if ($invoice->alamat_pemasangan === null)
                          <input type="text" class="form-control" name="alamat_pemasangan" v-model="product.alamat_pemasangan" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="alamat pemasangan" name="alamat_pemasangan" value="{{$invoice->alamat_pemasangan}}" />
                          @endif
                        </div>
                      </div> --}}

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>No. Telp</label>                           
                          @if ($invoice->no_telp === null)
                          <input type="text" class="form-control" name="no_telp" v-model="product.no_telp" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="no telp" name="no_telp" value="{{$invoice->no_telp}}" />
                          @endif 
                        </div>
                      </div> --}}

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>No. HP.</label>                           
                          @if ($invoice->no_hp === null)
                          <input type="text" class="form-control" name="no_hp" v-model="product.no_hp" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="no telp" name="no_hp" value="{{$invoice->no_hp}}" />
                          @endif   
                        </div>
                      </div> --}}

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>Email</label>                           
                            @if ($invoice->email === null)
                            <input type="text" class="form-control" name="email" v-model="product.email" value="" />
                            @else
                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{$invoice->email}}" />
                            @endif    
                        </div>
                      </div> --}}

                      {{-- <div class="row">
                        <div class="col-md-12">
                          <label>Tempat Tinggal</label>                           
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="Milik Sendiri" name="milik_tempat_tinggal">
                            <label class="form-check-label" for="exampleCheck1">Milik Sendiri</label> &nbsp;
                            <input type="checkbox" class="form-check-input" value="Sewa" name="milik_tempat_tinggal">
                            <label class="form-check-label" for="exampleCheck1">Sewa</label>
                          </div>
                        </div>
                      </div> --}}

                    </div>
                  </div>

                  
                  <hr>
                  
              <div class="bg-default content-box text-center pad20A mrg25T">
                <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
              </div>
                
            {{-- {{ Form::close() }} --}}
            </form>
              {{-- isi tab pertama end --}}
        </div><!-- /.tab-pane beli putus-->
          {{-- tab pertama end --}}
          
        
        </div><!-- /.tab-content -->
        </div><!-- /.nav-tabs-custom -->
      </div><!-- /.col -->  
  </div>
  <!-- /.row -->  
</div>
  
      <div class="panel-footer">
        <span style="padding: 10px;"></span> 
        <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="{{route('barang.index')}}"> <i class="fa fa-backward"></i> {{trans('back')}} </a>
      </div>
@stop