@inject('request', 'Illuminate\Http\Request')
@extends('layouts.adminBase')

@section('content')
    <h3 class="page-title">@lang('quickadmin.images.title')</h3>
    @can('image_create')
    <p>
        <a href="{{ route('admin.images.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('image_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.images.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.images.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($images) > 0 ? 'datatable' : '' }} @can('image_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('image_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.images.fields.url')</th>
                        <th>@lang('quickadmin.images.fields.alt')</th>
                        <th>@lang('quickadmin.images.fields.category')</th>
                        <th>@lang('quickadmin.images.fields.produit')</th>
                        @if( request('show_deleted') == 1 )
                        <th>Actions</th>
                        @else
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($images) > 0)
                        @foreach ($images as $image)
                            <tr data-entry-id="{{ $image->id }}">
                                @can('image_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan
                                <td field-key='url'>{{ $image->url }}</td>
                                <td field-key='alt'>{{ $image->alt }}</td>
                                <td field-key='category_id'>{{ $image->category->name }}</td>
                                <td field-key='produit_id'>{{ $image->produit->name }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('image_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.images.restore', $image->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('image_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.images.perma_del', $image->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('image_view')
                                    <a href="{{ route('admin.images.show',[$image->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('image_edit')
                                    <a href="{{ route('admin.images.edit',[$image->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('image_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.images.destroy', $image->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('image_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.images.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection