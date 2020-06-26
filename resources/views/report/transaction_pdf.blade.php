<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penjualan Tiket Masuk Museum Bank Indonesia</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
        <img style="width: 200px" src="{{ asset('/img/mbi_logo.png') }}" alt="">
		<h5>Laporan Penjualan Tiket Masuk Museum Bank Indonesia</h4>
		<h6>Periode :{{$periode}} </h5>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th style="text-align: center">No</th>
				<th style="text-align: center">INV</th>
				<th style="text-align: center">Destination Name</th>
				<th style="text-align: center">Customer Name</th>
				<th style="text-align: center">Gender</th>
				<th style="text-align: center">Age</th>
				<th style="text-align: center">Origin</th>
				<th style="text-align: center">Occupation</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($transactions as $p)
			<tr>
				<td style="text-align: center">{{ $i++ }}</td>
				<td style="text-align: center">{{$p->inv}}</td>
				<td style="text-align: center">{{$p->destination_name}}</td>
				<td style="text-align: center">{{$p->customer_name}}</td>
				<td style="text-align: center">{{$p->gender}}</td>
				<td style="text-align: center">{{$p->age}}</td>
				<td style="text-align: center">{{$p->region}}</td>
				<td style="text-align: center">{{$p->occupation}}</td>
			</tr>
			@endforeach
		</tbody>oreach
		</tbody>
	</table>

</body>
</html>