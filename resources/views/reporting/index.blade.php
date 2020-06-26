@extends('app')

@section('title')
	Akunting
@stop

@section('contentheader')
Akunting List
@stop

@section('breadcrumb')
Akunting List
@stop

@section('main-content')

	<div class="panel-heading">
		
		<a href="#" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;"></a>

		@if(count(Request::input()))
			<span class="pull-right">	
	            <a class="btn btn-default btn-alt btn-xs" href="{{ action('InvoiceController@getIndex') }}"><i class="fa fa-eraser"></i> clear</a>
	            <a class="btn btn-primary btn-alt btn-xs" id="searchButton"><i class="fa fa-search"></i> modify search </a>
	        </span>
        @else
            <a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">	<i class="fa fa-search"></i>search</a>
        @endif
	</div>

	<div class="panel-body">

		{{-- -------------------------------------------------------------------------------- --}}
		<div class="row ">
    
				<!--Total invoices today-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake">
			
				  <div class="tile-box tile-box-alt bg-gradient-9 font-white">
					  <div class="tile-header">
							TOTAL INVOICES
					  </div>
					  <div class="tile-content-wrapper">
						  <i class="glyph-icon fa fa-shopping-cart"></i>
						  <div class="tile-content">
							<span>
							  {{-- {{$total_invoice}} --}}
							  Invoices
							  <small>
							 Amount (
                                Rp 
                                {{-- {{ number_format($totalTransaksi,0,'.','.') }} --}}
							  )
							  </small>
							</span>
						  </div>
					  </div>
					  <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Invoices">
						  View Invoices
						  <i class="glyph-icon icon-arrow-right"></i>
					  </a>
				  </div>
			
				</div> <!-- /.col -->
				<!--Ends-->			
			
				<!--Total bills for today-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake">
			
				  <div class="tile-box tile-box-alt bg-blue font-white">
					  <div class="tile-header">PAID</div>
					  <div class="tile-content-wrapper">
						  <i class="glyph-icon fa fa-ship"></i>
						  <div class="tile-content">
							<span> 
                                {{-- {{$qty_transaksi_lunas}}  --}}
                                Invoices<small>	Amount ( Rp 
                                    {{-- {{ number_format($totalTransaksiLunas,0,'.','.') }} --}}
                                      )</small>	</span>
						  </div>
					  </div>
					  <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Bills"> View Bills  <i class="glyph-icon icon-arrow-right"></i> </a>
				  </div>
			
				</div> <!-- /.col -->
				<!--Total bill for today ends-->			
			
				<!--Total cash received today-->
				<div class="col-md-4 col-sm-6 col-xs-12 animated headShake">
				
					<div class="tile-box tile-box-alt bg-gradient-9 font-white">
						<div class="tile-header">UNPAID</div>
					  	<div class="tile-content-wrapper">
							<i class="glyph-icon fa fa-money"></i>
						  	<div class="tile-content">
								<span> 
                                    {{-- {{$qty_transaksi_belum_lunas}} --}}
                                     Invoices <small>	Amount ( Rp 
                                         {{-- {{ number_format($totalTransaksiBelumLunas,0,'.','.') }} --}}
                                          )</small></span>
							</div>
					  	</div>
					  	<a href="#" class="tile-footer tooltip-button" data-placement="bottom" title="" data-original-title="View Details">  View Details  <i class="glyph-icon icon-arrow-right"></i> </a>
				  	</div>
				</div> <!-- /.col -->
			
				<!--Ends-->
			</div>
			<hr>
		{{-- -------------------------------------------------------------------------------- --}}
	
		{{-- -------------------------------------------------------------------------------- --}}		
	</div>

	
@stop

@section('js')
	@parent
	<script>
		$(function() {
            $('#searchButton').click(function(event) {
                event.preventDefault();
                $('#searchModal').modal('show')
            });
        })
	</script>

@stop