{{-- resources/views/admin/users/index.blade.php --}}

@extends('adminlte::page')

@section('title', 'Users Management')

@section('content_header')
    <h1>Users List</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All Registered Users</h3>
            <div class="card-tools">
                <a href="#" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="Avatar" class="img-circle img-size-32 mr-2">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF" alt="Avatar" class="img-circle img-size-32 mr-2">
                                    @endif
                                    <div>
                                        <div class="font-weight-bold">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($user->role === 'super_admin')
                                    <span class="badge badge-danger">Super Admin</span>
                                @elseif($user->role === 'admin')
                                    <span class="badge badge-warning">Manager</span>
                                @else
                                    <span class="badge badge-secondary">User</span>
                                @endif
                            </td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Banned</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-info btn-xs">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            {{-- This renders the pagination links automatically --}}
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
@stop

@section('css')
    {{-- Custom CSS to fix pagination alignment if needed --}}
@stop

@section('js')
    <script> console.log('User List Loaded'); </script>
@stop
