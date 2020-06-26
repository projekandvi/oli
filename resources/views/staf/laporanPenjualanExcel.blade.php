<table class="table table-bordered">
    <thead class="bg-gradient-1">
        <tr>
            <th>VP / GM</th>
            <th>Agency</th>
            <th>ID Slip Order</th>
            <th>Tanggal Transaksi</th>
            <th>Lokasi Penjualan</th>
            <th>Jenis Penjualan</th>
            <th>Nominal Transaksi</th>
            <th>No. KTP Customer</th>
            <th>Nama Customer</th>
            <th>Alamat KTP</th>
            <th>No. Telp Customer</th>
            <th>No. HP Customer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $item)
            @php ($first = true)  @endphp
            @foreach($item->so as $row)
                <tr>
                @if($first == true)
                    <td rowspan="{{$item->so->count('id_slip_order')}}"> {{$item->salesManager->nama_manajer}}</td>
                    <td rowspan="{{$item->so->count('id_slip_order')}}"> {{$item->nama_sales}}</td>
                    @php ($first = false) @endphp
                @endif
                    <td> {{ $row->id_slip_order}} </td>
                    <td> {{ $row->tanggal}} </td>
                    <td> {{ $row->lokasi_penjualan}} </td>
                    <td> {{ $row->tipe_penjualan }}
                    @if ($row->tipe_penjualan === 'SewaPeriode')
                        &nbsp; ({{ $row->periode_sewa }} Bulan)
                    @endif
                    </td>
                    <td>
                        @if ($row->tipe_penjualan === 'SewaRecurring')
                            Rp. {{ number_format($biaya_sewa->biaya_sewa,0,'.','.') }}
                        @else
                            Rp. {{ number_format($row->total_cart,0,'.','.') }}
                        @endif
                    </td>
                    <td>{{ $row->no_ktp }}</td>
                    <td>{{ $row->nama_customer }}</td>
                    <td>{{ $row->alamat_ktp }}</td>
                    <td>{{ $row->no_telp }}</td>
                    <td>{{ $row->no_hp }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>