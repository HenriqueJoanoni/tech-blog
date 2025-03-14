@php use App\Helpers\GeneralHandler; @endphp
@extends('layouts.admin')

@section('page_title', 'Edit User Profile')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-user-cog mr-2"></i>Edit User Profile
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Left Side - Profile Overview -->
                            <div class="col-md-3 border-right">
                                <div class="text-center">
                                    <div class="avatar-upload">
                                        <div class="avatar-preview rounded-circle shadow-sm">
                                            <div id="imagePreview"
                                                 style="background-image: url('{{ asset('storage/'.$user->avatar) ?? asset('avatars/profile.png') }}');">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-3"
                                                onclick="document.getElementById('avatarUpload').click()">
                                            <i class="fas fa-camera"></i> Change Photo
                                        </button>
                                    </div>

                                    <h4 class="mt-3 mb-0">{{ $user->name }}</h4>
                                    <p class="text-muted mb-0">{{ $user->email }}</p>
                                    <div class="badge bg-success mt-2">
                                        Last
                                        login: {{ ($user->last_login_at) ? GeneralHandler::dateFmt($user->last_login_at, 'd/m/Y H:i:s') : 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Right Side - Profile Form -->
                            <div class="col-md-9">
                                <form action="{{ route('admin.update-user', ['id' =>$user->id]) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="file" id="avatarUpload" name="avatar"
                                           class="d-none" accept="image/*" onchange="handleAvatarUpload(event)">

                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $user->name) }}">
                                            @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   value="{{ old('email', $user->email) }}">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="bio">Bio</label>
                                            <x-forms.tinymce-editor
                                                id="bio"
                                                name="bio"
                                                class="form-control"
                                                content="{!! old('bio', auth()->user()->bio) !!}"
                                                :plugins="['autoresize', 'link', 'image', 'code', 'table']"
                                                toolbar="undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table"
                                                options="
                                                    height: 800,
                                                    menubar: 'file edit view',
                                                    content_style: 'body { font-family: sans-serif; }'
                                                "
                                            />
                                        </div>

                                        <div class="col-12 border-top mt-4 pt-4">
                                            <h5 class="mb-3"><i class="fas fa-shield-alt mr-2"></i>Security Settings
                                            </h5>

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">New Password</label>
                                                    <input type="password" name="new_password"
                                                           class="form-control @error('new_password') is-invalid @enderror">
                                                    <small class="form-text text-muted">Minimum 8 characters</small>
                                                    <div id="passwordStrength" class="badge mt-2"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Confirm New Password</label>
                                                    <input type="password" name="new_password_confirmation"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Permission Field -->
                                        <div class="col-12 border-top mt-4 pt-4">
                                            <h5 class="mb-3">
                                                <i class="fa-solid fa-users-gear"></i> Change Permission
                                            </h5>

                                            <div class="col-5">
                                                <label for="permission">Permission</label>
                                                <select name="permission_id" id="permission" class="form-control">
                                                    <option value="">Select a permission...</option>
                                                    @foreach($permissions as $permission)
                                                        <option
                                                            value="{{ $permission->id }}" {{ old('permission_id', $user->permission_id) == $permission->id ? 'selected' : '' }}>
                                                            {{ $permission->permission_title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 text-end mt-4">
                                            <button type="submit" class="btn btn-primary px-5">
                                                <i class="fas fa-save mr-2"></i>Save Changes
                                            </button>
                                            <a class="btn btn-danger" href="{{ route('admin.users') }}">
                                                Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
