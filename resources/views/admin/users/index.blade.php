{{-- /resources/views/admin/users/index.blade.php --}}

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
                        <th>Registered On</th> {{-- ⭐️ NEW HEADER --}}
                        <th style="width: 100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="Avatar" class="img-circle img-size-32 mr-2">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=7F9CF5&background=EBF4FF"
                                            alt="Avatar" class="img-circle img-size-32 mr-2">
                                    @endif
                                    <div>
                                        <div class="font-weight-bold">{{ $user->name }}</div>
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if ($user->role === 'super_admin')
                                    <span class="badge badge-danger">Super Admin</span>
                                @elseif($user->role === 'admin')
                                    <span class="badge badge-warning">Manager</span>
                                @else
                                    <span class="badge badge-secondary">User</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Banned</span>
                                @endif
                            </td>

                            {{-- ⭐️ NEW COLUMN DATA --}}
                            <td>
                                {{ $user->created_at->format('j \of F, Y') }}
                            </td>

                            <td class="text-nowrap">
                                <a href="#" class="btn btn-info btn-xs" title="Edit User">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button type="button" class="btn btn-danger btn-xs ml-1 delete-user-btn"
                                    title="Delete User" data-user-id="{{ $user->id }}"
                                    data-user-name="{{ $user->name }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                {{-- Hidden form needed for DELETE request --}}
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
<script>
    // 1. Initialise Swal2 Listener on Delete Buttons
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-user-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');

                Swal.fire({
                    title: 'Are you absolutely sure?',
                    html: `You are about to delete the user: <strong>${userName}</strong>. This action can be undone by restoring the account.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, submit the hidden form
                        document.getElementById(`delete-form-${userId}`).submit();
                    }
                });
            });
        });
    });

    // 2. Display Flash Messages using Swal2 (Success/Error)
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    @endif
</script>
@stop
