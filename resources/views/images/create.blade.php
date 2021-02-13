@extends('layouts.adminBase')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.categories.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.categories.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.categories.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>v
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop



<div class="fileinput fileinput-new {!! $errors->has('url') ? 'has-error' : '' !!}" data-provides="fileinput">
    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
    <div>
									  <span class="btn btn-default btn-file"><span class="fileinput-new">Selectioner une image</span><span class="fileinput-exists">Changer</span>
										  {!! Form::file('url') !!}
									  </span>
        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Retirer</a>
    </div>
    {!! $errors->first('logo', '<small class="help-block">:message</small>') !!}
    </di