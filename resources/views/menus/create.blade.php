@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menu.create.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menu.create.title') }}</strong>
@stop

@section('save-btn', route('admin.menus.store'))
@section('back-btn', route('admin.menus.index'))

@section('content')
   
        <form action="{{ route('admin.menus.store') }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
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
                    </div>
                </div>
            </div>
        </form>
    
@endsection
