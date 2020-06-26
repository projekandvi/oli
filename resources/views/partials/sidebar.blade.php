
<div id="page-sidebar" class="bg-gradient-1 font-inverse">
  <div class="scroll-sidebar">
        
    <ul id="sidebar-menu">
          
        <li class="no-menu" >
            <a href="/">
                <i class='fa fa-th'></i> 
                <span>Dashboard</span>
            </a>
        </li>

        
        @if (Auth::user()->status === 'administrator' || Auth::user()->status === 'DIRECTOR' || Auth::user()->status === 'BOTH OF DIRECTOR' || Auth::user()->status === 'OPERATIONAL MANAGER')
            <li class="no-menu">
                <a href="{{route('customer.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Customer</span>
                </a>
            </li>

            <li class="no-menu">
                <a href="/user"> 
                    <i class='fa fa-users'></i>
                    <span>User</span>
                </a>
            </li>
            
            <li class="no-menu">
                <a href="{{route('lead.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Lead</span>
                </a>
            </li>

            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Inventory</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Master Data</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="{{route('gudang.index')}}"> <i class='fa fa-cubes'></i> <span>Gudang</span></a></li>
                                    <li><a href="{{route('barang.index')}}"> <i class='fa fa-cubes'></i> <span>Barang</span></a></li>                                
                                </ul>
                            </div>
                        </li>                    
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Data Gudang</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    @foreach ($gudang as $row)
                                    <li><a href="/gudang/{{$row->id}}"> <i class='fa fa-cubes'></i> <span>{{$row->nama_gudang}}</span></a></li>
                                    @endforeach                               
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>

            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Slip Order</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Add New</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/orderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/orderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/orderJualPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Daftar SO</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/slipOrderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/slipOrderPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                 
                                </ul>
                            </div>
                        </li>                   
                    </ul>
                </div>
            </li>
            
            <li class="no-menu">
                <a href="{{route('delivery.index')}}"> <i class='fa fa-cubes'></i> <span>Delivery Order</span></a>
            </li> 

            <li class="no-menu">
                <a href="/dataManager"> <i class='fa fa-money'></i> <span>Data Penjualan</span> </a>
            </li>

            <li class="no-menu">
                <a href="{{route('akunting.index')}}"> <i class='fa fa-money'></i> <span>Akunting</span> </a>
            </li>

            <li class="no-menu">
                <a href="{{route('tiket.index')}}"> <i class='fa fa-photo'></i> <span>Tiket</span></a>
            </li>         
            
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Monitoring Teknisi</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="/instalasi"> <i class='fa fa-cubes'></i> <span>Instalasi Baru</span></a></li>
                        <li><a href="/maintenance"> <i class='fa fa-cubes'></i> <span>Maintenance Berkala</span></a></li>
                        <li><a href="{{route('teknisi.index')}}"> <i class='fa fa-cubes'></i> <span>Laporan Teknisi</span></a></li>
                    </ul>
                </div>
            </li>

            <li class="no-menu" >
                <a href="/maintenance"> <i class='fa fa-pie-chart'></i> <span>Monitoring Maintenance</span></a>
            </li>

            <li class="no-menu" >
                <a href="/setting_biaya_sewa"> <i class='fa fa-pie-chart'></i> <span>Setting Biaya Sewa</span></a>
            </li>

            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Recurring</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Collection</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring10"> <i class='fa fa-cubes'></i> <span>10 Th</span> </a> </li>
                                    <li><a href="/slipOrderSewaRecurring25"><i class='fa fa-cubes'></i> <span>25 Th</span></a> </li>                                
                                </ul>
                            </div>
                        </li>
                        <li><a href="/FaultDataRecurring"><i class='fa fa-cubes'></i> <span>Fault Data</span></a> </li>                                         
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Data</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="/dataTerpasang"> <i class='fa fa-cubes'></i> <span>Data Terpasang</span></a></li>
                        <li><a href="/dataTarikan"> <i class='fa fa-cubes'></i> <span>Data Tertarik</span></a></li>
                        <li><a href="{{route('gudang.index')}}"> <i class='fa fa-cubes'></i> <span>Data Blacklist</span></a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Panduan</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('gudang.index')}}"> <i class='fa fa-cubes'></i> <span>Panduan Pemasangan</span></a></li>
                        <li><a href="{{route('gudang.index')}}"> <i class='fa fa-cubes'></i> <span>Panduan Service</span></a></li>
                        <li><a href="{{route('gudang.index')}}"> <i class='fa fa-cubes'></i> <span>Panduan maintenance</span></a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Import Data</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="/getImportUser"> <i class='fa fa-cubes'></i> <span>Master User</span></a></li>
                        <li><a href="/getImportCustomer"> <i class='fa fa-cubes'></i> <span>Master Customer</span></a></li>
                        <li><a href="/getImportBarang"> <i class='fa fa-cubes'></i> <span>Master Barang</span></a></li>
                        <li><a href="/getImportTeknisi"> <i class='fa fa-cubes'></i> <span>Master Teknisi</span></a></li>
                        <li><a href="/getImportMasterBank"> <i class='fa fa-cubes'></i> <span>Master Bank</span></a></li>
                        <li><a href="/getImportSalesManager"> <i class='fa fa-cubes'></i> <span>Master Manajer Sales</span></a></li>
                        <li><a href="/getImportSales"> <i class='fa fa-cubes'></i> <span>Master Sales</span></a></li>
                        <li><a href="/getImportSO"> <i class='fa fa-cubes'></i> <span>Sales Order</span></a></li>
                        <li><a href="/getImportSODetail"> <i class='fa fa-cubes'></i> <span>Sales Order Detail</span></a></li>
                        <li><a href="/getImportPembayaran"> <i class='fa fa-cubes'></i> <span>Pembayaran</span></a></li>
                        <li><a href="/getImportInstalasi"> <i class='fa fa-cubes'></i> <span>Instalasi</span></a></li>
                        <li><a href="/getImportMaintenance"> <i class='fa fa-cubes'></i> <span>Maintenance</span></a></li>
                        <li><a href="/getImportLaporanTeknisi"> <i class='fa fa-cubes'></i> <span>Laporan Teknisi</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="no-menu" >
                <a href="/allData"> <i class='fa fa-pie-chart'></i> <span>All Data</span></a>
            </li>
        @elseif(Auth::user()->status === 'VICE PRESIDENT MARKETING')
            {{-- customer --}}
            <li class="no-menu">
                <a href="{{route('customer.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Customer</span>
                </a>
            </li>
            {{-- leads  --}}
            <li class="no-menu">
                <a href="{{route('lead.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Leads</span>
                </a>
            </li>
            {{-- slip order --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Slip Order</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Add New</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/orderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/orderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/orderJualPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Daftar SO</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/slipOrderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/slipOrderPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                 
                                </ul>
                            </div>
                        </li>                   
                    </ul>
                </div>
            </li>
            {{-- delivery order --}}
            <li class="no-menu">
                <a href="{{route('delivery.index')}}"> <i class='fa fa-cubes'></i> <span>Delivery Order</span></a>
            </li> 
            {{-- data penjualan --}}
            <li class="no-menu">
                <a href="/dataManager"> <i class='fa fa-money'></i> <span>Data Penjualan</span> </a>
            </li>         
            {{-- tiket --}}
            <li class="no-menu">
                <a href="{{route('tiket.index')}}"> <i class='fa fa-photo'></i> <span>Tiket</span></a>
            </li>         
            {{-- monitoring teknisi --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Monitoring Teknisi</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="/instalasi"> <i class='fa fa-cubes'></i> <span>Instalasi Baru</span></a></li>
                        <li><a href="/maintenance"> <i class='fa fa-cubes'></i> <span>Maintenance Berkala</span></a></li>
                        <li><a href="{{route('teknisi.index')}}"> <i class='fa fa-cubes'></i> <span>Laporan Teknisi</span></a></li>
                    </ul>
                </div>
            </li>
            {{-- monitoring maintenance --}}
            <li class="no-menu" >
                <a href="/maintenance"> <i class='fa fa-pie-chart'></i> <span>Monitoring Maintenance</span></a>
            </li>
            {{-- biaya sewa --}}
            <li class="no-menu" >
                <a href="/setting_biaya_sewa"> <i class='fa fa-pie-chart'></i> <span>Biaya Sewa</span></a>
            </li>
            
        @elseif(Auth::user()->status === 'HEAD ACCOUNTING' || Auth::user()->status === 'HEAD ADMIN FINANCE' || Auth::user()->status === 'STAFF ACCOUNTING')
            {{-- customer --}}
            <li class="no-menu">
                <a href="{{route('customer.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Customer</span>
                </a>
            </li>
            {{-- slip order --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Slip Order</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li class="no-menu">
                            <a href="/slipOrderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a>
                        </li>
                        <li class="no-menu">
                            <a href="/slipOrderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a>
                        </li>
                        <li class="no-menu">
                            <a href="/slipOrderPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- data penjualan --}}
            <li class="no-menu">
                <a href="/dataManager"> <i class='fa fa-money'></i> <span>Data Penjualan</span> </a>
            </li>
            {{-- akunting --}}
            <li class="no-menu">
                <a href="{{route('akunting.index')}}"> <i class='fa fa-money'></i> <span>Akunting</span> </a>
            </li>
            {{-- biaya sewa --}}
            <li class="no-menu" >
                <a href="/setting_biaya_sewa"> <i class='fa fa-pie-chart'></i> <span>Biaya Sewa</span></a>
            </li>
            {{-- recurring --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Recurring</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Collection</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring10"> <i class='fa fa-cubes'></i> <span>10 Th</span> </a> </li>
                                    <li><a href="/slipOrderSewaRecurring25"><i class='fa fa-cubes'></i> <span>25 Th</span></a> </li>                                
                                </ul>
                            </div>
                        </li>
                        <li><a href="/FaultDataRecurring"><i class='fa fa-cubes'></i> <span>Fault Data</span></a> </li>                                         
                    </ul>
                </div>
            </li>
        @elseif(Auth::user()->status === 'HEAD CUSTOMER SERVICE' || Auth::user()->status === 'SPV CUSTOMER SERVICE' || Auth::user()->status === 'STAFF CUSTOMER SERVICE' || Auth::user()->status === 'STAFF ADMIN' )
            {{-- customer --}}
            <li class="no-menu">
                <a href="{{route('customer.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Customer</span>
                </a>
            </li>
            {{-- leads             --}}
            <li class="no-menu">
                <a href="{{route('lead.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Leads</span>
                </a>
            </li>
            {{-- Inventory --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Inventory</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Master Data</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="{{route('gudang.index')}}"> <i class='fa fa-cubes'></i> <span>Gudang</span></a></li>
                                    <li><a href="{{route('barang.index')}}"> <i class='fa fa-cubes'></i> <span>Barang</span></a></li>                                
                                </ul>
                            </div>
                        </li>                    
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Data Gudang</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    @foreach ($gudang as $row)
                                    <li><a href="/gudang/{{$row->id}}"> <i class='fa fa-cubes'></i> <span>{{$row->nama_gudang}}</span></a></li>
                                    @endforeach                               
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- slip order --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Slip Order</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Add New</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/orderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/orderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/orderJualPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Daftar SO</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/slipOrderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/slipOrderPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                 
                                </ul>
                            </div>
                        </li>                   
                    </ul>
                </div>
            </li>
            {{-- delivery order --}}
            <li class="no-menu">
                <a href="{{route('delivery.index')}}"> <i class='fa fa-cubes'></i> <span>Delivery Order</span></a>
            </li> 
            {{-- tiket --}}
            <li class="no-menu">
                <a href="{{route('tiket.index')}}"> <i class='fa fa-photo'></i> <span>Tiket</span></a>
            </li>         
            {{-- monitoring instalasi --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Monitoring Teknisi</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="/instalasi"> <i class='fa fa-cubes'></i> <span>Instalasi Baru</span></a></li>
                        <li><a href="/maintenance"> <i class='fa fa-cubes'></i> <span>Maintenance Berkala</span></a></li>
                        <li><a href="{{route('teknisi.index')}}"> <i class='fa fa-cubes'></i> <span>Laporan Teknisi</span></a></li>
                    </ul>
                </div>
            </li>
            {{-- monitoring maintenance --}}
            <li class="no-menu" >
                <a href="/maintenance"> <i class='fa fa-pie-chart'></i> <span>Monitoring Maintenance</span></a>
            </li>
            {{-- biaya sewa --}}
            <li class="no-menu" >
                <a href="/setting_biaya_sewa"> <i class='fa fa-pie-chart'></i> <span>Biaya Sewa</span></a>
            </li>
            {{-- recurring --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Recurring</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Collection</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring10"> <i class='fa fa-cubes'></i> <span>10 Th</span> </a> </li>
                                    <li><a href="/slipOrderSewaRecurring25"><i class='fa fa-cubes'></i> <span>25 Th</span></a> </li>                                
                                </ul>
                            </div>
                        </li>
                        <li><a href="/FaultDataRecurring"><i class='fa fa-cubes'></i> <span>Fault Data</span></a> </li>                                         
                    </ul>
                </div>
            </li>
        @elseif(Auth::user()->status === 'GENERAL MANAGER MARKETING' || Auth::user()->status === 'AGENCY')
            {{-- customer --}}
            <li class="no-menu">
                <a href="{{route('customer.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Customer</span>
                </a>
            </li>
            {{-- leads                         --}}
            <li class="no-menu">
                <a href="{{route('lead.index')}}"> 
                    <i class='fa fa-users'></i>
                    <span>Leads</span>
                </a>
            </li>
            {{-- slip order --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Slip Order</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Add New</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/orderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/orderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/orderJualPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Daftar SO</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring"> <i class='fa fa-cubes'></i> <span>Sewa Recurring</span></a></li>
                                    <li><a href="/slipOrderSewaPeriode"> <i class='fa fa-cubes'></i> <span>Sewa Periode</span></a></li>                                
                                    <li><a href="/slipOrderPutus"> <i class='fa fa-cubes'></i> <span>Jual Putus</span></a></li>                                 
                                </ul>
                            </div>
                        </li>                   
                    </ul>
                </div>
            </li>
            {{-- delivery order --}}
            <li class="no-menu">
                <a href="{{route('delivery.index')}}"> <i class='fa fa-cubes'></i> <span>Delivery Order</span></a>
            </li> 
            {{-- data penjualan --}}
            <li class="no-menu">
                <a href="/dataManager"> <i class='fa fa-money'></i> <span>Data Penjualan</span> </a>
            </li>
            {{-- tiket --}}
            <li class="no-menu">
                <a href="{{route('tiket.index')}}"> <i class='fa fa-photo'></i> <span>Tiket</span></a>
            </li>         
            {{-- monitoring teknisi --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Monitoring Teknisi</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="/instalasi"> <i class='fa fa-cubes'></i> <span>Instalasi Baru</span></a></li>
                        <li><a href="/maintenance"> <i class='fa fa-cubes'></i> <span>Maintenance Berkala</span></a></li>
                        <li><a href="{{route('teknisi.index')}}"> <i class='fa fa-cubes'></i> <span>Laporan Teknisi</span></a></li>
                    </ul>
                </div>
            </li>
            {{-- biaya sewa --}}
            <li class="no-menu" >
                <a href="/setting_biaya_sewa"> <i class='fa fa-pie-chart'></i> <span>Biaya Sewa</span></a>
            </li>
            {{-- recurring --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Recurring</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Collection</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li><a href="/slipOrderSewaRecurring10"> <i class='fa fa-cubes'></i> <span>10 Th</span> </a> </li>
                                    <li><a href="/slipOrderSewaRecurring25"><i class='fa fa-cubes'></i> <span>25 Th</span></a> </li>                                
                                </ul>
                            </div>
                        </li>
                        <li><a href="/FaultDataRecurring"><i class='fa fa-cubes'></i> <span>Fault Data</span></a> </li>                                         
                    </ul>
                </div>
            </li>
        @elseif(Auth::user()->status === 'STAFF WAREHOUSE')
            {{-- Inventory --}}
            <li>
                <a href="#"><i class='fa fa-cubes'></i> <span>Inventory</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li>
                            <a href="#"><i class='fa fa-cubes'></i> <span>Data Gudang</span></a>
                            <div class="sidebar-submenu">
                                <ul>
                                    @foreach ($gudang as $row)
                                    <li><a href="/gudang/{{$row->id}}"> <i class='fa fa-cubes'></i> <span>{{$row->nama_gudang}}</span></a></li>
                                    @endforeach                               
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- delivery order --}}
            <li class="no-menu">
                <a href="{{route('delivery.index')}}"> <i class='fa fa-cubes'></i> <span>Delivery Order</span></a>
            </li>   
        @elseif(Auth::user()->status === 'Head Teknisi' || Auth::user()->status === 'Spv. Teknisi' || Auth::user()->status === 'Teknisi')           
            <li class="no-menu">
                <a href="{{route('teknisi.index')}}"> <i class='fa fa-cubes'></i> <span>Laporan Teknisi</span></a>
            </li>
        @endif
        
       
    </ul><!-- #sidebar-menu -->
  </div>
</div>

