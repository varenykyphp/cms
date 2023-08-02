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
                        <label for="seo_snip">{{ __('varenyky::labels.seo_snip') }}</label>
                        <input id="seo_snip" name="seo_snip" placeholder="{{ __('varenyky::labels.seo_snip') }}..."
                            class="form-control" value="{{ old('seo_snip') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="seo_key">{{ __('varenyky::labels.seo_key') }}</label>
                        <input id="seo_key" name="seo_key" placeholder="{{ __('varenyky::labels.seo_key') }}..."
                            class="form-control" value="{{ old('seo_key') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="parent">{{ __('varenyky::labels.parent') }}</label>
                        <input id="parent" name="parent" placeholder="{{ __('varenyky::labels.parent') }}..."
                            class="form-control" value="{{ old('parent') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="seo_desc">{{ __('varenyky::labels.content') }}</label>
                        <textarea name="content" class="form-control" rows="5" id="floatingTextarea"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
