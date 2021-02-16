@extends('layouts.adminBase')

@section('content')
    <h3 class="page-title">@lang('quickadmin.images.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.images.store'], 'files'=> true]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="fileupload fileupload-new {!! $errors->has('url') ? 'has-error' : '' !!} col-lg-6 col-lg-offset-4"
                         data-provides="fileupload">
                        <div class="fileupload-preview thumbnail" style="max-width: 300px; max-height: 250px;"></div>
                    <div>
                      <span class="btn btn-primary btn-file"><span
                                  class="fileupload-new">Selectioner une image</span><span class="fileupload-exists">Changer</span>
                          {!! Form::file('url') !!}
                      </span>
                            <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Retirer</a>
                        </div>
                        {!! $errors->first('url', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

