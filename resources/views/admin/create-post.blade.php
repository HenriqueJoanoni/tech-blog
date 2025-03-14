@extends('layouts.admin', ['tinymce' => true])

@section('page_title', 'Posts Insert')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Insert New Post</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form for inserting a new post -->
                        <form action="{{ route('admin.store-post') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Title Field -->
                            <div class="form-group mb-3">
                                <label for="postTitle">Title</label>
                                <input type="text" name="title" id="postTitle" class="form-control"
                                       value="{{ old('title') }}">
                            </div>

                            <!-- Excerpt Field -->
                            <div class="form-group mb-3">
                                <label for="postExcerpt">Excerpt</label>
                                <input type="text" name="excerpt" id="postExcerpt" class="form-control"
                                       value="{{ old('excerpt') }}">
                            </div>

                            <!-- Content Field -->
                            <div class="form-group mb-3">
                                <label for="postContent">Content</label>
                                <x-forms.tinymce-editor
                                    id="postContent"
                                    name="postContent"
                                    class="form-control"
                                    content="{{ old('postContent') }}"
                                    :plugins="['autoresize', 'link', 'image', 'code', 'table']"
                                    toolbar="undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table"
                                    options="
                                        height: 800,
                                        menubar: 'file edit view',
                                        content_style: 'body { font-family: sans-serif; }'
                                    "
                                />
                            </div>

                            <!-- Cover Upload Field -->
                            <div class="form-group mb-3">
                                <label for="postCover">Upload Cover</label>
                                <input type="file" name="cover" id="postCover" class="form-control-file">
                            </div>

                            <!-- Category Field -->
                            <div class="form-group mb-3">
                                <label for="postCategory">Category</label>
                                <select name="category_id" id="postCategory" class="form-control">
                                    <option value="">Select a category...</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">Create Post</button>
                                <a href="{{ route('admin.posts-management') }}" type="button" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
