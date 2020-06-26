@extends('app')

@section('title')
	Dashboard
@stop

@section('contentheader')
	Dashboard
@stop



@section('main-content')

<style>
.batasan {
  margin-bottom: 20px;
}
</style>


	<div class="panel-body">
		
		<div class="row ">

			@if (Auth::user()->status === 'admin' )
				<!--Leads start-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Lead</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$lead}} Lead
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="{{route('lead.index')}}" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Leads"> View Leads  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
		  <!--Leads ends-->	
		  
		<!--Customers start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Customers</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$customer}} Customer
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="{{route('customer.index')}}" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Customers"> View Customers  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
		  <!-- Customers ends-->	
		  
		<!--Inventories start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Inventories</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$barang}} Barang
								  {{-- <small>	Amount ( Rp 1  )</small> --}}
							  </span>
							</div>
						</div>
						<a href="{{route('barang.index')}}" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Inventories"> View Inventories  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
		  <!-- Inventories ends-->	
		  
		<!--Slip Order start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Slip Order</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$invoice}} Invoices
								  {{-- <small>	Amount ( Rp {{ number_format($invoiceTotal,0,'.','.') }} )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="{{route('slipOrder.index')}}" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Slip Order"> View Slip Order  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
		  <!-- Slip Order ends-->	
		  
		<!--Akunting start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Akunting</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$invoice}} Invoices
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="/akunting" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Akunting"> View Akunting  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
		  <!-- Akunting ends-->	
		  
		<!--Tiket start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Tiket</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$tiket}} Tikets
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="/tiket" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Tiket"> View Tiket  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
		  <!-- Tiket ends-->	
		  
		<!--Monitoring Instalasi start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Monitoring Instalasi</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$instalasi}} Instalasi
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="/instalasi" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Monitoring Instalasi"> View Monitoring Instalasi  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
				  <!-- Monitoring Instalasi ends-->	
		  
		<!-- Staf start-->
				  <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Delivery Order</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$delivery}} Delivery Order
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  </span>
							</div>
						</div>
						<a href="/delivery" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Monitoring Staf"> View Staf  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div> 
				  <!-- Staf ends-->	

		<!-- Staf start-->
				  {{-- <div class="col-md-4 col-sm-6 col-xs-12 animated headShake batasan">			
					<div class="tile-box tile-box-alt bg-blue font-white">
						<div class="tile-header">Menu Staf</div>
						<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-ship"></i>
							<div class="tile-content">
							  <span> {{$staf}} Staf --}}
								  {{-- <small>	Amount ( Rp 1  )</small>	 --}}
							  {{-- </span>
							</div>
						</div>
						<a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Monitoring Staf"> View Staf  <i class="glyph-icon icon-arrow-right"></i> </a>
					</div>
			  
				  </div>  --}}
				  <!-- Staf ends-->	
			@else
				lalala
			@endif

      

      
		
		
		

			
		
			<!--Ends-->
		  </div>

		  
      
		 

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