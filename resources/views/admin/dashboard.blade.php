@extends('layouts.admin')

@section('page_title', 'TechBlog Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Welcome to Admin Panel</h3>
                    </div>
                    <div class="card-body">
                        @push('scripts')
                            <script>
                                const data = {
                                    labels: @json($postViews->map(fn ($postViews) => $postViews->title)),
                                    datasets: [{
                                        label: 'Posts views',
                                        backgroundColor: 'rgb(13, 110, 253, 0.3)',
                                        data: @json($postViews->map(fn($postViews) => $postViews->views)),
                                    }]
                                };
                                const config = {
                                    type: 'bar',
                                    data: data
                                };
                                const myChart = new Chart(
                                    document.getElementById('myChart'),
                                    config
                                );
                            </script>
                        @endpush
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
