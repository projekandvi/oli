@extends('app')

@section('title')
	Menu Slip Order
@stop

@section('contentheader')
	Slip Order
@stop

@section('main-content')

<style>
.batasan {
  margin-bottom: 20px;
}
</style>

	<div class="panel-body">
		
		<div class="row ">
      <!--Leads start-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
				  <div class="tile-box tile-box-alt bg-blue font-white">
					  <div class="tile-header">Slip Order Baru</div>
					  <div class="tile-content-wrapper">
						  {{-- <i class="glyph-icon fa fa-ship"></i> --}}
						  {{-- <div class="tile-content">
							<span> 1 Invoices<small>	Amount ( Rp 1  )</small>	</span>
						  </div> --}}
					  </div>
					  <a href="/indexSlipOrderNew" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Leads"> Buat Slip Order Baru  <i class="glyph-icon icon-arrow-right"></i> </a>
				  </div>
			
				</div> 
        <!--Leads ends-->	
        
      <!--Customers start-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
				  <div class="tile-box tile-box-alt bg-blue font-white">
					  <div class="tile-header">Daftar Penjualan Sewa</div>
					  <div class="tile-content-wrapper">
						  {{-- <i class="glyph-icon fa fa-ship"></i> --}}
						  {{-- <div class="tile-content">
							<span> 1 Invoices<small>	Amount ( Rp 1  )</small>	</span>
						  </div> --}}
					  </div>
					  <a href="/slipOrderSewa" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="Daftar Penjualan Sewa"> Daftar Penjualan Sewa  <i class="glyph-icon icon-arrow-right"></i> </a>
				  </div>
			
				</div> 
        <!-- Customers ends-->	
        
      <!--slip order start-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
				  <div class="tile-box tile-box-alt bg-blue font-white">
					  <div class="tile-header">Daftar Penjualan Jual Putus</div>
					  <div class="tile-content-wrapper">
						  {{-- <i class="glyph-icon fa fa-ship"></i> --}}
						  {{-- <div class="tile-content">
							<span> 1 Invoices<small>	Amount ( Rp 1  )</small>	</span>
						  </div> --}}
					  </div>
					  <a href="/slipOrderPutus" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="Daftar Penjualan Jual Putus"> Daftar Penjualan Jual Putus  <i class="glyph-icon icon-arrow-right"></i> </a>
				  </div>
			
				</div> 
        <!-- slip order ends-->	
			
		  </div>

	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;">
		
		</span> 
	  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/">
			<i class="fa fa-backward"></i> Kembali
		</a>
	</div>


@stop


@section('js')
	@parent
	<script src="{{ asset('/assets/js-core/Chart.min.js') }}"></script>
  	<script src="{{ asset('/assets/js-core/chartjs-tooltip-show.js') }}"></script>
	<script>
		$(function() {
            $('#searchButton').click(function(event) {
                event.preventDefault();
                $('#searchModal').modal('show')
            });
        })

        $(function() {
          $('.number').on('input', function() {
            match = (/(\d{0,100})[^.]*((?:\.\d{0,5})?)/g).exec(this.value.replace(/[^\d.]/g, ''));
            this.value = match[1] + match[2];
          });
        });
		// -------------------------------------------------
		

	</script>


	

@stop