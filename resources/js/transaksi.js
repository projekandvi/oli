import Vue from 'vue'
import axios from 'axios'

Vue.filter('currency', function(money) {
    return accounting.formatMoney(money, "Rp ", 2, ".", ",")
})


new Vue({
    el: '#dw',
    data: {
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
        customer2: {
            id: '',
            crc_code: '',
            la_code: '',
            nama_customer: '',
            nama_pemilik_kartu: '',
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
        details: {
            sub_total: 0,
            total: 0,
            total_quantity: 0
        },
        itemCount: 0,
        items: [],
        item: {
            id: '',
            name: '',
            price: 0.00,
            qty: 1
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
        }
    },
    watch: {
        'product.id': function() {
            if (this.product.id) {
                this.getProduct()
            }
        },
        'customer2.id': function() {
            if (this.customer2.id) {
                this.getCustomer2()
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
    },
    mounted() {
        $('#product_id').select2({
            width: '100%'
        }).on('change', () => {
            this.product.id = $('#product_id').val();
        });
        
        $('#customer_id2').select2({
            width: '100%'
        }).on('change', () => {
            this.customer2.id = $('#customer_id2').val();
        });

        $('#barang_sewa_id').select2({
            width: '100%'
        }).on('change', () => {
            this.barang_sewa.id_barang = $('#barang_sewa_id').val();
        });
        
        $('#barang_id').select2({
            width: '100%'
        }).on('change', () => {
            this.barang.id_barang = $('#barang_id').val();
        });
        
        $('#id_invoice').select2({
            width: '100%'
        });

        $('#id_staf').select2({
            width: '100%'
        });

        this.loadItems();
        
    },
    methods: {
        getProduct() {
            axios.get(`/api/product/${this.product.id}`)
                .then((response) => {
                    this.product = response.data
                })
        },
        getCustomer2() {
            axios.get(`/api/product/${this.customer2.id}`)
                .then((response) => {
                    this.customer2 = response.data
                })
        },
        getBarang() {
            axios.get(`/api/barang/${this.barang.id_barang}`)
                .then((response) => {
                    this.barang = response.data
                })
        },
        getBarangSewa() {
            axios.get(`/api/barang/${this.barang_sewa.id_barang}`)
                .then((response) => {
                    this.barang_sewa = response.data
                })
        },
        addItem: function() {

            var _this = this;

            axios.post('/cart',{
                id:_this.item.id,
                name:_this.item.name,
                price:_this.item.price,
                qty:_this.item.qty
            }).then(function(success) {
                _this.loadItems();
            }, function(error) {
                console.log(error);
            });
        },
        removeItem: function(id) {

            var _this = this;

            axios.delete('/cart/'+id,{
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

            axios.get('/slipOrder/new',{
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

            axios.get('/cart/details').then(function(success) {
                _this.details = success.body.data;
            }, function(error) {
                console.log(error);
            });
        }
    }
});