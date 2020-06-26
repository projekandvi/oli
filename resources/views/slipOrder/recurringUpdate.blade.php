@extends('app')

@section('title')
  Slip Order {{$so->id_slip_order}}
@stop

@section('contentheader')
  {{$so->id_slip_order}} Recurring Data Update
@stop

@section('breadcrumb')
  <a href="/slipOrder">Slip Order</a> / 
  <a href="/slipOrderSewaRecurring">Slip Order Recurring</a>
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
    @if ($so->nama_pemilik_kartu_recurring === null)
      <div class="col-md-12 text-center">
        <label style="font-size: 20px;">Data Recurring Belum Terisi, Mohon untuk melengkapi data recurring</label>
      </div><br><hr>
      <form action="/isiDataRecurring" enctype="multipart/form-data" method="POST" id="ism_form">
        @csrf
        <input type="hidden" name="id_slip_order" value="{{$so->id_slip_order}}">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">	
              <label>Nama Pemilik Kartu Recurring</label>                           
              <input type="text" name="nama_pemilik_kartu_recurring" class="form-control" value="{{$so->nama_customer}}">
            </div>
            <div class="col-md-12">	
              <label>Jenis Bank</label> <br>                          
              <select class='form-control gampang' name="jenis_bank_recurring">
                <option value="" disabled selected>-- Pilihan Bank --</option>
                @foreach ($banks as $item)
                  <option value="{{$item->kode_bank}}">{{ $item->nama_bank }}</option>
                @endforeach                            
              </select>
            </div>
            <div class="col-md-12">	
              <label>Jenis Kartu Kredit</label>
              <select name="jenis_kartu_kredit_recurring" class="form-control">
                <option>-- Pilihan Kartu Kredit --</option>
                <option value="visa">Visa</option>
                <option value="master">Master Card</option>
                <option value="jcb">JCB</option>
              </select>                           
              
            </div>
            <div class="col-md-12">	
              <label>Nomor Kartu</label>                           
              <input type="number" name="nomor_kartu_recurring" class="form-control" onKeyPress="if(this.value.length==16) return false;" >
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <label>Nominal Debit</label>                           
              <input type="text" class="form-control" name="nominal_debit_recurring"  value="{{$biaya_sewa->biaya_sewa}}">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>Tanggal Debit Recurring</label>                           
              <select name="tanggal_debit_recurring" class="form-control">
                <option>-- Pilihan Tanggal --</option>
                <option value="10">Tanggal 10</option>
                <option value="25">Tanggal 25</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>Masa Kartu Expired Recurring</label>                           
              <input type="text" id="basi" name="basi" class="expiredCard form-control" onKeyPress="if(this.value.length==5) return false;" >
              <input type="hidden" id="basihasil" name="masa_kartu_expired_recurring">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>Remark</label>                           
              <textarea name="remark" class="form-control" id="" cols="30" rows="3"></textarea>
            </div>
          </div>
        </div> 
        <div class="col-md-12">
          <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">                   
          </div> 
        </div>
      </form>
    @else
      <div class="col-md-12 text-center">
        <label style="font-size: 20px;">Data Recurring</label>
      </div><br><hr>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">	
            <label>Nama Pemilik Kartu Recurring</label>                           
            <input type="text" class="form-control" value="{{$so->nama_pemilik_kartu_recurring}}" disabled="true">
          </div>
          <div class="col-md-12">	
            <label>Jenis Bank</label>                           
            <input type="text" class="form-control" value="{{$so->bank->nama_bank}}" disabled="true">
          </div>
          <div class="col-md-12">	
            <label>Jenis Kartu Kredit</label>
            @if($so->jenis_kartu_kredit_recurring === 'visa')
              <input type="text" class="form-control" value="Visa" disabled="true">
            @elseif($so->jenis_kartu_kredit_recurring === 'master')
              <input type="text" class="form-control" value="Master Card" disabled="true">
            @elseif($so->jenis_kartu_kredit_recurring === 'kartu_debit')
              <input type="text" class="form-control" value="Kartu Debit" disabled="true">
            @elseif($so->jenis_kartu_kredit_recurring === 'jcb')
              <input type="text" class="form-control" value="JCB" disabled="true">
            @endif                            
            
          </div>
          <div class="col-md-12">	
            <label>Nomor Kartu</label>                           
            <input type="text" class="form-control" value="{{$so->nomor_kartu_recurring}}" disabled="true">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <label>Nominal Debit</label>                           
            <input type="text" class="form-control" value="{{$so->nominal_debit_recurring}}" disabled="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Tanggal Debit Recurring</label>                           
            <input type="text" class="form-control" value="{{$so->tanggal_debit_recurring}}" disabled="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Masa Kartu Expired Recurring</label>                           
            <input type="text" class="form-control" value="{{$so->masa_kartu_expired_recurring}}" disabled="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Remark</label>                           
            <textarea name="catatan_recurring" class="form-control" id="" cols="30" rows="3" disabled="true">{{$so->remark}}</textarea>
          </div>
        </div>
      </div> 
    @endif   
  </div><!-- /.tab-content -->
  <div class="panel-footer">
    <a class="btn btn-border btn-alt border-black font-black btn-xs pull-right" href="/daftarRecurringKosong">
      <i class="fa fa-backward"></i> Kembali
    </a>
  </div>
</div><!-- /.nav-tabs-custom -->
          
@stop
@section('js')
    @parent 
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>     

    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script> 
    <script>
      $(function() {
		$('#upgradeButton').click(function(event) {
			event.preventDefault();
			$('#upgradeModal').modal('show')
		});
  });

  $(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('0.000.000.000', {reverse: true});
        // Format nomor HP.
        $( '.no_hp' ).mask('0000−0000−0000');
        // Format expired card
        $( '.expiredCard' ).mask('00/00');
    });

  $(function() {
        $('#basi').change(function(){
            document.getElementById("basihasil").value = lili(document.getElementById("basi").value);
        });
    });

    function lili(x)     
    {     
        return x.replace(/\//g,'');
    } 
  </script>  
@stop