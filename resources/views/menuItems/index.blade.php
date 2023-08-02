@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menuItems.index.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menuItems.index.title') }}</strong>
@stop

@section('create-btn', route('admin.items.create', $menu_id))
@section('back-btn', route('admin.menus.index'))

@section('content')
    <table class="table table-striped">
        <thead>
            <tr class="table-dark">
                <th>{{ __('varenyky::labels.name') }}</th>
                <th>{{ __('varenyky::labels.slug') }}</th></th>
                <th width="350"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menuItems as $menuItem)
                <tr>
                    <td>{{ $menuItem->name }}</td>
                    <td>{{ $menuItem->link }}</td>
                    <td align="right">
                        <a href="{{ route( "admin.items.edit", [$menu_id, $menuItem]) }}" class="btn btn-sm btn-dark me-1">
                        <i class="fas fa-pencil me-2"></i>{{ __('varenyky::labels.edit') }}
                        </a>
                        <form action="{{ route(  "admin.items.destroy", [$menu_id, $menuItem]) }}" id="deleteform" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt me-2"></i>{{ __('varenyky::labels.delete') }}</button>
                        </form>
                    </td>
                    {{-- <td align="right">@include('admin.layouts.actions', ['route' => 'admin.pages', 'entity' => $page])</td> --}}
                </tr>
            @empty
                <tr>
                    <td colspan="3">{{ __('varenyky::labels.empty') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
