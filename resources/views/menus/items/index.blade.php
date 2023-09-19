@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.menuItems.index.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.menuItems.index.title') }}</strong>
@stop

@section('create-btn', route('admin.menuItems.create', $menu_id))
@section('back-btn', route('admin.menus.index'))

@section('content')
<div class="card border p-3">
    <table class="table">
        <thead>
            <tr class="">
                <th>{{ __('varenyky::labels.name') }}</th>
                <th width="350"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($menuItems as $menuItem)
                <tr>
                    <td>{{ $menuItem->name }}</td>
                    <td align="right">
                        <a href="{{ route( "admin.menuItems.items.edit", [$menu_id, $menuItem]) }}" class="btn btn-sm btn-dark me-1">
                        <i class="fas fa-pencil me-2"></i>{{ __('varenyky::labels.edit') }}
                        </a>
                        <form action="{{ route(  "admin.menuItems.items.destroy", [$menu_id, $menuItem]) }}" id="deleteform" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt me-2"></i>{{ __('varenyky::labels.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">{{ __('varenyky::labels.empty') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
