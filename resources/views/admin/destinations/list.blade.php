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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>List of Saved Destinations</h5>
                        <a href="#" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create Destination</a>
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
                                    <th>Actions</th>
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
                                    <td class="actions">
                                        <div class="dropdown shadow-sm">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                            <ul class="dropdown-menu shadow">
                                                <li>
                                                    <a href="{{ route('admin.destinations.show', ['id' => $destination->id]) }}" title="View Destination">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a style="cursor:pointer" class="update-resource-status" data-id="{{ $destination->id }}"
                                                       data-model="destination" title="Change Status">
                                                        @if($destination->status)
                                                            <i class="fas fa-toggle-on text-orange-dark" data-status="Active"></i>
                                                        @else
                                                            <i class="fas fa-toggle-off text-secondary" data-status="Inactive"></i>
                                                        @endif
                                                    </a>
                                                    <a href="{{ route('admin.destinations.edit', ['id' => $destination->id]) }}" title="Edit Destination">
                                                        <i class="fas fa-pen text-dark"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="delete-resource" data-id="{{ $destination->id }}"
                                                       data-model="destination"
                                                       title="Delete Destination"><i class="fas fa-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Vicinity</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
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
