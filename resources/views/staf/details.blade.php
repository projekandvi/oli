@extends('app')

@section('title')
  {{$barang->name}}
@stop

@section('contentheader')
  {{$barang->name}} Details
@stop

@section('breadcrumb')
  <a href="{{route('barang.index')}}">Barang</a>
  <li>{{$barang->nama_barang}}</li>
@stop

@section('main-content')

    <!-- Main content -->
    <div class="panel-body">

      <div class="row">
        
        
        <div class="col-md-12">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active">
                  <a href="#details{{$barang->id}}" data-toggle="tab">
                    Detail
                  </a>
                </li>
                <li>
                    <a href="#timeline{{$barang->id}}" data-toggle="tab">
                      Sparepart
                    </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="details{{$barang->id}}">
                    <form>
				
                        <div class="row">
                            <div class="col-md-12">					
                                <label> 
                                  Kode Barang
                                </label>                           
                                <input type="text" class="form-control" value="{{$barang->kode_barang}}" disabled="true">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">					
                                <label> 
                                  Nama Barang
                                </label>                           
                                <input type="text" class="form-control" value="{{$barang->nama_barang}}" disabled="true">
                            </div>
                        </div>
                
                       
                
                        <div class="row">
      
                            <div class="col-md-6">
                                <label>Kondisi</label>
                                <input type="text" class="form-control" value="{{$barang->kondisi}}" disabled="true">
                            </div>
                            
                            <div class="col-md-6">
                              <label>Lokasi Stok</label>
                              <input type="text" class="form-control" value="{{$barang->lokasi_stok}}" disabled="true">
                            </div>
                          
                        </div>      
                      </form>
              <hr>
  
              
                </div><!-- /.tab-pane -->
  
              <div class="tab-pane" id="timeline{{$barang->id}}">
                  
                @foreach ($barang->sparepart as $item)
                <div class="row">
                  <div class="col-md-12">
                      <input type="text" class="form-control" value="{{$item->nama_sparepart}}" disabled="true">
                  </div>
                </div><br>
                @endforeach
               
                

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
      <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="{{route('barang.index')}}">
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