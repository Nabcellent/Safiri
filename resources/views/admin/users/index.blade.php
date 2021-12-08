@extends('admin.layouts.app')
@section('title', 'Users')
@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/datatables.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3>Users</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                        <h5>List of all safiri users</h5>
                        <a href="#" class="btn btn-outline-primary"><i class="fas fa-plus"></i> Create User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-8">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Bookings</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td></td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ ucfirst($user->gender) }}</td>
                                        <td>{{ $user->phone ?? "N/A" }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->bookings_count }}</td>
                                        <td class="actions">
                                            <div class="dropdown shadow-sm">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu shadow">
                                                    <li>
                                                        <a href="{{ route('admin.users.show', ['id' => $user->id]) }}"
                                                           title="View Destination">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a style="cursor:pointer" class="update-resource-status"
                                                           data-id="{{ $user->id }}"
                                                           data-model="destination" title="Change Status">
                                                            @if($user->status)
                                                                <i class="fas fa-toggle-on text-orange-dark"
                                                                   data-status="Active"></i>
                                                            @else
                                                                <i class="fas fa-toggle-off text-secondary"
                                                                   data-status="Inactive"></i>
                                                            @endif
                                                        </a>
                                                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}"
                                                           title="Edit Destination">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="delete-resource"
                                                           data-id="{{ $user->id }}" data-model="user"
                                                           title="Delete User"><i class="fas fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Bookings</th>
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
        <script>
            const table = $('#basic-8').DataTable();

            table.on('order.dt search.dt', function () {
                table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                    cell["innerHTML"] = i + 1;
                });
            }).draw();
        </script>
    @endpush
@endsection
