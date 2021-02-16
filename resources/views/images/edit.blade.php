@extends('layouts.adminBase')

@section('content')
    <h3 class="page-title">@lang('quickadmin.images.title')</h3>
    
    {!! Form::model($image, ['method' => 'PUT', 'route' => ['admin.images.update', $image->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="fileupload fileupload-new {!! $errors->has('url') ? 'has-error' : '' !!} col-lg-6 col-lg-offset-4"
                         data-provides="fileupload">
                        <div class="fileupload-preview thumbnail" style="max-width: 300px; max-height: 250px;">
                            <img data-src="{{ asset($image->url) }}" src="{{ asset($image->url) }}" alt="{{ asset($image->url) }}">
                        </div>
                    </div>
                      <span class="btn btn-primary btn-file"><span
                                  class="fileupload-new">Selectioner une image</span><span class="fileupload-exists">Changer</span>
                          {!! Form::file('url') !!}
                      </span>
                            <a href="#" class="btn btn-warning fileupload-exists" data-dismiss="fileupload">Retirer</a>
                        </div>
                        {!! $errors->first('url', '<small class="help-block">:message</small>') !!}
                    </div>
                </div>
               {{-- <div class="col-xs-12 form-group">
                    {!! Form::label('category_id', trans('quickadmin.categories.title').'', ['class' => 'control-label']) !!}
                    {!! Form::select('category_id', $cats, old('category_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('category_id'))
                        <p class="help-block">
                            {{ $errors->first('category_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('produit_id', trans('quickadmin.produits.title').'', ['class' => 'control-label']) !!}
                    {!! Form::select('produit_id', $produits, old('produit_id'), ['class' => 'form-control']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('produit_id'))
                        <p class="help-block">
                            {{ $errors->first('produit_id') }}
                        </p>
                    @endif
                </div>--}}
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

