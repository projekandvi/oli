@extends('app')

@section('contentheader')
Import Data Teknisi
@stop

@section('breadcrumb')
    <a href="{{route('slipOrder.index')}}">Teknisi</a>
     &nbsp;/&nbsp;
     Import Data Teknisi
@stop

@section('main-content')

<div class="panel-body">
    <h3 class="title-hero">Import Data Teknisi</h3>
    <form role="form" action="/simpanUploadTeknisi" method="POST" class="form-horizontal bordered-row" id="ism_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="control-label col-sm-3">File Upload excel<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="file" class="form-control"  name="unggahan" />
            </div>
        </div>
        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>
    </form>
</div>
@stop