
    <script>  window.Laravel = {!! json_encode(['csrfToken' => csrf_token() ]); !!}  </script>        
    <!-- Javascripts -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/accounting.js/0.4.1/accounting.min.js"></script>
    {{-- <script src="{{ asset('js/transaksi.js') }}"></script> --}}
    <script src="{{ asset('/assets/js-core/slimscroll.js') }}"></script>
    <script src="{{ asset('/assets/js-core/screenfull.js') }}"></script>
    <script defer src="{{ asset('/build/app.b81f4459eb1b0cdac4d5.js') }}"></script>
    <script src="{{ asset('/assets/js-core/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('/assets/js-core/highcharts.js') }}"></script>
    <script src="{{ asset('/assets/js-core/exporting.js') }}"></script>

    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script> 

        
    <script src="{{ asset('/assets/js-core/Chart.min.js') }}"></script>
    <script src="{{ asset('/assets/js-core/chartjs-tooltip-show.js') }}"></script>   
    <script>
      /*Pie chart for stock*/
      var ctx2 = document.getElementById("stockChart");
      var stock = <?php echo json_encode($stock); ?>;
      var stockChart = new Chart(ctx2, {
          type: 'pie',
          options: {
            /*showAllTooltips: true,*/
          },
          data: {         
              labels: [
                  "Penjualan Sewa Recurring",
                  "Penjualan Sewa Periode",
                  "Penjualan Putus",
              ],
              datasets: [{
                  data: stock,
                  backgroundColor: [
                      "#039A93",
                      "#5499C7",
                      "#ffeb3b"
                  ],
                  hoverBackgroundColor: [
                      "#d61300",
                      "#d61300",
                      "#d61300"
                  ]
              }]
          },
      });
      /*stock pie chart ends*/ 

      // Sell vs Purchase Chart
    var ctx3 = document.getElementById("penyewaanvspembelian");
    var months = <?php echo json_encode(array_reverse($months)); ?>;
    var penyewaanRecurring = <?php echo json_encode(array_reverse($penyewaanRecurring)); ?>;
    var penyewaanPeriode = <?php echo json_encode(array_reverse($penyewaanPeriode)); ?>;
    var pembelian = <?php echo json_encode(array_reverse($pembelian)); ?>;
    var chart = new Chart(ctx3, {
      type: 'bar',
      data: {
        labels: months,
        datasets: [{
          label: ["penyewaanRecurring"],
          backgroundColor: "#039A93",
          data: penyewaanRecurring
        }, {
          label: ["penyewaanPeriode"],
          backgroundColor: "#5499C7",
          data: penyewaanPeriode
        },{
          label: ["pembelian"],
          backgroundColor: "#ffeb3b",
          data: pembelian
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
        tooltips: {
          enabled: true,
            callbacks: {
                label: function(tooltipItems, data) { 
                    return '' + tooltipItems.yLabel;
                }
            }
        },

        legend:{
          enabled:true
        },
      }
    });

    //ends  
  
    </script>
   