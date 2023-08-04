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
                            @if ($setting->key == 'home')
                                <td><label>{{ ucwords(str_replace(['-'], [' '], $setting->key)) }}</label></td>
                                <td>
                                    <select name="{{ $setting->key }}" class="form-select"
                                        aria-label="Default select example">
                                        <option value="">{{ __('varenyky::labels.choice') }}</option>
                                        @foreach ($pages as $page)
                                            <option @if ($page->id == $setting->value) selected @endif
                                                value="{{ $page->id }}">{{ $page->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @elseif($setting->key == 'language')
                                <td><label>{{ ucwords(str_replace(['-'], [' '], $setting->key)) }}</label></td>
                                <td>
                                    <select name="{{ $setting->key }}" class="form-select"
                                        aria-label="Default select example">
                                        <option value="">{{ __('varenyky::labels.choice') }}</option>
                                        @foreach ($languages as $language)
                                            <option @if ($language->id == $setting->value) selected @endif
                                                value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            @else
                                <td><label>{{ ucwords(str_replace(['-'], [' '], $setting->key)) }}</label></td>
                                <td>
                                    <input type="text" required class="form-control" name="{{ $setting->key }}"
                                        value="{{ $setting->value }}"
                                        placeholder="{{ ucwords(str_replace(['-'], [' '], $setting->key)) }}">
                                </td>
                            @endif
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
    <div class="card border mt-5 p-3">
        <table class="table">
            <tbody>
                <tr>
                    <td>Languages</td>
                    <td><a class="btn btn-sm btn-secondary" href="{{ route('admin.languages.index') }}">Show</a></td>
                </tr>
                <tr>
                    <td>Countries</td>
                    <td><a class="btn btn-sm btn-secondary" href="{{ route('admin.countries.index') }}">Show</a></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
