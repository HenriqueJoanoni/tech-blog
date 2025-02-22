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
                                           data-user-name="{{ $user->name }}">
                                            see more
                                        </a>
                                    @else
                                        {{ "N/A" }}
                                    @endif
                                </td>
                                <td><?= ($user->last_login_at) ? GeneralHandler::dateFmt($user->last_login_at, 'd/m/Y H:i:s') : "N/A" ?></td>
                                <td>{{ $user->permission->permission_title }}</td>
                                <td>
                                    <a href="{{ route('admin.reset-password', ['id' => $user->id]) }}" class="btn btn-info" title="Edit">
                                        <i class="fa fa-lock-open"></i>
                                    </a>
                                    <a href="{{ route('admin.delete-user', ['id' => $user->id]) }}" class="btn btn-danger" title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @include('admin.partials.user-bio-modal')
@endsection
