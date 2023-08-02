@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.pages.index.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.pages.index.title') }}</strong>
@stop

@section('create-btn', route('admin.pages.create'))

@section('content')
<table class="table table-striped">
    <thead>
        <tr class="table-dark">
            <th>{{ __('varenyky::labels.name') }}</th>
            <th>{{ __('varenyky::labels.slug') }}</th>
            <th width="350"></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pages as $page)
            <tr>
                <td>{{ $page->name }}</td>
                <td>{{$page->slug }}</td>
                <td align="right"> 
                    <a href="{{ route( "admin.pages.edit",$page->id) }}" class="btn btn-sm btn-dark me-1">
                    <i class="fas fa-pencil me-2"></i>{{ __('varenyky::labels.edit') }}
                    </a>
                    <form action="{{ route(  "admin.pages.destroy", $page->id) }}" id="deleteform" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt me-2"></i>{{ __('varenyky::labels.delete') }}</button>
                </form></td>
                
            </tr>
        @empty
            <tr><td colspan="3">{{ __('varenyky::labels.empty') }}</td></tr>
        @endforelse
    </tbody>
</table>
@endsection