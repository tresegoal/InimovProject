@extends('layouts.adminBase')

@section('content')
    <h3 class="page-title">@lang('quickadmin.produits.title')</h3>
    
    {!! Form::model($produit, ['method' => 'PUT', 'route' => ['admin.produits.update', $produit->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

         <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.produits.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.produits.fields.description').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('priceHT', trans('quickadmin.produits.fields.price').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('priceHT', old('priceHT'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('priceHT'))
                        <p class="help-block">
                            {{ $errors->first('priceHT') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('quantity', trans('quickadmin.produits.fields.qte').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('quantity', old('quantity'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('quantity'))
                        <p class="help-block">
                            {{ $errors->first('quantity') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('tva', trans('quickadmin.produits.fields.tva').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('tva', old('tva'), ['class' => 'form-control', 'placeholder' => '', 'required' => 'required']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('tva'))
                        <p class="help-block">
                            {{ $errors->first('tva') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('category_id', trans('quickadmin.produits.fields.category').'', ['class' => 'control-label']) !!}
                    <select name="category_id" id="category_id" class="form-control" required autofocus>
                        <option selected="selected" value="{{ $produit->category->id }}">{{ $produit->category->name }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                     <span class="help-block">
                        <strong>{{ $errors->first('category_id') }}</strong>
                     </span>
                    @endif
                </div>
                <label for="image_id" class="control-label col-lg-12">Ajouter une image</label>
                <div class="col-lg-6 col-xs-6 form-group">
                    <select name="image_id[]" id="image_id" class="image_id form-control" size="1" required autofocus multiple="multiple">
                        @forelse($produit->images as $img)
                            <option selected="selected" value="{{ $img->id }}" data-left="{{ asset($img->url) }}">{{ $img->url }}</option>
                            <option value="">Selectionner une image</option>
                            @empty <option selected="selected" value="">Selectionner une image</option>
                        @endforelse
                        @forelse($images as $image)
                            <option value="{{ $image->id }}" data-left="{{ asset($image->url) }}">{{ asset($image->alt) }}</option>
                            @empty
                        @endforelse
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
                    {!! Form::label('active', trans('quickadmin.produits.fields.active').'', ['class' => 'control-label']) !!}
                    {{Form::hidden('active',0)}}
                    {!! Form::checkbox('active', 1,$produit->active ? 'checked = "checked"' : '', ['class' => 'switch-input']) !!}
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
                var $select = $('.image_id');
                if ($select.data('selectator') === undefined) {
                    $select.selectator({
                        showAllOptionsOnFocus: true,
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