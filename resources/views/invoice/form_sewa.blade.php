<form action="/slipOrder/new" enctype="multipart/form-data" method="POST" id="buat_invoice_sewa">
    @csrf
    <input type="hidden" name="id_staf" value="{{Auth::user()->id}}" />				
    <input type="hidden" name="status_barang" value="Tersewa" />
    <input type="hidden" class="form-control" name="tipe_penjualan" value="Sewa" />				
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
                                                            
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label>Nama Pembeli</label>                           
                        <select name="id_customer" id="customer_id2" class="form-control" width="100%">
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
                <div class="col-md-12">
                    <div class="row">
                        {{-- <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Nominal Pembayaran</label>                           
                                <input type="number" class="form-control" name="jumlah">
                            </div>
                            <div class="col-md-12">
                                <label>Metode Pembayaran</label>                           
                                <select name="metode_pembayaran" id="colorselector" class="form-control">
                                  <option>-- Metode Pembayaran --</option>
                                  <option value="visa">Kartu Kredit Visa</option>
                                  <option value="master">Kartu Kredit Master Card </option>
                                  <option value="kartu_kredit">Kartu Debit </option>
                                  <option value="tunai">Tunai</option>
                                </select>                                
                            </div>
                            <div class="col-md-12">
                                <label>Jenis Bank</label>                           
                                <select name="jenis_bank" class="form-control">
                                    <option value="-">-- Bank List --</option>
                                    <option value="Bank BCA">Bank BCA</option>
                                    <option value="Bank Mandiri">Bank Mandiri</option>
                                </select>
                            </div>
                        </div> --}}
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
                        {{-- <div class="col-md-6">
                            <div class="col-md-12">
                                <label>Catatan</label>                           
                                <textarea name="catatan" class="form-control" id="" cols="30" rows="3"></textarea>
                            </div>                                
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div> 
{{-- {{ Form::close() }} --}}
    </form>
  {{-- isi tab pertama end --}}

<hr>
{{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}
<div class="row">
    <div class="col-md-4">
        <div class="col-lg-12">
            <h2>ADD ITEM</h2>
            <div class="form-group form-group-sm">
                <label>Pilih Barang</label>
                {{-- <input v-model="item.id" class="form-control" placeholder="Id"> --}}
                <select id="barang_id2" class="form-control" v-model="item.id_barang">
                  <option value="">Pilih</option>
                  @foreach ($barangs as $barang)
                  <option value="{{ $barang->id_barang }}">{{ $barang->nama_barang }} - Kode Barang : {{ $barang->kode_barang }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group form-group-sm">
                <label>Kode Barang</label>
                <input v-model="item.kode_barang" class="form-control" value="">
            </div>
            <div class="form-group form-group-sm">
                <label>Nama Barang</label>
                <input v-model="item.nama_barang" class="form-control" value="">
            </div>
            <div class="form-group form-group-sm">
                <label>Harga</label>
                <input v-model="item.harga" class="form-control" value="">
            </div>
            <div class="form-group form-group-sm">
                <label>Qty</label>
                <input v-model="item.qty" class="form-control" value="">
            </div>
            <button v-on:click="addItem()" class="btn btn-primary">Add Item</button>
        </div>
    </div>
    <div class="col-md-8">
        <h2>CART</h2>
                <table class="table table-bordered">
                  <thead class="bg-gradient-1">
                    <td class="text-center font-white">ID</td>
                    <td class="text-center font-white">Name</td>
                    <td class="text-center font-white">Qty</td>
                    <td class="text-center font-white">Price</td>
                    <td class="text-center font-white">Action</td>
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
                      <td>@{{ 'Rp. ' + details.sub_total.toFixed(2) }} </td>
                  </tr>
                  <tr>
                      <td>Total:</td>
                      <td>@{{ 'Rp. ' + details.total.toFixed(2) }} </td>
                  </tr>
              </table>
    </div>
</div>

{{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}
<div class="bg-default content-box text-center pad20A mrg25T">
    {{-- <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()"> --}}
    <a class="btn btn-lg btn-primary" onclick="event.preventDefault();  document.getElementById('buat_invoice_sewa').submit();"> Save</a>        
</div>