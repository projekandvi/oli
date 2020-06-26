@extends('app')

@section('contentheader')
  @if($invoice->id_invoice)
      {{trans('core.editing')}} <b>{{$invoice->id_invoice}}</b>
  @else
      add new Slip Order
  @endif
@stop

@section('breadcrumb')
  Add Slip Order
@stop

@section('main-content')
<style>
.output {
  margin: 0 auto;
  /* padding: 1em;  */
}
.colors {
  /* padding: 2em; */
  /* color: #fff; */
  display: none;
}

.debit_output {
  margin: 0 auto;
  /* padding: 1em;  */
}
.debit_colors {
  /* padding: 2em; */
  /* color: #fff; */
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
            <a href="#beli_putus" data-toggle="tab">Beli Putus</a>
          </li>
          <li>
            <a href="#sewa" data-toggle="tab">Sewa</a>
          </li>
        </ul>
        {{-- tab title end --}}

        <div class="tab-content">
          {{-- tab pertama start --}}
          <div class="active tab-pane" id="beli_putus">
          {{-- isi tab pertama start --}}
            {{-- {!! Form::model($invoice, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!} --}}
              <input type="hidden" name="id_staf" value="{{Auth::user()->id}}" />				
                <input type="hidden" name="status_barang" value="Terbeli" />				
                  <div class="row">
                    <div class="col-md-6"></div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-sm-6">Nomor Slip Order<span class="required">*</span></label>
                            <div class="col-sm-6">
                              @if ($invoice->id_invoice === null)
                              <input type="text" class="form-control" name="id_invoice" value="{{$nomor_otomatis}}" />
                              @else
                              <input type="text" class="form-control" name="id_invoice" value="{{$invoice->id_invoice}}" />
                              @endif            
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">	
                          <label>Tanggal</label>                           
                          @if ($invoice->tanggal === null)
                          <input type="text" class="form-control" name="tanggal" value="{{$tanggal_otomatis}}" />
                          @else
                          <input type="date" class="form-control" name="tanggal" value="{{$invoice->tanggal}}" />
                          @endif
                        </div>
                        <div class="col-md-6">	
                          <label>Team</label>                           
                          {{-- <input type="text" class="form-control" placeholder="team" name="team" value="{{$invoice->team}}" /> --}}
                          <select name="team" class="form-control">
                            <option value="JIMIN">JIMIN</option>
                            <option value="CAHYADI">CAHYADI</option>
                            <option value="STEVEN">STEVEN</option>
                            <option value="HERMAWAN">HERMAWAN</option>
                          </select>
                        </div>
                      </div>
                          
                      <div class="row">
                        <div class="col-md-6">	
                          <label>Nama Seller</label>                           
                          {{-- <input type="text" class="form-control" placeholder="nama seller" name="nama_seller" value="{{$invoice->nama_seller}}" /> --}}
                          <select name="nama_seller" class="form-control">
                            <option value="DEDE">DEDE</option>
                            <option value="SISKA A">SISKA A</option>
                            <option value="OKTARIANSYAH">OKTARIANSYAH</option>
                            <option value="RUSLI">RUSLI</option>
                            <option value="ROBI">ROBI</option>
                          </select>
                        </div>
                        <div class="col-md-6">	
                          <label>Location</label>                           
                          <input type="text" class="form-control" placeholder="lokasi" name="lokasi_penjualan" value="{{$invoice->lokasi_penjualan}}" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">	
                          <label>CRC Code</label>                           
                          @if ($invoice->crc_code === null)
                          <input type="text" class="form-control" name="crc_code" v-model="product.crc_code" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="crc code" name="crc_code" value="{{$invoice->crc_code}}" />
                          @endif
                        </div>
                        <div class="col-md-6">	
                          <label>LA Code</label>                           
                          @if ($invoice->la_code === null)
                          <input type="text" class="form-control" name="la_code" v-model="product.la_code" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="la code" name="la_code" value="{{$invoice->la_code}}" />
                          @endif
                        </div>
                      </div>

                      
                          
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Nama Pembeli</label>                           
                          <select name="id_customer" id="product_id" class="form-control" width="100%">
                            <option value="">Pilih</option>
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->nama_customer }} - NIK : {{ $customer->no_ktp }}</option>
                            @endforeach
                          </select>
                          <input type="hidden" class="form-control" name="nama_customer" v-model="product.nama_customer" value="" />
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>No. KTP</label>                           
                          @if ($invoice->no_ktp === null)
                          <input type="text" class="form-control" name="no_ktp" v-model="product.no_ktp" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="no ktp" name="no_ktp" value="{{$invoice->no_ktp}}" />
                          @endif
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>Alamat KTP</label>                           
                            @if ($invoice->alamat_ktp === null)
                            <input type="text" class="form-control"  name="alamat_ktp" v-model="product.alamat" value="" />
                            @else
                            <input type="text" class="form-control" placeholder="alamat ktp" name="alamat_ktp" value="{{$invoice->alamat_ktp}}" />
                            @endif
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>Alamat Pemasangan</label>                           
                          @if ($invoice->alamat_pemasangan === null)
                          <input type="text" class="form-control" name="alamat_pemasangan" v-model="product.alamat_pemasangan" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="alamat pemasangan" name="alamat_pemasangan" value="{{$invoice->alamat_pemasangan}}" />
                          @endif
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>No. Telp</label>                           
                          @if ($invoice->no_telp === null)
                          <input type="text" class="form-control" name="no_telp" v-model="product.no_telp" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="no telp" name="no_telp" value="{{$invoice->no_telp}}" />
                          @endif 
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>No. HP.</label>                           
                          @if ($invoice->no_hp === null)
                          <input type="text" class="form-control" name="no_hp" v-model="product.no_hp" value="" />
                          @else
                          <input type="text" class="form-control" placeholder="no telp" name="no_hp" value="{{$invoice->no_hp}}" />
                          @endif   
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>Email</label>                           
                            @if ($invoice->email === null)
                            <input type="text" class="form-control" name="email" v-model="product.email" value="" />
                            @else
                            <input type="text" class="form-control" placeholder="Email" name="email" value="{{$invoice->email}}" />
                            @endif    
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <label>Tempat Tinggal</label>                           
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" value="Milik Sendiri" name="milik_tempat_tinggal">
                            <label class="form-check-label" for="exampleCheck1">Milik Sendiri</label> &nbsp;
                            <input type="checkbox" class="form-check-input" value="Sewa" name="milik_tempat_tinggal">
                            <label class="form-check-label" for="exampleCheck1">Sewa</label>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                    <br />
                      <table class="table table-bordered">
                        <thead class="bg-gradient-1">
                          <td class="text-center font-white" width="30%">Lokasi Stok</td>
                          <td class="text-center font-white" width="30%">Item Barang</td>
                          <td class="text-center font-white" width="30%">Harga</td>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <select name="lokasi_barang" class="form-control" style="width:250px">
                                <option value="">--- Pilihan Lokasi ---</option>
                                @foreach ($lokasi as $key => $value)
                                  <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                              </select>
                            </td>

                            <td class="text-center">
                                <select name="id_barang" id="barang_id" class="form-control">
                                  <option value="">Pilih</option>
                                  @foreach ($barangs as $barang)
                                  <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} - Kode Barang : {{ $barang->kode_barang }}</option>
                                  @endforeach
                              </select>


                               {{-- sebelum revisi        --}}
                              {{-- <select name="id_barang" id="barang_id" class="form-control"style="width:250px">
                                <option>-- Nama Barang--</option>
                              </select> --}}

                            </td>
                            <td class="text-center">
                              @{{ barang.harga | currency }}
                              @if ($invoice->harga === null)
                              <input type="hidden" class="form-control" name="harga" v-model="barang.harga" value="" />
                              @else
                              <input type="text" class="form-control" placeholder="harga" name="harga"  value="{{$invoice->harga}}" />
                              @endif 

                              @if ($invoice->tipe_penjualan === null)
                              <input type="hidden" class="form-control" name="tipe_penjualan" value="Beli Putus" />
                              @else
                              <input type="hidden" class="form-control" name="tipe_penjualan"  value="{{$invoice->tipe_penjualan}}" />
                              @endif 
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      {{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}
                      <div class="row" id="app">
                        <div class="container cart">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2>ADD ITEM</h2>
                                            <p>(This is using custom database storage)</p>
                                            <div class="form-group form-group-sm">
                                                <label>ID</label>
                                                <input v-model="item.id" class="form-control" placeholder="Id">
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label>Name</label>
                                                <input v-model="item.name" class="form-control" placeholder="Name">
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label>Price</label>
                                                <input v-model="item.price" class="form-control" placeholder="Price">
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label>Qty</label>
                                                <input v-model="item.qty" class="form-control" placeholder="Quantity">
                                            </div>
                                            <button v-on:click="addItem()" class="btn btn-primary">Add Item</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <h2>CART</h2>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="item in items">
                                            <td>@{{ item.id }}</td>
                                            <td>@{{ item.name }}</td>
                                            <td>@{{ item.quantity }}</td>
                                            <td>@{{ item.price }}</td>
                                            <td>
                                                <button v-on:click="removeItem(item.id)" class="btn btn-sm btn-danger">remove</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <table class="table">
                                        <tr>
                                            <td>Items on Cart:</td>
                                            <td>@{{itemCount}}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Qty:</td>
                                            <td>@{{ details.total_quantity }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sub Total:</td>
                                            <td>@{{ '$' + details.sub_total.toFixed(2) }} </td>
                                        </tr>
                                        <tr>
                                            <td>Total:</td>
                                            <td>@{{ '$' + details.total.toFixed(2) }} </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                      {{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}

                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Total Tagihan</label>                           
                              <label class="form-control">@{{ (barang.harga) | currency }}</label>
                            </div>
                            <div class="col-md-12">
                              <label>Sisa</label>                           
                              <input type="nunmber" class="form-control" v-model="barang.harga - barang.sisa" value="" disabled="true">
                            </div>
                            <div class="col-md-12">
                              <label>Pelunasan</label>
                              <div v-if="(barang.harga - barang.sisa) <= 0">
                                <label class="form-control">Lunas</label>
                                <input type="hidden" name="status_pelunasan" value="Lunas">
                              </div>
                              <div v-else>
                                <label class="form-control">Belum Lunas</label>
                                <input type="hidden" name="status_pelunasan" value="Belum Lunas">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="col-md-12">
                                <input type="hidden" name="kategori"  value="jual putus">
                                  <label>Pembayaran</label>                           
                                    <select id="colorselector" class="form-control">
                                      <option>-- Metode Pembayaran --</option>
                                      <option value="kartu_kredit">Kartu Kredit </option>
                                      <option value="kartu_debit">Kartu Debit</option>
                                    </select>
                              </div>

                              <div class="colors" id="kartu_kredit">
                                <div class="col-md-12 output">
                                  <label>Nomor Kartu</label>                           
                                  <input type="number" name="nomor_kartu" class="form-control" onKeyPress="if(this.value.length==16) return false;" >
                                </div>
                                <div class="col-md-12 output">
                                  <label>Masa Kartu Expired</label>                           
                                  <input type="number" name="masa_kartu_expired" class="form-control" onKeyPress="if(this.value.length==4) return false;" >
                                </div>                                  
                                <div class="col-md-12 output">
                                  <label></label>   
                                  <select name="metode_pembayaran" class="form-control">
                                    <option>-- Jenis Kartu Kredit --</option>
                                    <option value="visa">Visa</option>
                                    <option value="Master Card">master card</option>
                                  </select>
                                </div>

                                <div class="col-md-12 output">
                                  <label>Jenis Bank</label>                           
                                  <select name="jenis_bank" class="form-control">
                                    <option value="Bank BCA">Bank BCA</option>
                                    <option value="Bank Mandiri">Bank Mandiri</option>
                                  </select>
                                </div>

                                <div class="col-md-12 output">
                                  <label></label>   
                                  <select name="cicilan" class="form-control">
                                    <option>-- Cicilan --</option>
                                    <option value="3 bulan">3 bulan</option>
                                    <option value="6 bulan">6 bulan</option>
                                    <option value="12 bulan">12 bulan </option>
                                    <option value="24 bulan">24 bulan</option>
                                  </select>
                                </div>
                                <div class="col-md-12 output">
                                  <label>Pembayaran</label>                           
                                  <input type="number" class="form-control" name="jumlah" v-model="barang.sisa">
                                </div>
                              </div>


                          <div class="debit_colors" id="kartu_debit">
                            <div class="col-md-12 debit_output">
                              <label>Jenis Bank</label>                           
                              <select name="jenis_bank" class="form-control">
                                <option value="Bank BCA">Bank BCA</option>
                                <option value="Bank Mandiri">Bank Mandiri</option>
                              </select>
                            </div>                              
                            <div class="col-md-12 debit_output">
                              <label>Pembayaran</label>                           
                              <input type="number" class="form-control" name="jumlah" v-model="barang.sisa">
                            </div>
                          </div>                              
                        </div>
                        <div class="col-md-6">
                          <div class="col-md-12">
                            <label>Catatan</label>                           
                            <textarea name="catatan" class="form-control" id="" cols="30" rows="3"></textarea>
                          </div>                                
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-default content-box text-center pad20A mrg25T">
                <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
              </div>
                
            {{-- {{ Form::close() }} --}}
              {{-- isi tab pertama end --}}
        </div><!-- /.tab-pane beli putus-->
          {{-- tab pertama end --}}
          
        {{-- tab kedua start   --}}
        <div class="tab-pane" id="sewa">           
          {{-- isi tab kedua start --}}
            {!! Form::model($invoice, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}
              <input type="hidden" class="form-control" placeholder="id staf" name="id_staf" value="{{Auth::user()->id}}" />	
              <input type="hidden" name="status_barang" value="Tersewa" />			
              <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label col-sm-6">Nomor Slip Order<span class="required">*</span></label>
                    <div class="col-sm-6">
                      @if ($invoice->id_invoice === null)
                      <input type="text" class="form-control" name="id_invoice" value="{{$nomor_otomatis}}" />
                      @else
                      <input type="text" class="form-control" name="id_invoice" value="{{$invoice->id_invoice}}" />
                      @endif            
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">	
                      <label>Tanggal</label>                           
                      @if ($invoice->tanggal === null)
                      <input type="text" class="form-control" name="tanggal" value="{{$tanggal_otomatis}}" />
                      @else
                      <input type="date" class="form-control" name="tanggal" value="{{$invoice->tanggal}}" />
                      @endif
                    </div>
                    <div class="col-md-6">	
                      <label>Team</label>                           
                      <select name="team" class="form-control">
                        <option value="JIMIN">JIMIN</option>
                        <option value="CAHYADI">CAHYADI</option>
                        <option value="STEVEN">STEVEN</option>
                        <option value="HERMAWAN">HERMAWAN</option>
                      </select>                                    
                    </div>
                  </div>                                
                  <div class="row">
                    <div class="col-md-6">	
                      <label>Nama Seller</label>                           
                      <select name="nama_seller" class="form-control">
                        <option value="DEDE">DEDE</option>
                        <option value="SISKA A">SISKA A</option>
                        <option value="OKTARIANSYAH">OKTARIANSYAH</option>
                        <option value="RUSLI">RUSLI</option>
                        <option value="ROBI">ROBI</option>
                      </select>
                    </div>
                    <div class="col-md-6">	
                      <label>Location</label>                           
                      <input type="text" class="form-control" placeholder="lokasi" name="lokasi_penjualan" value="{{$invoice->lokasi_penjualan}}" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">	
                      <label>CRC Code</label>                           
                      @if ($invoice->crc_code === null)
                      <input type="text" class="form-control" name="crc_code" v-model="customer2.crc_code" value="" />
                      @else
                      <input type="text" class="form-control" placeholder="crc code" name="crc_code" value="{{$invoice->crc_code}}" />
                      @endif
                    </div>
                    <div class="col-md-6">	
                      <label>LA Code</label>                           
                      @if ($invoice->la_code === null)
                      <input type="text" class="form-control" name="la_code" v-model="customer2.la_code" value="" />
                      @else
                      <input type="text" class="form-control" placeholder="la code" name="la_code" value="{{$invoice->la_code}}" />
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <br />
                      <table class="table table-bordered">
                        <thead class="bg-gradient-1">
                          <td class="text-center font-white">Lokasi Barang</td>
                          <td class="text-center font-white">Nama Barang</td>
                          <td class="text-center font-white">Periode Sewa</td>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">
                              <select name="lokasi_barang" class="form-control" style="width:250px">
                                <option value="">--- Pilihan Lokasi ---</option>
                                @foreach ($lokasi as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                              </select>
                            </td>
                            <td class="text-center">
                              <select name="id_barang" id="barang_sewa_id" class="form-control"style="width:250px">
                                <option>-- Nama Barang--</option>
                              </select>
                            </td>
                            <td class="text-center">
                              <select name="periode_sewa" class="form-control">
                                  <option value="1">1 Tahun</option>
                                  <option value="2">2 Tahun</option>
                                </select>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>                                
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Nama Pembeli</label>                           
                      <select name="id_customer" id="customer_id2" class="form-control" required width="100%">
                        <option value="">Pilih</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->nama_customer }} - NIK : {{ $customer->no_ktp }}</option>
                        @endforeach
                      </select>
                      <input type="hidden" class="form-control" name="nama_customer" v-model="customer2.nama_customer" value="" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. KTP</label>                           
                        @if ($invoice->no_ktp === null)
                        <input type="text" class="form-control" name="no_ktp" v-model="customer2.no_ktp" value="" />
                        @else
                        <input type="text" class="form-control" placeholder="no ktp" name="no_ktp" value="{{$invoice->no_ktp}}" />
                        @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Alamat KTP</label>                           
                        @if ($invoice->alamat_ktp === null)
                        <input type="text" class="form-control"  name="alamat_ktp" v-model="customer2.alamat" value="" />
                        @else
                        <input type="text" class="form-control" placeholder="alamat ktp" name="alamat_ktp" value="{{$invoice->alamat_ktp}}" />
                        @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Alamat Pemasangan</label>                           
                      @if ($invoice->alamat_pemasangan === null)
                      <input type="text" class="form-control" name="alamat_pemasangan" v-model="customer2.alamat_pemasangan" value="" />
                      @else
                      <input type="text" class="form-control" placeholder="alamat pemasangan" name="alamat_pemasangan" value="{{$invoice->alamat_pemasangan}}" />
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. Telp</label>                           
                      @if ($invoice->no_telp === null)
                      <input type="text" class="form-control" name="no_telp" v-model="customer2.no_telp" value="" />
                      @else
                      <input type="text" class="form-control" placeholder="no telp" name="no_telp" value="{{$invoice->no_telp}}" />
                      @endif 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>No. HP.</label>                           
                      @if ($invoice->no_hp === null)
                      <input type="text" class="form-control" name="no_hp" v-model="customer2.no_hp" value="" />
                      @else
                      <input type="text" class="form-control" placeholder="no telp" name="no_hp" value="{{$invoice->no_hp}}" />
                      @endif   
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Email</label>                           
                      @if ($invoice->email === null)
                      <input type="text" class="form-control" name="email" v-model="customer2.email" value="" />
                      @else
                      <input type="text" class="form-control" placeholder="Email" name="email" value="{{$invoice->email}}" />
                      @endif    
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Tempat Tinggal</label>                           
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" value="Milik Sendiri" name="milik_tempat_tinggal">
                        <label class="form-check-label" for="exampleCheck1">Milik Sendiri</label> &nbsp;
                        <input type="checkbox" class="form-check-input" value="Sewa" name="milik_tempat_tinggal">
                        <label class="form-check-label" for="exampleCheck1">Sewa</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>                     
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <input type="hidden" name="kategori"  value="recurring">
                        <div class="col-md-12">
                          <label>Pembayaran</label>                           
                          <select name="metode_pembayaran" class="form-control">
                            <option value="Visa">Visa</option>
                            <option value="Master Card">Master Card</option>
                            <option value="Kartu Kredit">Kartu Kredit</option>
                            <option value="Tunai">Tunai</option>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <label>Jenis Bank</label>                           
                          <select name="jenis_bank" class="form-control">
                            <option value="Bank BCA">Bank BCA</option>
                            <option value="Bank Mandiri">Bank Mandiri</option>
                          </select>
                        </div>
                        <div class="col-md-12">
                          <label>Nominal Pembayaran</label>                           
                          <input type="text" class="form-control" name="jumlah"  value="600000">
                          <input type="hidden" name="status_pelunasan" value="Sewaan">
                        </div>
                      </div>                               
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-12">
                          <label>Nama Pemilik Kartu</label>                           
                          <input type="text" name="nama_pemilik_kartu_recurring" class="form-control" v-model="customer2.nama_pemilik_kartu" value="">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Jenis Bank</label>                           
                              <select name="jenis_bank" class="form-control">
                                <option value="Bank BCA">Bank BCA</option>
                                <option value="Bank Mandiri">Bank Mandiri</option>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <label>Jenis kartu Kredit</label>                           
                              <select name="jenis_kartu_kredit_recurring" class="form-control">
                                <option value="Visa">Visa</option>
                                <option value="Master Card">Master Card</option>
                                <option value="JCB">JCB</option>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <label>Nomor Kartu</label>                           
                              <input type="number" name="nomor_kartu_expired_recurring" class="form-control" onKeyPress="if(this.value.length==16) return false;" >
                            </div>
                            <div class="col-md-12">
                              <label>Nominal Debit</label>                           
                              <input type="text" class="form-control" name="nominal_debit_recurring"  value="600000">
                            </div>
                          </div>                                          
                        </div>
                        <div class="col-md-6">
                          <div class="row">
                            <div class="col-md-12">
                              <label>Tanggal Debit</label>                           
                              <select name="tanggal_debit_recurring" class="form-control">
                                <option value="10">Tanggal 10</option>
                                <option value="25">Tanggal 25</option>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <label>Masa Kartu Expired</label>                           
                              <input type="number" name="masa_kartu_expired_recurring" class="form-control" onKeyPress="if(this.value.length==4) return false;" >
                            </div>
                            <div class="col-md-12">
                                <label>Catatan</label>                           
                                <textarea name="" class="form-control" id="" cols="30" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-default content-box text-center pad20A mrg25T">
                <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
              </div>                 
            {{ Form::close() }}
          {{-- isi tab kedua end --}}                 
        </div><!-- /.tab-pane sewa-->
        {{-- tab kedua end --}}  
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