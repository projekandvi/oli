@extends('app')

@section('title')
	Tempo Maintenance
@stop

@section('contentheader')
Tempo Maintenance
@stop

@section('breadcrumb')
Tempo Maintenance
@stop

@section('main-content')


<div class="panel-body">	
	<table class="table table-bordered">
		<thead class="bg-gradient-1">
			<td class="text-center font-white">#</td>
			<td class="text-center font-white">ID Slip Order</td>
			<td class="text-center font-white">Nama Customer</td>
			<td class="text-center font-white">No. Hp 1</td>
			<td class="text-center font-white">No. Hp 2</td>
			<td class="text-center font-white">No. Telp</td>
			<td class="text-center font-white">Alamat Pemasangan</td>
		</thead>						
		<tbody>
			@foreach($reminder as $item)
				<tr>
					<td class="text-center">{{$loop->iteration}}</td>
					<td class="text-center" style="width: 7%;">{{$item->id_slip_order}}</td>
					<td class="text-center">{{$item->nama_customer}}</td>				
					<td class="text-center">{{$item->no_hp}}</td>
					<td class="text-center">{{$item->no_hp2}}</td>
					<td class="text-center">{{$item->no_telp}}</td>
					<td class="text-center">{{$item->alamat_pemasangan}}</td>						
				</tr>
			@endforeach
		</tbody>
	</table>		

</div><!-- /.panel body -->

<div class="panel-footer">  
	<span style="padding: 10px;"></span> 
	<a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
		<i class="fa fa-backward"></i> Kembali
	</a>
</div>  

@stop

@section('js')
	@parent
	<script>	
	</script>

@stop