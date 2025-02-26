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
                        <!-- Form for inserting a new post -->
                        <form action="{{ route('admin.store-category') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <!-- Name Field -->
                                    <div class="form-group mb-3">
                                        <label for="category-name">Category Name</label>
                                        <input type="text" name="category-name" id="category-name" class="form-control"
                                               value="{{ old('category-name') }}" onkeydown="generateSlug()">
                                    </div>
                                </div>

                                <div class="col-3">
                                    <!-- Slug Field -->
                                    <div class="form-group mb-3">
                                        <label for="slug">Slug</label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                               value="{{ old('slug') }}" readonly>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <span>Create custom slug</span>
                                    <input type="checkbox" name="custom-slug" id="custom-slug"
                                           onclick="createCustomSlug()">
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
                                    <input type="file" id="category-icon" name="category-icon" class="d-none" accept="image/*"
                                           onchange="handleCategoryIconUpload(event)">
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
@endsection
