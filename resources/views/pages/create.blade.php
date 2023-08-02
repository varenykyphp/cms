@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.pages.create.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.pages.create.title') }}</strong>
@stop

@section('save-btn', route('admin.pages.store'))
@section('back-btn', route('admin.pages.index'))

@section('content')

    <form action="{{ route('admin.pages.store') }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
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
                        <label for="page_name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                        <input id="page_name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ old('name') }}">
                    </div>
                    <hr>
                    <div class="form-group mb-3">
                        <label for="seo_title">{{ __('varenyky::labels.seo_title') }}</label>
                        <input id="seo_title" name="seo_title" placeholder="{{ __('varenyky::labels.seo_title') }}..."
                            class="form-control" value="{{ old('seo_title') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="seo_desc">{{ __('varenyky::labels.seo_description') }}</label>
                        <input id="seo_desc" name="seo_desc" placeholder="{{ __('varenyky::labels.seo_description') }}..."
                            class="form-control" value="{{ old('seo_desc') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="parent" class="form-label">{{ __('varenyky::labels.parent') }}</label>
                        <select name="parent" class="form-select mb-3" aria-label="Default select example">
                            <option value="0">{{ __('varenyky::labels.head') }}</option>
                            @foreach ($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
@endsection
