@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menuItems.edit.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menuItems.edit.title') }}</strong>
@stop

@section('save-btn', route('admin.items.update', [$id, $item]))
@section('back-btn', route('admin.items.index', $id))

@section('content')

    <form action="{{ route('admin.items.update', [$id, $item]) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card border p-3">
                <div class="template-blocks"></div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="page_name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                        <input id="page_name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ $item->name }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="sort_order"
                            class="@if ($errors->has('sort_order')) text-danger @endif">{{ __('varenyky::labels.sort_order') }}</label>
                            <input type="number" step="1" required class="form-control" id="sort_order" name="sort_order" placeholder="{{ __('varenyky::labels.sort_order') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="page" class="form-label">{{ __('varenyky::labels.page') }}</label>
                        <select id="page" name="link" class="form-select mb-3" aria-label="Default select example">
                            @foreach ($pages as $page)
                                <option @if ($page->id == $item->link) selected @endif value="{{ $page->id }}">{{ $page->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="parent" class="form-label">{{ __('varenyky::labels.parent') }}</label>
                        <select name="parent" class="form-select mb-3" aria-label="Default select example">
                            <option value="0">{{ __('varenyky::labels.head') }}</option>
                            @foreach ($menuItems as $menuItem)
                                <option @if ($menuItem->parent == $item->parent) selected @endif value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="type"
                            class="@if ($errors->has('type')) text-danger @endif">{{ __('varenyky::labels.type') }}</label>
                        <select name="type" id="" class="form-select">
                            <option selected>{{ $item->type }}</option>
                            <option value="cms">cms</option>
                            <option value="link">link</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
