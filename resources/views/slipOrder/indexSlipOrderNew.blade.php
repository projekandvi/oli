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
				<div class="col-md-6 col-sm-6 col-xs-12 animated headShake batasan">			
				  <div class="tile-box tile-box-alt bg-blue font-white">
					  <div class="tile-header">Slip Order Sewa</div>
					  <div class="tile-content-wrapper">
					  </div>
					  <a href="/orderSewa" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="Slip Order Sewa"> Buat Slip Order Sewa  <i class="glyph-icon icon-arrow-right"></i> </a>
				  </div>
			
				</div> 
        <!--Leads ends-->	
        
      <!--Customers start-->
				<div class="col-md-6 col-sm-6 col-xs-12 animated headShake batasan">			
				  <div class="tile-box tile-box-alt bg-blue font-white">
					  <div class="tile-header">Slip Order Jual Putus</div>
					  <div class="tile-content-wrapper">
					  </div>
					  <a href="/orderJualPutus" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="Slip Order Jual Putus"> Buat Slip Order Jual Putus  <i class="glyph-icon icon-arrow-right"></i> </a>
				  </div>
			
				</div> 
        <!-- Customers ends-->	
        
      
			
		  </div>

	</div>

	<div class="panel-footer">  
		<span style="padding: 10px;">
		
		</span> 
	  <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/slipOrder">
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