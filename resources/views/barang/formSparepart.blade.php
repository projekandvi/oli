@extends('app')

@section('contentheader')
    @if($barang->id)
        Tambah Sparepart <b>{{$barang->name}}</b>
    @else
        add new barang
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('barang.index')}}">barang list</a>
     &nbsp;>&nbsp;
    Tambah Sparepart ke barang :  {{$barang->nama_barang}}
@stop



@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">
        
            add new barang
        
    </h3>

    {!! Form::model($barang, ['method' => 'post', 'action' => 'BarangController@postAddSparepart','files' => true, 'class' => 'form-horizontal bordered-row repeater ', 'id' => 'ism_form']) !!}

    <div class="form-group">
            <label class="control-label col-sm-3">Nama Barang<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" disabled value="{{$barang->nama_barang}}" />
                <input type="hidden" class="form-control" name="id_barang" value="{{$barang->id_barang}}" />
            </div>
        </div>    
    {{-- <div class="form-group">
            <label class="control-label col-sm-3">Nama Barang<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" disabled value="{{$barang->nama_barang}}" />
                <input type="hidden" class="form-control" name="id_barang" value="{{$barang->id}}" />
            </div>
        </div>

        <div data-repeater-list="category-group">
            <div data-repeater-item>
                <div class="form-group">
                    <input type="hidden" name="id" id="cat-id"/>
                    <label class="control-label col-sm-3">ID Sparepart<span class="required">*</span></label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Harga Barang" name="id_sparepart[]"/>
                        <input data-repeater-delete type="button" value="Delete"/>
                    </div>
                    
                </div>
            </div>
        </div>

        <input data-repeater-create type="button" value="Add"/> --}}

        {{-- <div data-repeater-list="category-group">
                
                        <div data-repeater-item>
                                <div class="form-group">
                                <label class="control-label col-sm-3">ID Sparepart<span class="required">*</span></label>
                        <input type="hidden" name="id" id="cat-id"/>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="id_sparepart" />
                        </div>
                        <input data-repeater-delete type="button" value="Delete"/>
                        </div>
                </div>
        </div>
              <input data-repeater-create type="button" value="Add"/> --}}

              {{-- <form method="post" action="#"> --}}
                    
                    
                    <fieldset id="exercises">
                        <div class="exercise form-group">
                            <label class="control-label col-sm-3">ID Sparepart<span class="required">*</span></label>
                            <div class="col-sm-6">
                                {{-- <input class="form-control" type="text" name="id_sparepart[]"/> --}}
{!! Form::select('id_sparepart[]', $spareparts, 11, ['class' => 'form-control selectpicker', 'id' => '$spareparts', 'placeholder' => 'Please select many parts', 'data-live-search' => "true",'multiple']) !!}
                            </div>
                            {{-- <button class="remove">x</button> --}}
                        </div> 
                    </fieldset>  
                    
                    {{-- <div class="form-group">
                            <label class="control-label col-sm-3"></label>
                            <div class="col-sm-6">
                                    <button id="add_exercise">Tambah Sparepart</button>
                            </div>
                        </div> --}}
                    
                    
                {{-- </form> --}}

        

        {{-- <div class="form-group">
            <label class="control-label col-sm-3">ID Sparepart<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Harga Barang" name="id_sparepart[]"/>
            </div>
        </div> --}}

        


        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script> --}}
  {{-- <script  src="{{ asset('jquery_repeater/script.js')}}"></script> --}}
  <script>//Clone and Remove Form Fields

        $('#add_exercise').on('click', function() { 
            // $('#exercises').append('<div class="exercise form-group"><label class="control-label col-sm-3">ID Sparepart<span class="required">*</span></label><div class="exercise col-sm-6"><input class="form-control" type="text" name="id_sparepart[]"></div><button class="remove">x</button></div>');
            $('#exercises').append('<div class="exercise form-group"><label class="control-label col-sm-3">ID Sparepart<span class="required">*</span></label><div class="exercise col-sm-6">{!! Form::select("id_sparepart[]", $spareparts, 11, ["class" => "form-control selectpicker", "id" => "$spareparts", "placeholder" => "Please select a category", "data-live-search" => "true", "multiple"]) !!}</div><button class="remove">x</button></div>');
            return false; //prevent form submission
        });
        
        $('#exercises').on('click', '.remove', function() {
            $(this).parent().remove();
            return false; //prevent form submission
        });</script>
@stop