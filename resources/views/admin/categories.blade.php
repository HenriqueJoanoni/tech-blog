@php use App\Helpers\GeneralHandler; @endphp
@extends('layouts.admin')

@section('page_title', 'Categories Management')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-end position-relative py-4">
                        <h3 class="card-title">Welcome to Categories Management Page</h3>
                        <div class="insert-post-btn">
                            <a class="btn btn-success" href="{{ route('admin.create-category') }}">Create category</a>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row"><?= $category->id ?></th>
                                <td><?= $category->category_name ?></td>
                                <td><?= $category->category_slug ?></td>
                                <td>
                                    <div class="d-inline-block" style="width: 32px; height: 32px;">
                                        <img
                                            src="{{ ($category->icon) ? asset('storage/'.$category->icon) : asset('category-default/no-photo.png') }}"
                                            alt="{{ $category->category_name }}"
                                            class="w-100 h-100 object-fit-contain">
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('admin.update-category', ['id' => $category->id]) }}"
                                       class="btn btn-primary" title="Edit category">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button class="btn btn-danger delete-category-btn"
                                            data-category-id="{{ $category->id }}"
                                            data-category-name="{{ $category->category_name }}">
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
