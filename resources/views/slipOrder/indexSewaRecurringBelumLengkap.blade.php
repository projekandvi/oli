@extends('app')

@section('title')
	Slip Order Sewa Recurring Dengan Data Belum Lengkap
@stop

@section('contentheader')
Daftar Slip Order Sewa Recurring Dengan Data Belum Lengkap
@stop

@section('breadcrumb')
Daftar Slip Order Sewa Recurring Dengan Data Belum Lengkap
@stop

@section('main-content')

<style>
	.pilihanPencarian {
		display: none;
	}
</style>



<div class="panel-body">
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<td class="text-center font-white">#</td>
			<td class="text-center font-white">ID Slip Order</td>
			<td class="text-center font-white">Tanggal</td>
			<td class="text-center font-white">Tipe Penjualan</td>
			<td class="text-center font-white">Lokasi</td>
			<td class="text-center font-white">Sales Amount</td>
			<td class="text-center font-white">Nama Customer</td>
			<td class="text-center font-white">No hp</td>
			<td class="text-center font-white">Action</td>
		</thead>						
		<tbody>
			@foreach($cek as $SO)
				@if ($SO->tarikan_barang === 'TRUE')
					<tr style="background-color: red">
				@else
				<tr>
				@endif				
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center">{{$SO->id_slip_order}}</td>
					<td class="text-center">{{date('d-m-Y', strtotime($SO->tanggal))}}</td>
					<td class="text-center">{{$SO->tipe_penjualan}}</td>
					<td class="text-center">{{$SO->lokasi_penjualan}}</td>
					<td class="text-right">Rp {{ number_format($SO->pembayar->sum('nominal_pembayaran'),0,'.','.') }}</td>
					<td class="text-center">{{$SO->nama_customer}}</td>
					<td class="text-center">{{$SO->no_hp}}</td>
					<td class="text-center">
						<a href="{{route('SO.updateRecurring', $SO->id_slip_order)}}" class="btn btn-info btn-alt btn-xs dropdown-toggle">Melengkapi Data </a>						
					</td>
				</tr>
				<!-- modal for delete Sewa recurring -->
				<div class="modal fade" id="deleteModal{{$SO->id_slip_order}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					{{-- {!! Form::open(['route'=> ['customer.delete', $SO], 'method'=>'delete']) !!} --}}
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="myModalLabel">{{$SO->id_slip_order}}</h4>
							</div>
							<div class="modal-body" >
								<h4>Delete  <b>{{$SO->id_slip_order}}</b>?</h4>
								<br>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
								<button type="submit" class="btn btn-danger">delete</button>
							</div>
						</div>
					</div>
					{{-- {!! Form::close() !!} --}}
				</div>
				<!-- delete modal ends here -->						
			@endforeach
		</tbody>
	</table>					
	
</div>

<div class="panel-footer">  
	<span style="padding: 10px;">	</span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrderSewaRecurring">
		<i class="fa fa-backward"></i> Kembali
	</a>
</div>

	{{-- -----------------------------------------------------modal-------------------------------------- --}}


@stop

@section('js')
@parent
<script>
	

	$(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('0.000.000.000', {reverse: true});
    });
</script>

@stop