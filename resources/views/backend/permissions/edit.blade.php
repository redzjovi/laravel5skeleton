@extends('backend.layouts.main')

@section('title', __('cms.update'))
@section('content_header', __('cms.update'))
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('backend.permissions.index', request()->query()) }}">
                <i class="fa fa-ban"></i>@lang('cms.permissions')
            </a>
        </li>
        <li class="active">@lang('cms.update')</li>
    </ol>
@endsection

@section('content')
    <form action="{{ route('backend.permissions.update', $permission->id) }}" method="post">
        {{ method_field('PUT') }}
        <input name="id" type="hidden" value="{{ $permission->id }}" />
        @include('backend/permissions/_form')
    </form>
@endsection