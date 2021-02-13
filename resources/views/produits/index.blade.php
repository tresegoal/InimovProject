@inject('request', 'Illuminate\Http\Request')
@extends('layouts.adminBase')

@section('content')
    @include('partials/flash')
    <h3 class="page-title">@lang('quickadmin.produits.title')</h3>
    @can('produit_create')
    <p>
        <a href="{{ route('admin.produits.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    @can('produit_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.produits.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.produits.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($produits) > 0 ? 'datatable' : '' }} @can('produit_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('produit_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.produits.fields.name')</th>
                        <th>@lang('quickadmin.produits.fields.description')</th>
                        <th>@lang('quickadmin.produits.fields.price')</th>
                        <th>@lang('quickadmin.produits.fields.qte')</th>
                        <th>@lang('quickadmin.produits.fields.tva')</th>
                        <th>@lang('quickadmin.categories.title')</th>
{{--                        <th>@lang('quickadmin.produits.fields.image')</th>--}}
                        <th>@lang('quickadmin.produits.fields.active')</th>
                        @if( request('show_deleted') == 1 )
                        <th>@lang('quickadmin.qa_actions')</th>
                        @else
                        <th>@lang('quickadmin.qa_actions')</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($produits) > 0)
                        @foreach ($produits as $produit)
                            <tr data-entry-id="{{ $produit->id }}">
                                @can('produit_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan
                                <td field-key='name'>{{ $produit->name }}</td>
                                <td field-key='description'>{{ $produit->description }}</td>
                                <td field-key='priceHT'>{{ $produit->priceHT }}</td>
                                <td field-key='quantity'>{{ $produit->quantity }}</td>
                                <td field-key='tva'>{{ $produit->tva }}</td>
                                <td field-key='category'>{{ $produit->category->name }}</td>
{{--                                <td field-key='image'><img src="{{ asset('images/'. $produit->first_image->url) }}" width="60px" height="60px"/></td>--}}
                                <td field-key='active'>
                                    @if ($produit->active == 1)
                                        <span class="badge badge-primary" style="background-color: green;">Activé</span>
                                    @else
                                        <span class="badge badge-danger" style="background-color: #d9534f;">Suspendu</span>
                                    @endif
                                </td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('produit_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.produits.restore', $produit->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('produit_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.produits.perma_del', $produit->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('produit_view')
                                    <a href="{{ route('admin.produits.show',[$produit->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('produit_edit')
                                    <a href="{{ route('admin.produits.edit',[$produit->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('produit_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.produits.destroy', $produit->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @if ($produit->active == 1)
                                        <a href="{{ route('admin.produits.deactivate',['id' => $produit->id]) }}" class="btn btn-xs btn-success">@lang('quickadmin.qa_deactive')</a>
                                    @else
                                        <a href="{{ route('admin.produits.activate',['id'=> $produit->id]) }}" class="btn btn-xs btn-danger">@lang('quickadmin.qa_active')</a>
                                    @endif
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" >@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('produit_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.produits.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection