@extends('admin.layouts.app')
@section('title', 'Destinations')
@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/datatables.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3>Destinations</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Destinations</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <!-- Flexible table width Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>List of Saved Destinations</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-8">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Vicinity</th>
                                    <th>Rating</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($destinations as $destination)
                                <tr>
                                    <td>{{ $destination->name }}</td>
                                    <td>{{ $destination->category->title }}</td>
                                    <td>{{ number_format($destination->price, 2) }}</td>
                                    <td>{{ $destination->vicinity }}</td>
                                    <td>{{ $destination->rating ?? 'N/A' }}</td>
                                </tr>
                                @endforeach

                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Location</th>
                                    <th>Vicinity</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Flexible table width  Ends-->
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('vendor/viho/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/viho/js/datatable/datatables/datatable.custom.js') }}"></script>
    @endpush
@endsection
