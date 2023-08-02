@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menu.edit.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menu.edit.title') }}</strong>
@stop

@section('save-btn', route('admin.menus.update', $menu))
@section('back-btn', route('admin.menus.index'))

@section('content')
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="page_name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                        <input id="page_name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ $menu->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="page_name"
                            class="@if ($errors->has('slug')) text-danger @endif">{{ __('varenyky::labels.slug') }}</label>
                        <input id="slug" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="slug" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ $menu->name }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
