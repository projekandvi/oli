    
<script>  window.Laravel = {!! json_encode(['csrfToken' => csrf_token() ]); !!}  </script>        
    <!-- Javascripts -->

<script>
    // function fungsiPeriode() {
    // if ((document.getElementById("pilihanPeriode").value) == "3 bulan") {
    //     document.getElementsByName("nominal_pembayaran")[0].value = "1800000";
    //     document.getElementsByName("nominal_pembayaran")[0].setAttribute( 'class', 'uang form-control' );
    //     } else  if ((document.getElementById("pilihanPeriode").value) == "6 bulan") {
    //     document.getElementsByName("nominal_pembayaran")[0].value = "3600000";
    //     }
    //     else  if ((document.getElementById("pilihanPeriode").value) == "12 bulan") {
    //     document.getElementsByName("nominal_pembayaran")[0].value = "7200000";
    //     }
    // }

    function munculBank() {
        var element = document.getElementById("pilihanMetodePembayaran");
        if (element.value == "visa") {
            document.getElementById('tampil').style.display = 'block';
            document.getElementById('nom').style.display = 'block';
        } else  if (element.value == "master") {
            document.getElementById('tampil').style.display = 'block';
            document.getElementById('nom').style.display = 'block';
        }
        else  if (element.value == "kartu_debit") {
            document.getElementById('tampil').style.display = 'block';
            document.getElementById('nom').style.display = 'block';
        }
        else  if (element.value == "tunai") {
            document.getElementById('tampil').style.display = 'none';
            document.getElementById('nom').style.display = 'block';
        }
        else  if (element.value == "jcb") {
            document.getElementById('tampil').style.display = 'none';
            document.getElementById('nom').style.display = 'block';
        }
    }

       
</script>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
<script src="{{ asset('/assets/js-core/slimscroll.js') }}"></script>
<script src="{{ asset('/assets/js-core/screenfull.js') }}"></script>
<script defer src="{{ asset('/build/app.b81f4459eb1b0cdac4d5.js') }}"></script>
<script src="{{ asset('/assets/js-core/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/assets/js-core/highcharts.js') }}"></script>
<script src="{{ asset('/assets/js-core/exporting.js') }}"></script>   

<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
</script>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>     

<script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script>

        
<script src="https://unpkg.com/vue"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.3.1/vue-resource.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    function submitted () {
        document.getElementById('submitButton').disabled=true;
        document.getElementById('submitButton').value='Submitting, please wait...';
        document.getElementById("ism_form").submit();
    }        
</script>    

{{-- vue js --}}
<script>
    (function($) {
        var _token = '<?php echo csrf_token() ?>';
        Vue.filter('currency', function(money) { return accounting.formatMoney(money, "Rp ", 2, ".", ",")})

        $(document).ready(function() {
            var form_pertama = new Vue({
                    el: '#dw',
                    data: {
                        datapapa: {{$biaya_sewa->biaya_sewa}},                         
                        papa: '',                         
                        daftar_bank: '',                         
                        daftarBank: [],
                        metode_pembayaran_p: [
                                {label: 'Tunai / Cash', key: 'tunai'},
                                {label: 'Visa', key: 'visa'},
                                {label: 'Master Card', key: 'master'},
                                {label: 'Kartu Debit', key: 'kartu_debit'},
                                {label: 'JCB', key: 'jcb'},
                            ],
                        product: {
                            id: '',
                            crc_code: '',
                            la_code: '',
                            nama_customer: '',
                            no_ktp: '',
                            alamat: '',       
                            alamat_pemasangan: '',       
                            no_telp: '',
                            no_hp: '',
                            email: '',                            
                        },
                        barang_sewa: {
                            id_barang: '',
                            kode_barang: '',
                            nama_barang: '',
                            harga: '',
                            harga_sewa: '600000',                            
                        },
                        barang: {
                            id_barang: '',
                            kode_barang: '',
                            nama_barang: '',
                            harga: '',
                            sisa: 0,                            
                        },
                        customer2: {
                            id: '',
                            crc_code: '',
                            la_code: '',
                            nama_customer: '',
                            nama_pemilik_kartu: '',
                            no_ktp: '',
                            alamat_ktp: '',       
                            alamat_pemasangan: '',       
                            no_telp: '',
                            no_hp: '',
                            email: '',                                                        
                        },
                        dataAgency: {
                            id: '',
                            agency_code: ''                                                   
                        },
                        adi:{
                            totalan: null,                          
                            sisa1: null,                          
                            sisa2: null,                          
                            sisa3: null,                          
                            sisa4: null,                          
                            sisa5: null,                            
                        },
                        details: {
                            sub_total: 0,
                            total: 0,
                            total_quantity: 0
                        },
                        itemCount: 0,
                        items: [],
                        item: {
                            id_barang: '',
                            kode_barang: '',
                            nama_barang: '',
                            harga: 0.00,
                            sisa: 0,
                            harga2: '',
                            qty: ''
                        },
                        cartCondition: {
                            name: '',
                            type: '',
                            target: '',
                            value: '',
                            attributes: {
                                description: 'Value Added Tax'
                            }
                        },
                        options: {
                            target: [
                                {label: 'Apply to SubTotal', key: 'subtotal'},
                                {label: 'Apply to Total', key: 'total'}
                            ]
                        },
                        details2: {
                            sub_total: 0,
                            total: 0,
                            total_quantity: 0
                        },
                        itemCount2: 0,
                        items2: [],
                        item2: {
                            id_barang: '',
                            kode_barang: '',
                            nama_barang: '',
                            harga: 0.00,
                            sisa: 0,
                            qty: ''
                        },
                        cartCondition2: {
                            name: '',
                            type: '',
                            target: '',
                            value: '',
                            attributes: {
                                description: 'Value Added Tax'
                            }
                        },
                        options2: {
                            target: [
                                {label: 'Apply to SubTotal', key: 'subtotal'},
                                {label: 'Apply to Total', key: 'total'}
                            ]
                        },
                        form:{
                            new_kode_bank:null,
                            new_nama_bank:null                            
                        },
                        formTeknisi:{
                            nama_teknisi:''                            
                        },
                        formSalesManager:{
                            nama_manajer:''                            
                        },
                        formSales:{
                            id_manajer:'',
                            nama_sales:'',                            
                            agency_code:''                            
                        },
                        daftarBank: {
                            kode_bank: '',
                            nama_bank: ''
                        },
                        daftarTeknisi: {
                            id: '',
                            nama_teknisi: ''
                        },
                        daftarSalesManager: {
                            id: '',
                            nama_manajer: ''
                        },
                        daftarSales: {
                            id: '',
                            id_manajer: '',
                            nama_sales: ''
                        },
                        
                    },
                    watch: {
                        'product.id': function() {
                            if (this.product.id) {
                                this.getProduct()
                            }
                        },
                        'barang.id_barang': function() {
                            if (this.barang.id_barang) {
                                this.getBarang()
                            }
                        },
                        'barang_sewa.id_barang': function() {
                            if (this.barang_sewa.id_barang) {
                                this.getBarangSewa()
                            }
                        },
                        'customer2.id': function() {
                            if (this.customer2.id) {
                                this.getCustomer2()
                            }
                        },
                        'dataAgency.id': function() {
                            if (this.dataAgency.id) {
                                this.getDataAgency()
                            }
                        },
                        'item.id_barang': function() {
                            if (this.item.id_barang) {
                                this.getItem()
                            }
                        },
                        'item2.id_barang': function() {
                            if (this.item2.id_barang) {
                                this.getItem2()
                            }
                        },
                        'papa': function() {
                            if (this.papa) {
                                this.adi.totalan = this.papa*this.datapapa
                            }
                        }
                    },
                    mounted(){
                        $('#product_id').select({
                            width: '100%'
                        }).on('change', () => {
                            this.product.id = $('#product_id').val();
                        });

                        $('#barang_sewa_id').select({
                            width: '100%'
                        }).on('change', () => {
                            this.barang_sewa.id_barang = $('#barang_sewa_id').val();
                        });
                        
                        $('#barang_id').select({
                            width: '100%'
                        }).on('change', () => {
                            this.barang.id_barang = $('#barang_id').val();
                        });
                        
                        $('#id_invoice').select({
                            width: '100%'
                        });  
                        
                        $('#product_id').select2({
                            width: '100%'
                        }); 

                        $('#customer_id2').select2({
                            width: '100%'
                        }).on('change', () => {
                            this.customer2.id = $('#customer_id2').val();
                        });

                        $('#agency_id').select2({
                            width: '100%'
                        }).on('change', () => {
                            this.dataAgency.id = $('#agency_id').val();
                        });

                        this.loadItems();

                        $('#barang_id').select2({
                            width: '100%'
                        }).on('change', () => {
                            this.item.id_barang = $('#barang_id').val();
                        });

                        $('#nominalPembayaranPeriode').on('change', () => {
                            this.adi.totalan = $('#nominalPembayaranPeriode').val();
                        });

                        this.loadItems2();

                        $('#barang_id2').select2({
                            width: '100%'
                        }).on('change', () => {
                            this.item2.id_barang = $('#barang_id2').val();
                        });

                        $('#pilihanPeriode').select2({
                            width: '100%'
                        }).on('change', () => {
                            this.papa = $('#pilihanPeriode').val();
                        });

                        $('.gampang').select2({
                            width: '100%'
                        });
                        
                    },
                    methods: {
                        getProduct() {
                            this.$http.get(`/api/product/${this.product.id}`)
                                .then((response) => {
                                    this.product = response.data
                                })
                        },
                        getBarang() {
                            this.$http.get(`/api/barang/${this.barang.id_barang}`)
                                .then((response) => {
                                    this.barang = response.data
                                })
                        },
                        getBarangSewa() {
                            this.$http.get(`/api/barang/${this.barang_sewa.id_barang}`)
                                .then((response) => {
                                    this.barang_sewa = response.data
                                })
                        },
                        getCustomer2() {
                            this.$http.get(`/api/product/${this.customer2.id}`)
                                .then((response) => {
                                    this.customer2 = response.data
                                })
                        },
                        getDataAgency() {
                            this.$http.get(`/api/agency/${this.dataAgency.id}`)
                                .then((response) => {
                                    this.dataAgency = response.data
                                })
                        },
                        getItem() {
                            this.$http.get(`/api/barang/${this.item.id_barang}`)
                                .then((response) => {
                                    this.item = response.data
                                })
                        },
                        getItem2() {
                            this.$http.get(`/api/barang/${this.item2.id_barang}`)
                                .then((response) => {
                                    this.item2 = response.data
                                })
                        },
                        addItem: function() {

                            var _this = this;

                            this.$http.post('/cart',{
                                _token:_token,
                                id_barang:_this.item.id_barang,
                                kode_barang:_this.item.kode_barang,
                                nama_barang:_this.item.nama_barang,
                                harga:_this.item.harga2,
                                qty:_this.item.qty
                            }).then(function(success) {
                                _this.loadItems();
                            }, function(error) {
                                console.log(error);
                            });
                        },
                        removeItem: function(id) {

                            var _this = this;

                            this.$http.delete('/cart/'+id,{
                                params: {
                                    _token:_token
                                }
                            }).then(function(success) {
                                _this.loadItems();
                            }, function(error) {
                                console.log(error);
                            });
                        },
                        loadItems: function() {

                            var _this = this;

                            this.$http.get('/cart',{
                                params: {
                                    limit:10
                                }
                            }).then(function(success) {
                                _this.items = success.body.data;
                                _this.itemCount = success.body.data.length;
                                _this.loadCartDetails();
                            }, function(error) {
                                console.log(error);
                            });
                        },
                        loadCartDetails: function() {

                            var _this = this;

                            this.$http.get('/cart/details').then(function(success) {
                                _this.details = success.body.data;
                            }, function(error) {
                                console.log(error);
                            });
                        },
                        getItem2() {
                            this.$http.get(`/api/barang/${this.item2.id_barang}`)
                                .then((response) => {
                                    this.item2 = response.data
                                })
                        },
                        addItem2: function() {

                            var _this = this;

                            this.$http.post('/cart',{
                                _token:_token,
                                id_barang:_this.item2.id_barang,
                                kode_barang:_this.item2.kode_barang,
                                nama_barang:_this.item2.nama_barang,
                                harga:_this.item2.harga,
                                qty:_this.item2.qty
                            }).then(function(success) {
                                _this.loadItems2();
                            }, function(error) {
                                console.log(error);
                            });
                        },
                        removeItem2: function(id) {

                            var _this = this;

                            this.$http.delete('/cart/'+id,{
                                params: {
                                    _token:_token
                                }
                            }).then(function(success) {
                                _this.loadItems2();
                            }, function(error) {
                                console.log(error);
                            });
                        },
                        loadItems2: function() {

                            var _this = this;

                            this.$http.get('/cart',{
                                params: {
                                    limit:10
                                }
                            }).then(function(success) {
                                _this.items2 = success.body.data;
                                _this.itemCount2 = success.body.data.length;
                                _this.loadCartDetails2();
                            }, function(error) {
                                console.log(error);
                            });
                            },
                            loadCartDetails2: function() {

                                var _this = this;

                                this.$http.get('/cart/details').then(function(success) {
                                    _this.details2 = success.body.data;
                                }, function(error) {
                                    console.log(error);
                                });
                            },
                        save(){
                            this.$http.post('/api/newBank',this.form)
                            .then((response)=>{
                                this.$http.get('/api/bank')
                            .then(function (response) {
                                this.countries = response.data;
                            }.bind(this));
                            })
                        },
                        saveTeknisi(){
                            this.$http.post('/api/newTeknisi',this.formTeknisi)
                            .then((response)=>{
                                this.$http.get('/api/daftarTeknisi')
                            .then(function (response) {
                                this.countries2 = response.data;
                            }.bind(this));
                            })
                        },
                        saveSalesManager(){
                            this.$http.post('/api/newSalesManager',this.formSalesManager)
                            .then((response)=>{
                                this.$http.get('/api/salesManager')
                            .then(function (response) {
                                this.countries2 = response.data;
                            }.bind(this));
                            })
                        },
                        saveSales(){
                            this.$http.post('/api/newSales',this.formSales)
                            .then((response)=>{
                                this.$http.get('/api/sales')
                            .then(function (response) {
                                this.countries2 = response.data;
                            }.bind(this));
                            })
                        },
                        getBank() {
                            this.$http.get('/api/bank')
                                .then(function (response) {
                                    this.daftarBank = response.data;
                                }.bind(this));
                                setTimeout(this.getBank, 5 * 60 * 1000);
                        },
                        getTeknisi() {
                            this.$http.get('/api/daftarTeknisi')
                                .then(function (response) {
                                    this.daftarTeknisi = response.data;
                                }.bind(this));
                                setTimeout(this.getTeknisi, 5 * 60 * 1000);
                        },
                        getSalesManager() {
                            this.$http.get('/api/salesManager')
                                .then(function (response) {
                                    this.daftarSalesManager = response.data;
                                }.bind(this));
                                setTimeout(this.getSalesManager, 5 * 60 * 1000);
                        },
                        getSales() {
                            this.$http.get('/api/sales')
                                .then(function (response) {
                                    this.daftarSales = response.data;
                                }.bind(this));
                                setTimeout(this.getSales, 5 * 60 * 1000);
                        },
                        refreshBank() {
                            setTimeout(this.getBank, 100);
                        },
                        refreshSales() {
                            setTimeout(this.getSales, 100);
                        },
                        refreshSalesManager() {
                            setTimeout(this.getSalesManager, 100);
                        },
                        refreshTeknisi() {
                            setTimeout(this.getTeknisi, 100);
                        },
                    },
                    created: function(){
                        this.getBank();
                        this.getSalesManager();
                        this.getSales();
                        this.getTeknisi();
                    },
                });
                    
    });

    })(jQuery);
</script>

<script>
    $('#add_exercise').on('click', function() { 
      $('#exercises').append('<div class="exercise row"><div class="col-md-12"><label>Jenis Bank</label><select class="form-control" name="jenis_bank_payment[]"><option>-- Pilihan Bank --</option><option value="Bank BCA">Bank BCA </option><option value="Bank Mandiri">Bank Mandiri </option></select></div><div class="col-md-12"><label>Nomor Kartu</label><input type="number" name="nomor_kartu_payment[]" class="form-control" onKeyPress="if(this.value.length==16) return false;"></div><div class="col-md-12"><label>Nominal Debit</label><input type="number" name="nominal_debit_payment[]" class="form-control" onKeyPress="if(this.value.length==16) return false;"></div><button class="remove btn btn-danger"><i class="fa fa-times"></i></button></div>');      return false; //prevent form submission
  });
  
  $('#exercises').on('click', '.remove', function() {
      $(this).parent().remove();
      return false; //prevent form submission
  });
</script>



<script>
    $(function() {
        $('#colorselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
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

    $(function() {
        $('#inputBankselectorVisa').change(function(){
            $('.bankVIsa').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#inputBankselectorMaster').change(function(){
            $('.bankMaster').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#inputBankselectorDebit').change(function(){
            $('.bankDebit').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#inputBankselectorMaster').change(function(){
            $('.bankMaster').hide();
            $('#' + $(this).val()).show();
        });
    });

    $(function() {
        $('#recurring_selector').change(function(){
            $('.recurring').hide();
            $('#' + $(this).val()).show();
        });
    });

   
</script>

<script>
    $(document).ready(function(){
        // Format mata uang.
        $( '.uang' ).mask('0.000.000.000', {reverse: true});
        // Format nomor HP.
        $( '.no_hp' ).mask('0000−0000−0000');
        // Format expired card
        $( '.expiredCard' ).mask('00/00');
    });

    function someFunction(site){     
        return site.replace(/\/$/, "");
    }

    var ct = 1;
    function new_link(){
        ct++;
        var div1 = document.createElement('div');
        div1.id = ct;
        div1.name = ct;
        // link to delete extended form elements
        var delLink = '<div style="text-align:right;margin-right:65px"><a href="javascript:delIt('+ ct +')" class="btn btn-danger">Hapus Metode Pembayaran</a></div>';
        var sisaan = ct;
        div1.innerHTML = '<div id="newlinktpl"><div class="col-md-12 output"><div class="form-group form-group-sm"><label>Jenis Bank</label><select name="jenis_bank[]" class="form-control"><option value="Bank BCA">Bank BCA</option><option value="Bank Mandiri">Bank Mandiri</option></select></div></div><div class="col-md-12 output"><div class="form-group form-group-sm"><label>Nominal Pembayaran</label><input type="text" class="form-control" name="nominal_pembayaran[]" v-model="adi.sisa'+sisaan+'"></div> </div></div>' + delLink;
        document.getElementById('newlink').appendChild(div1);        
    }
    // function to delete the newly added set of elements
    function delIt(eleId){
        d = document;
        var ele = d.getElementById(eleId);
        var parentEle = d.getElementById('newlink');
        parentEle.removeChild(ele);
    }

</script>

<script>
    $("#tambah1").click(function () {
        $("#sheet1").css("display", "none");
        $("#tambah1").css("display", "none");
    });
    
    jQuery(document).ready(function () {
        jQuery('select[name="salesManager"]').on('change',function(){
            var salesManagerID = jQuery(this).val();
            if(salesManagerID)
            {
            jQuery.ajax({
                url : 'getSales/' +salesManagerID,
                type : "GET",
                dataType : "json",
                success:function(data)
                {
                    console.log(data);
                    jQuery('select[name="sales"]').empty();
                    jQuery.each(data, function(key,value){
                        $('select[name="sales"]').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
            }
            else
            {
            $('select[name="state"]').empty();
            }
        });
    });
</script>

<script>
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler 
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
        } else {
        $box.prop("checked", false);
        }
    });
</script>

<script>
    function ceklisGenerateSO() {
      var checkBox = document.getElementById("ceklis");
      var text = document.getElementById("so");
      if (checkBox.checked == true){
        text.value = '';
        text.style.backgroundColor = "black";
        text.disabled = true;
      } else {
        text.style.backgroundColor = "white";
        text.disabled = false;
      }
    }
  </script>






