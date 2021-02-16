@extends('layouts.adminBase')

@section('content')
    <h3 class="page-title">@lang('quickadmin.categories.title')</h3>
    
    {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.categories.update', $category->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

         <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.categories.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.categories.fields.description').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
                <label for="image_id" class="control-label col-lg-12">Ajouter une image</label>
                <div class="col-lg-6 col-xs-6 form-group">
                    <select name="image_id" id="image_id" class="form-control" required autofocus>
                        <option selected="selected" value="{{ $category->image->id }}" data-left="{{ asset($category->image->url) }}">{{ $category->image->url }}</option>
                        @foreach($images as $image)
                            <option value="{{ $image->id }}" data-left="{{ asset($image->url) }}">{{ asset($image->alt) }}</option>
                        @endforeach
                        <p class="help-block"></p>
                        @if($errors->has('image_id'))
                            <p class="help-block">
                                {{ $errors->first('image_id') }}
                            </p>
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 col-xs-6 form-group">
                    <input value="activate" id="activate_selectator1" type="button" class="btn btn-primary">
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('active', trans('quickadmin.categories.fields.active').'', ['class' => 'control-label']) !!}
                    {{Form::hidden('active',0)}}
                    {!! Form::checkbox('active', 1,$category->active ? 'checked = "checked"' : '', ['class' => 'switch-input']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('active'))
                        <p class="help-block">
                            {{ $errors->first('active') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    <script type="text/javascript">
        $(function () {
            var $activate_selectator = $('#activate_selectator1');
            $activate_selectator.click(function () {
                var $select = $('#image_id');
                if ($select.data('selectator') === undefined) {
                    $select.selectator({
                        labels: {
                            search: 'Search here...'
                        },
                        useDimmer: true,
                        searchFields: 'value text subtitle right'
                    });
                    $activate_selectator.val('destroy');
                } else {
                    $select.selectator('destroy');
                    $activate_selectator.val('activate');
                }
            });
            $activate_selectator.trigger('click');
        });
    </script>
@stop

