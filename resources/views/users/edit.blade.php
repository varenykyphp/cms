@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.users.edit.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.users.edit.title') }}</strong>
@stop

@section('save-btn', route('admin.users.update', $user))
@section('back-btn', route('admin.users.index'))

@section('content')
    <form action="{{ route('admin.users.update', $user) }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card border p-3">
                    <div class="form-group mb-3">
                        <label for="name"
                            class="@if ($errors->has('name')) text-danger @endif">{{ __('varenyky::labels.name') }}</label>
                        <input id="name" type="text" placeholder="{{ __('varenyky::labels.name') }}..."
                            name="name" class="form-control @if ($errors->has('name')) is-invalid @endif"
                            value="{{ $user->name }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="email"
                            class="@if ($errors->has('email')) text-danger @endif">{{ __('varenyky::labels.email') }}</label>
                        <input id="email" type="text" placeholder="{{ __('varenyky::labels.email') }}..."
                            name="email" class="form-control @if ($errors->has('email')) is-invalid @endif"
                            value="{{ $user->email }}">
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="@if ($errors->has('password')) text-danger @endif">{{ __('varenyky::labels.password') }}</label>
                        <input id="password" type="password" placeholder="{{ __('varenyky::labels.password') }}..."
                               name="password" class="form-control @if ($errors->has('password')) is-invalid @endif">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group mb-3">
                        <label class="font-weight-bold mb-2">{{ __('User Role') }}</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="adminRadio" value="admin"
                                {{ $user->role === 'admin' ? 'checked' : '' }}>
                            <label class="form-check-label" for="adminRadio">{{ __('Admin') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="editorRadio" value="editor"
                                {{ $user->role === 'editor' ? 'checked' : '' }}>
                            <label class="form-check-label" for="editorRadio">{{ __('Editor') }}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="ecomRadio" value="ecom"
                                {{ $user->role === 'ecom' ? 'checked' : '' }}>
                            <label class="form-check-label" for="ecomRadio">{{ __('Ecom') }}</label>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
@endsection
