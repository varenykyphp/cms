@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menuItems.create.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menuItems.create.title') }}</strong>
@stop

@section('save-btn', route('admin.items.store', $menu_id))
@section('back-btn', route('admin.items.index', $menu_id))

@section('content')

    <form action="{{ route('admin.items.store', $menu_id) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card border p-3">
                    <div class="template-blocks">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                        <input id="name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="sort_order"
                            class="@if ($errors->has('sort_order')) text-danger @endif">{{ __('varenyky::labels.sort_order') }}</label>
                        <input id="sort_order" type="text" placeholder="{{ __('varenyky::labels.sort_order') }}..."
                            name="sort_order" class="form-control @if ($errors->has('sort_order')) is-invalid @endif"
                            value="{{ old('sort_order') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="link"
                            class="@if ($errors->has('link')) text-danger @endif">{{ __('varenyky::labels.link') }}</label>
                        <input id="link" type="text" placeholder="{{ __('varenyky::labels.link') }}..."
                            name="link" class="form-control @if ($errors->has('link')) is-invalid @endif"
                            value="{{ old('link') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="parent"
                            class="@if ($errors->has('parent')) text-danger @endif">{{ __('varenyky::labels.parent') }}</label>
                        <input id="parent" type="text" placeholder="{{ __('varenyky::labels.parent') }}..."
                            name="parent" class="form-control @if ($errors->has('parent')) is-invalid @endif"
                            value="{{ old('parent') }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="type"
                            class="@if ($errors->has('type')) text-danger @endif">{{ __('varenyky::labels.type') }}</label>
                        <select name="type" id="" class="form-select">
                            <option value="cms">cms</option>
                            <option value="link">link</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
