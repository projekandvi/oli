    
<script>  window.Laravel = {!! json_encode(['csrfToken' => csrf_token() ]); !!}  </script>        
    <!-- Javascripts -->

    
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
                        daftarTeknisi: {
                            id: '',
                            nama_teknisi: ''
                        },                         
                        formInstalasiBaru:{
                            tanggal_pemasangan:'',                            
                            id_rubah:'',                            
                            teknisi:'',                            
                            remark:'',                            
                            id_staf:''                          
                        },
                        formTeknisi:{
                            nama_teknisi:''                            
                        },
                    },
                    watch: {
                        
                    },
                    mounted(){
                        $('.gampang').select2({
                            width: '100%'
                        });
                    },
                    methods: {
                        getTeknisi() {
                            this.$http.get('/api/daftarTeknisi')
                                .then(function (response) {
                                    this.daftarTeknisi = response.data;
                                }.bind(this));
                                setTimeout(this.getTeknisi, 5 * 60 * 1000);
                        },
                        saveFormInstalasi(){
                            this.$http.post('/api/newInstalasi',this.formInstalasiBaru)                            
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
                        refreshTeknisi() {
                            setTimeout(this.getTeknisi, 100);
                        },
                    },
                    created: function(){
                        this.getTeknisi();
                    },
                });
                    
    });

    })(jQuery);
</script>


<script>

    $('.dateTime').datetimepicker({
          format : 'YYYY-M-D'
      })
    function submitted () {
        document.getElementById('submitButton').disabled=true;
        document.getElementById('submitButton').value='Submitting, please wait...';
        document.getElementById("isi_teknisi").submit();
    }        
</script>  



