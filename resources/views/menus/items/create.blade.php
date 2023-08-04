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
            <div class="col-12 col-lg-12">
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
                            <input type="number" step="1" required class="form-control" id="sort_order" name="sort_order" placeholder="{{ __('varenyky::labels.sort_order') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="link" class="form-label">{{ __('varenyky::labels.link') }}</label>
                        <select name="link" class="form-select" aria-label="Default select example">
                            <option>{{ __('varenyky::labels.choice') }}</option>
                            @foreach ($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="parent" class="form-label">{{ __('varenyky::labels.parent') }}</label>
                        <select name="parent" class="form-select" aria-label="Default select example">
                            <option value="0">{{ __('varenyky::labels.head') }}</option>
                            @foreach ($menuItems as $menuItem)
                                <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                            @endforeach
                        </select>
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
