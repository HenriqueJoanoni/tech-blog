@extends('layouts.admin')

@section('page_title', 'Posts Edit')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Editing Post: <b>{{ $post[0]->title }}</b></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-post') }}" method="post" id="updatePost" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" name="id" value="{{$post[0]->id}}" {{old($post[0]->id)}}>

                            <!-- Title Field -->
                            <div class="form-group mb-3">
                                <label for="postTitle">Title</label>
                                <input type="text" name="title" id="postTitle" class="form-control"
                                       value="{{ old('title', $post[0]->title) }}">
                                @error('title')
                                    <div id="titleError" class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Excerpt Field -->
                            <div class="form-group mb-3">
                                <label for="postExcerpt">Excerpt</label>
                                <input type="text" name="excerpt" id="postExcerpt" class="form-control"
                                       value="{{ old('excerpt', $post[0]->excerpt) }}">
                                @error('excerpt')
                                    <div id="excerptError" class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Content Field -->
                            <div class="form-group mb-3">
                                <label for="postContent">Content</label>
                                <x-forms.tinymce-editor
                                    id="postContent"
                                    name="postContent"
                                    class="form-control"
                                    content="{{ old('postContent', trim($post[0]->content)) }}"
                                    :plugins="['autoresize', 'link', 'image', 'code', 'table']"
                                    toolbar="undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table"
                                    options="
                                        height: 800,
                                        menubar: 'file edit view',
                                        content_style: 'body { font-family: sans-serif; }'
                                    "
                                />
                                @error('postContent')
                                    <div id="contentError" class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cover Upload Field -->
                            <div class="form-group mb-3">
                                <label for="postCover">Upload Cover</label>
                                <input type="file" name="cover" id="postCover" class="form-control-file">
                                @error('cover')
                                    <div id="coverError" class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Field -->
                            <div class="form-group mb-3">
                                <label for="postCategory">Edit Category</label>
                                <select name="category_id" id="postCategory" class="form-control">
                                    <option value="">Select a category...</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ old('category_id', $post[0]->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div id="categoryError" class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(auth()->user()->permission_id == config('app.admin_access'))
                                <!-- Author Field -->
                                <div class="form-group mb-3">
                                    <label for="postAuthor">Author</label>
                                    <input type="text" name="author" id="postAuthor" class="form-control" disabled
                                           value="{{ old('author', $post[0]->user->name) }}">
                                </div>
                            @endif

                            <!-- Buttons -->
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-success">Edit Post</button>
                                <a href="{{ route('admin.posts-management') }}" type="button" class="btn btn-danger">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
