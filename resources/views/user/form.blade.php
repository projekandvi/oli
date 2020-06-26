@extends('app')

@section('contentheader')
    @if($user->id)
        {{trans('core.editing')}} <b>{{$user->name}}</b>
    @else
        add new Staf
    @endif
@stop

@section('breadcrumb')
    <a href="{{route('staf.index')}}">Staf List</a>
     &nbsp;>&nbsp;
    edit {{$user->name}}
@stop



@section('main-content')

<div class="panel-body">

    <h3 class="title-hero">
        
            Add New Staf
        
    </h3>

    {!! Form::model($user, ['method' => 'post', 'files' => true, 'class' => 'form-horizontal bordered-row', 'id' => 'ism_form']) !!}

        <div class="form-group">
            <label class="control-label col-sm-3">Nama Staf<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Nama Staf" name="name" value="{{$user->name}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Email<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="email" class="form-control" placeholder="Email" name="email" value="{{$user->email}}" />
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Password<span class="required">*</span></label>
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="Password" name="password" value="{{$user->password}}" />
            </div>
        </div>

        

        <div class="bg-default content-box text-center pad20A mrg25T">
            <input class="btn btn-lg btn-primary" type="submit" id="submitButton" value="save" onclick="submitted()">
        </div>

    {{ Form::close() }}
</div>
@stop