@php use App\Helpers\GeneralHandler; @endphp
@extends('layouts.admin')

@section('page_title', 'Users Management')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end position-relative py-4">
                        <h3 class="card-title">Welcome to Users Management Page</h3>
                        <div class="insert-post-btn">
                            <a class="btn btn-success" href="{{ route('admin.create-user') }}">Create User</a>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Bio</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Permission</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row"><?= $user->id ?></th>
                                <td><?= $user->name ?></td>
                                <td><?= $user->email ?></td>
                                <td>
                                    @if($user->bio)
                                        {{ GeneralHandler::str_limit_words($user->bio, 4) }}
                                        <a href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#user-bio-modal"
                                           data-bio="{{ $user->bio }}"
                                           data-user-name="{{ $user->name }}"> see more
                                        </a>
                                    @else
                                        {{ "N/A" }}
                                    @endif
                                </td>
                                <td><?= ($user->last_login_at) ? GeneralHandler::dateFmt($user->last_login_at, 'd/m/Y H:i:s') : "N/A" ?></td>
                                <td>{{ $user->permission->permission_title }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning"
                                       data-bs-toggle="modal"
                                       data-bs-target="#user-permission-modal"
                                       data-user-id="{{ $user->id }}"
                                       data-user-name="{{ $user->name }}"
                                       data-user-permission-id="{{ $user->permission_id }}"
                                       title="Change permissions">
                                        <i class="fa-solid fa-users-gear"></i>
                                    </a>
                                    <a href="{{ route('admin.edit-user', ['id' => $user->id]) }}" class="btn btn-primary" title="Edit user">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <a href="{{ route('admin.reset-password', ['id' => $user->id]) }}" class="btn btn-info" title="Reset password">
                                        <i class="fa fa-lock-open"></i>
                                    </a>
                                    <button class="btn btn-danger delete-user-btn" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('admin.partials.user-bio-modal')
        @include('admin.partials.user-permissions-modal')
        @if(session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });

                Toast.fire({
                    icon: "success",
                    title: "{{session('success')}}"
                })
            </script>
        @endif

        @if(session('error'))
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
        @endif
@endsection
