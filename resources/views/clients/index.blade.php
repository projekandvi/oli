@extends('app')

@section('contentheader')
	Customer List
@stop

@section('breadcrumb')
	Customer List
@stop

@section('main-content')
	<div class="panel-heading">
		
		<a  href="{{route('client.new')}}" class="btn btn-success btn-alt btn-xs" style="border-radius: 0px !important;" >
			<i class='fa fa-plus'></i> 
			Create New Customer
		</a>

		@if(count(Request::input()))
			<span class="pull-right">	
	            <a class="btn btn-default btn-alt btn-xs font-black" href="{{ action('ClientController@getIndex') }}">
	            	<i class="fa fa-eraser"></i> 
	            	{{ trans('core.clear') }}
	            </a>

	            <a class="btn btn-primary btn-alt btn-xs" id="searchButton">
	            	<i class="fa fa-search"></i> 
	            	{{ trans('core.modify_search') }}
	            </a>
	        </span>
        @else
            <a class="btn btn-primary btn-alt btn-xs pull-right" id="searchButton">
				<i class="fa fa-search"></i>
				Search
			</a>
        @endif
	</div>

	<div class="panel-body">
		<div class="table-responsive" style="min-height: 150px;">
			<table class="table table-bordered table-striped">
				<thead class="bg-gradient-1">
					<td class="text-center font-white"># &nbsp;&nbsp;</td>
					<td class="text-center font-white">Name</td>
					<td class="text-center font-white">Company Name</td>
					<td class="text-center font-white">Total Due</td>
					<td class="text-center font-white">Phone</td>
					<td class="text-center font-white">Actions</td>
				</thead>

				<tbody>
					@foreach($clients as $client)
						<tr>
							<td class="text-center">{{$loop->iteration}}</td>
							<td class="text-center">{{title_case($client->name)}}</td>
							<td class="text-center">{{title_case($client->company_name)}}</td>
							<td class="text-center">
								<?php 
									$due = ($client->transactions->sum('net_total') + $client->payments->where('type', 'return')->sum('amount')) - ($client->payments->where('type', 'credit')->sum('amount')) 
								?>
								@if($due == 0)
									-
								@else
									{{settings('currency_code')}} {{$due}}
								@endif
							</td>
							<td class="text-center">
								@if($client->phone)
									{{$client->phone}}
								@else
									<i class="fa fa-remove"></i>
								@endif
							</td>
							<td class="text-center">
								@if(auth()->user()->can('customer.manage'))
									<a href="{{route('client.edit', $client)}}" class="btn btn-info btn-alt btn-xs">
										<i class="fa fa-edit"></i>
										{{trans('core.edit')}}
									</a>

									@if($client->id != 1)
									<!-- delete trigger modal -->
									<a type="button" class="btn btn-danger btn-alt btn-xs" data-toggle="modal" data-target="#deleteModal{{$client->id}}">
										<i class="fa fa-trash"></i>
									  	{{trans('core.delete')}}
									</a>
									@endif

									<a  href="{{route('client.details', $client->id)}}" type="button" class="btn btn-purple btn-alt btn-xs">
										<i class="fa fa-eye"></i>
										{{trans('core.details')}}
									</a>	
								@endif		
							</td>
						</tr>

						<!-- modal for delete -->
						<div class="modal fade" id="deleteModal{{$client->id}}">
						  <div class="modal-dialog ">
						     <form method="POST" action="http://inventory.intelle-hub.com/admin/client/delete/8" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="Mw4ica7M5FhbUlKEpyqPYZ88YAJPVAoYw7EbPnVL">

						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">
						        	{{$client->name}}
						        </h4>
						      </div>
						      <div class="modal-body" >
						        <h4 >
						        	Are you sure to delete <b>{{$client->name}}</b>?
						        </h4>
						        <br>
						        @if(count($client->sells) == 0 && count($client->purchases) == 0)
						        @else
						        	<h4 style="color: red;">
						        	<i class="fa fa-exclamation-triangle" aria-hidden="true"></i> {{$client->name}} has too much transactions, so it can't be deleted!</h4>
						        @endif
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
						        <button type="submit" class="btn btn-danger">{{trans('core.delete')}}</button>
						      </div>
						    </div>
						  </div><!-- /.modal-dialog -->
						  </form>
						</div>
						<!-- Delete modal Ends Here -->
					@endforeach
				</tbody>
			</table>
		</div>

		<!--Pagination-->
		<div class="pull-right">
			{{ $clients->links() }}
		</div>
		<!--Ends-->
	</div>


	<!-- Client search modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog">
            <div class="modal-content">
               <form method="POST" action="http://inventory.intelle-hub.com/admin/client" accept-charset="UTF-8" class="form-horizontal"><input name="_token" type="hidden" value="Mw4ica7M5FhbUlKEpyqPYZ88YAJPVAoYw7EbPnVL">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> {{ trans('core.search').' '.trans('core.customer') }}</h4>
                </div>

                <div class="modal-body">                  
                    <div class="form-group">
                        <label for="Name" class="col-sm-3">Name</label>

                        <div class="col-sm-9">
                           <input class="form-control" name="name" type="text">

                        </div>
                    </div>

                    <div class="form-group">
                       <label for="Company Name" class="col-sm-3">Company Name</label>

                        <div class="col-sm-9">
                            <input class="form-control" name="company_name" type="text">

                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="Phone No" class="col-sm-3">Phone</label>

                        <div class="col-sm-9">
                           <input class="form-control" name="phone" type="text">

                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="Address" class="col-sm-3">Address</label>

                        <div class="col-sm-9">
                           <input class="form-control" name="address" type="text">

                        </div>
                    </div>                                             
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('core.close')}}</button>
                     <input class="btn btn-primary" data-disable-with="core.searching" type="submit" value="Search">

                </div>
                </form>
            </div>
        </div>
    </div>
	<!-- search modal ends -->
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