@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menu.index.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menus.index.title') }}</strong>
@stop

@section('create-btn', route('admin.menus.create'))

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
        @forelse ($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{$menu->slug }}</td>
                <td align="right">
                    <a href="{{ route( "admin.items.index",$menu->id) }}" class="btn btn-sm btn-dark me-1">
                        <i class="fa-solid fa-bars"></i> {{ __('varenyky::labels.items') }}
                    </a>
                    <a href="{{ route( "admin.menus.edit",$menu->id) }}" class="btn btn-sm btn-dark me-1">
                        <i class="fas fa-pencil me-2"></i>{{ __('varenyky::labels.edit') }}
                    </a>
                    <form action="{{ route(  "admin.menus.destroy",$menu->id) }}" id="deleteform" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt me-2"></i>{{ __('varenyky::labels.delete') }}</button>
                    </form>
                </td>
             
                {{-- <td align="right">@include('admin.layouts.actions', ['route' => 'admin.pages', 'entity' => $page])</td> --}}
            </tr>
        @empty
            <tr><td colspan="3">{{ __('varenyky::labels.empty') }}</td></tr>
        @endforelse
    </tbody>
</table>
@endsection