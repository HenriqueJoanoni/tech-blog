@php use App\Helpers\GeneralHandler; @endphp
@extends('layouts.admin')

@section('page_title', 'Posts Management')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end position-relative py-4">
                        <h3 class="card-title">Welcome to Posts Management Page</h3>
                        <div class="insert-post-btn">
                            <a class="btn btn-success" href="{{ route('admin.create-posts') }}">
                                <i class="fas fa-plus-circle"></i> Create Post
                            </a>
                        </div>
                    </div>
                    @if($posts->count() > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Title</th>
                                <th scope="col">Excerpt</th>
                                <th scope="col">Views</th>
                                <th scope="col">Category</th>
                                <th scope="col">Author</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated at</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <th scope="row">{{ $post->id }}</th>
                                    <td>{{ GeneralHandler::str_limit_words($post->title, 4) }}</td>
                                    <td>{{ GeneralHandler::str_limit_words($post->excerpt, 4) }}</td>
                                    <td>{{ $post->views ?? 0 }}</td>
                                    <td>{{ $post->category->category_name }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ GeneralHandler::dateFmt($post->created_at, 'd/m/Y') }}</td>
                                    <td>{{ GeneralHandler::dateFmt($post->updated_at, 'd/m/Y') }}</td>
                                    <td>
                                        <button type="button"
                                                class="btn btn-warning"
                                                onclick="updateVisibility(event, {{ $post->id }})">
                                            @if($post->is_visible == 0)
                                                <i class="fa fa-eye-slash"></i>
                                            @else
                                                <i class="fa fa-eye"></i>
                                            @endif
                                        </button>
                                        <a href="{{ route('admin.edit-post', ['id' => $post->id]) }}"
                                           class="btn btn-primary" title="Edit">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-danger delete-post-btn" data-post-id="{{ $post->id }}" data-post-name="{{ $post->title }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @if($posts->count() > 6)
                                <div class="align-self-center">
                                    {{ $posts->links('vendor.pagination.bootstrap-5') }}
                                </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <h4 class="text-muted mb-4">No posts found</h4>
                            <p class="text-secondary">You haven't created any posts yet. Click the button below to create your first post!</p>
                            <a class="btn btn-success" href="{{ route('admin.create-posts') }}">
                                <i class="fas fa-plus-circle"></i> Create Post
                            </a>
                        </div>
                    @endif
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
