@extends('app')

@section('title')
  {{$slider->name}}
@stop

@section('contentheader')
  {{$slider->name}} Details
@stop

@section('breadcrumb')
  <a href="{{route('slider.index')}}">sliders</a>
  <li>{{$slider->name}}</li>
@stop

@section('main-content')

    <!-- Main content -->
    <div class="panel-body">

      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary">
            <div class="box-body box-profile">
              @if(!empty($slider->slider_photo))
                <p>
                    <a href="{{url('uploads/sliders/' . $slider->slider_photo)}}">
                        <abbr title="Show slider Image">
                            <img src="{!! asset('uploads/sliders/'. $slider->slider_photo)!!}" 
                                class="img-thumbnail img-responsive" alt="" >
                        </abbr>
                    </a>
                </p>
              @else
                <img src="{!! asset('uploads/destinations/no-destination-image.jpg' )!!}" class="img-thumbnail img-responsive" alt="" >
              @endif

              <h3 class="profile-username text-center">{{ $slider->name }}</h3>

              

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>{{trans('created')}}:</b> 
                  <span class="pull-right">{{ Carbon\Carbon::parse($slider->created_at)->format('d-m-Y') }}</span>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-8">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#details{{$slider->id}}" data-toggle="tab">
                    {{trans('details')}}
                  </a>
                </li>
                <li>
                    <a href="#timeline{{$slider->id}}" data-toggle="tab">{{trans('photo')}}
                    </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="details{{$slider->id}}">
                    <form>
				
                        <div class="row">
                            <div class="col-md-12">					
                                <label> 
                                  Slider Name
                                </label>                           
                                <input type="text" class="form-control" value="{{$slider->name}}" disabled="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">					
                                <label> 
                                  URL Destination
                                </label>                           
                                <input type="text" class="form-control" value="{{$slider->url_destination}}" disabled="true">
                            </div>
                        </div>
                
                       
                
                        <div class="row">
      
                            <div class="col-md-6">
                                <label>Start Date</label>
                                <input type="text" class="form-control" value="{{$slider->from}}" disabled="true">
                            </div>
                            
                            <div class="col-md-6">
                              <label>End Date</label>
                              <input type="text" class="form-control" value="{{$slider->to}}" disabled="true">
                            </div>
                          
                        </div>
      
                        <div class="row">
                            <div class="col-md-12">					
                                <label> 
                                  Description
                                </label>                           
                                <textarea class="form-control" cols="30" rows="3" disabled>{{$slider->description}} </textarea>
                            </div>
                        </div>       
                      </form>
              <hr>
  
              
                </div><!-- /.tab-pane -->
  
              <div class="tab-pane" id="timeline{{$slider->id}}">
                  
                <div class="col-md-6">
                      <img src="{!! asset('uploads/sliders/'.$slider->slider_photo)!!}" class="img-responsive img-thumbnail" style="max-width: 75%; margin-bottom: 5%" alt="Gallery Image" width="100%" />
                </div>
                

              </div><!-- /.tab-pane -->
  
                
              </div><!-- /.tab-content -->
            </div><!-- /.nav-tabs-custom -->
          </div><!-- /.col -->

      </div>
      <!-- /.row -->

    </div>

    <div class="panel-footer">  
        <span style="padding: 10px;">
        
        </span> 
      <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="{{route('slider.index')}}">
            <i class="fa fa-backward"></i> {{trans('back')}}
        </a>
    </div>
@stop


@section('js')
    @parent
    <!-- <script>
        $('#search_field').on('keyup', function() {
          var value = $(this).val();
          var patt = new RegExp(value, "i");

          $('#myTable').find('tr').each(function() {
            if (!($(this).find('td').text().search(patt) >= 0)) {
              $(this).not('.myHead').hide();
            }
            if (($(this).find('td').text().search(patt) >= 0)) {
              $(this).show();
            }
          });

        });

    </script> -->
@stop