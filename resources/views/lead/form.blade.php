@extends('app')

@section('contentheader')
    @if($lead->id)
        {{trans('core.editing')}} <b>{{$lead->lead_name}}</b>
    @else
        add new lead
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('lead.index')}}">lead list</a>
     &nbsp;>&nbsp;
    edit {{$lead->lead_name}}
@stop

@section('main-content')

<div class="panel-body">
    <h3 class="title-hero">add new Lead</h3>
    {!! Form::model($lead, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}

        <div class="form-group">
            <label class="control-label col-sm-3">Nama Lead<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Lead" name="nama_lead" value="{{$lead->nama_lead}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Alamat</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="alamat" id="" cols="30" rows="4">{{$lead->alamat}}</textarea>   
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">No. Telp<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="No. Hp" name="no_telp" value="{{$lead->no_telp}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">No. Hp<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="No. Hp" name="no_hp" value="{{$lead->no_hp}}" />
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-3">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Email" name="email" value="{{$lead->email}}" />
            </div>
        </div>

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>
    {{ Form::close() }}
</div>
<div class="panel-footer">  
    <span style="padding: 10px;"></span> 
    <a class="btn btn-border btn-alt border-primary font-black btn-xs pull-right" href="/lead"><i class="fa fa-backward"></i> Kembali</a>
</div>
@stop