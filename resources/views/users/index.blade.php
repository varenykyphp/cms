@extends('varenykyAdmin::app')

@section('title', __('varenyky::admin.users.index.title'))

@section('content_header')
    <strong>{{ __('varenyky::admin.users.index.title') }}</strong>
@stop

@section('create-btn', route('admin.users.create'))

@section('content')
    <div class="card border p-3">
        <table class="table">
            <thead>
                <tr class="">
                    <th>{{ __('varenyky::labels.id') }}</th>
                    <th>{{ __('varenyky::labels.name') }}</th>
                    <th>{{ __('varenyky::labels.email') }}</th>
                    <th>{{ __('varenyky::labels.role') }}</th>
                    <th width="350"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td align="right">
                            @include('varenykyAdmin::actions', ['route' => 'admin.users', 'entity' => $user])
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
