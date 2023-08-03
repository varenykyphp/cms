@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.settings.index.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.settings.index.title') }}</strong>
@stop

@section('save-btn', route('admin.settings.update'))

@section('content')
    <div class="card border p-3">
        <form action="{{ route('admin.settings.update') }}" method="POST" id="nopulpForm" enctype="multipart/form-data">
            @csrf
            <table class="table">
                <thead>
                    <tr class="">
                        <th>{{ __('varenyky::labels.name') }}</th>
                        <th>{{ __('varenyky::labels.content') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($settings as $setting)
                        <tr>
                            <td><label>{{ ucwords(str_replace(['-'], [' '], $setting->key)) }}</label></td>
                            <td>
                                <input type="text" required class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}" placeholder="{{ ucwords(str_replace(['-'], [' '], $setting->key)) }}">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">{{ __('varenyky::labels.empty') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>
@endsection
