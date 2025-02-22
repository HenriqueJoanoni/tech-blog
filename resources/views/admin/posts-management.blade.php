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
                            <a class="btn btn-success" href="{{ route('admin.create-posts') }}">Create Post</a>
                        </div>
                    </div>
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
                                <th scope="row"><?= $post->id ?></th>
                                <td><?= $post->title ?></td>
                                <td><?= $post->excerpt ?></td>
                                <td><?= $post->views ?? "N/A" ?></td>
                                <td><?= $post->category->category_name ?></td>
                                <td><?= $post->author ?></td>
                                <td><?= GeneralHandler::dateFmt($post->created_at, 'd/m/Y') ?></td>
                                <td><?= GeneralHandler::dateFmt($post->updated_at, 'd/m/Y') ?></td>
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
                                    <a href="{{ route('admin.delete-post', ['id' => $post->id]) }}"
                                       class="btn btn-danger" title="Delete">
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
    </div>
@endsection
