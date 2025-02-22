@extends('layouts.admin')

@section('page_title', 'Register New User')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Register New User</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form for inserting a new post -->
                        <form action="{{ route('admin.store-user') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <!-- Upload image -->
                                    <div class="avatar-upload">
                                        <div class="avatar-preview rounded-circle shadow-sm">
                                            <div id="imagePreview"
                                                 style="background-image: url('{{ asset('avatars/profile.png') }}');"></div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-3"
                                                onclick="document.getElementById('avatarUpload').click()">
                                            <i class="fas fa-camera"></i> Upload Profile Photo
                                        </button>
                                    </div>
                                    <input type="file" id="avatarUpload" name="avatar" class="d-none" accept="image/*"
                                           onchange="handleAvatarUpload(event)">
                                </div>

                                <div class="col-6">
                                    <!-- Name Field -->
                                    <div class="form-group mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               value="{{ old('name') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!-- Email Field -->
                                    <div class="form-group mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                               value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <!-- Password Field -->
                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"
                                               value="{{ old('password') }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Bio Field -->
                            <div class="form-group mb-3">
                                <label for="bio">Bio</label>
                                <textarea name="bio" id="bio" class="form-control" rows="10">{{ old('bio') }}</textarea>
                            </div>

                            <!-- Permission Field -->
                            <div class="form-group mb-3">
                                <label for="permission">Permission</label>
                                <select name="permission_id" id="permission" class="form-control">
                                    <option value="">Select a permission...</option>
                                    @foreach($permissions as $permission)
                                        <option
                                            value="{{ $permission->id }}" {{ old('permission_id') == $permission->id ? 'selected' : '' }}>
                                            {{ $permission->permission_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">Create User</button>
                                <a href="{{ route('admin.users') }}" type="button" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
