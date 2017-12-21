@extends('backend.layouts.main')

@section('title', 'Permissions')
@section('content_header', 'Permissions')
@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="active"><i class="fa fa-ban"></i> @lang('cms.permissions')</li>
    </ol>
@endsection

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <a class="btn btn-default" href="{{ route('backendPermissionCreate') }}">@lang('cms.create')</a>
        </div>
        <div class="box-body table-responsive">
            {{ Form::open(['method' => 'GET', 'route' => 'backendPermissions']) }}
            <table class="table table-bordered table-condensed table-striped">
                <thead>
                    <tr>
                        <th class="text-right" colspan="4">
                            <div class="form-inline">
                                <div class="form-group">
                                    @lang('cms.per_page')
                                    @php ($limitOptions = ['10' => '10', '25' => '25', '50' => '50', '100' => '100'])
                                    {{ Form::select('limit', $limitOptions, $request->query('limit'), ['class' => 'input-sm']) }}

                                    @lang('cms.sort')
                                    @php ($sortOptions = ['name,ASC' => __('validation.attributes.name').' (A-Z)', 'name,DESC' => __('validation.attributes.name').' (Z-A)', 'guard_name,ASC' => __('validation.attributes.guard_name').' (A-Z)', 'guard_name,DESC' => __('validation.attributes.guard_name').' (Z-A)'])
                                    {{ Form::select('sort', $sortOptions, $request->query('sort'), ['class' => 'input-sm']) }}
                                </div>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th><input class="table_row_checkbox_all" type="checkbox" /></th>
                        <th>@lang('validation.attributes.name') {{ Form::text('name', $request->query('name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>@lang('validation.attributes.guard_name') {{ Form::text('guard_name', $request->query('guard_name'), ['class' => 'form-control input-sm']) }}</th>
                        <th>
                            <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search"></i></button>
                            <a class="btn btn-default btn-xs" href="{{ route('backendPermissions') }}"><i class="fa fa-repeat"></i></a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $i => $permission)
                        <tr>
                            <td align="center"><input class="table_row_checkbox" name="action_id[]" type="checkbox" value="{{ $permission->id }}" /></td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td align="center">
                                <a class="btn btn-default btn-xs" href="{{ route('backendPermissionUpdate', ['id' => $permission->id]) }}"><i class="fa fa-pencil"></i></a>
                                <a class="btn btn-danger btn-xs" href="{{ route('backendPermissionDelete', $permission->id) }}" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr><td align="center" colspan="4">@lang('cms.no_data')</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            {{ Form::select('action', ['' => __('cms.action'), 'delete' => __('cms.delete')], '', ['class' => 'input-sm']) }}
                            <button class="btn btn-default btn-xs" type="submit"><i class="fa fa-play-circle"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" colspan="4">{{ $permissions->appends($request->query())->links('vendor.pagination.default') }}</td>
                    </tr>
                </tfoot>
            </table>
            {{ Form::close() }}
        </div>
    </div>
@endsection
