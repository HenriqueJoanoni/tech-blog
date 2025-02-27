@extends('layouts.admin')

@section('page_title', 'Register New Category')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Register New Category</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form for inserting a new category -->
                        <form action="{{ route('admin.store-category') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="category-name">Category Name</label>
                                        <input type="text" name="category_name" id="category-name" class="form-control"
                                               value="{{ old('category_name') }}" onkeydown="generateSlug()">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                               value="{{ old('slug') }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <!-- Upload icon -->
                                    <div class="avatar-upload">
                                        <div class="avatar-preview rounded-circle shadow-sm">
                                            <div id="imagePreview"
                                                 style="background-image: url('{{ asset('avatars/application.png') }}');">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-3"
                                                onclick="document.getElementById('category-icon').click()">
                                            <i class="fas fa-camera"></i> Upload Category Icon
                                        </button>
                                    </div>
                                    <input type="file" id="category-icon" name="category_icon" class="d-none" accept="image/*"
                                           onchange="handleCategoryIconUpload(event)">
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="visibility">Visibility</label>
                                        <select name="is_available" id="visibility" class="form-control">
                                            <option value="">Select visibility</option>
                                            <option value="0">Not visible</option>
                                            <option value="1">Visible</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">Create category</button>
                                <a href="{{ route('admin.categories') }}" type="button" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
