@extends('admin.layouts.app')
@section('title', 'Bookings')
@push('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/datatables.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3>Bookings</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
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
                        <h5>List of all safiri bookings</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-8">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Destination</th>
                                    <th>Guests</th>
                                    <th>Dates</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($bookings as $booking)
                                    <?php
                                    $status = $booking->is_paid
                                        ? ['icon' => 'check', 'color' => 'success']
                                        : ['icon' => 'stream', 'color' => 'warning'];
                                    ?>

                                    <tr>
                                        <td></td>
                                        <td>{{ $booking->user->email }}</td>
                                        <td>{{ $booking->destination->name }}</td>
                                        <td>{{ $booking->guests ?? "N/A" }}</td>
                                        <td>{{ $booking->dates }}</td>
                                        <td>{{ number_format($booking->total, 2) }}</td>
                                        <td class="status py-2 align-middle text-center fs-0 white-space-nowrap">
									<span class="badge badge rounded-pill d-block badge-soft-{{ $status['color'] }}">
										{{ $booking->is_paid ? "Paid" : "Pending" }}
										<span class="ms-1 fas fa-{{ $status['icon'] }}"
                                              data-fa-transform="shrink-2"></span>
									</span>
                                        </td>
                                        <td class="actions">
                                            <div class="dropdown shadow-sm">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>
                                                <ul class="dropdown-menu shadow">
                                                    <li>
                                                        <a href="{{ route('admin.bookings.show', ['id' => $booking->id]) }}"
                                                           title="View Destination">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="delete-resource"
                                                           data-id="{{ $booking->id }}" data-model="destination"
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
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Destination</th>
                                    <th>Guests</th>
                                    <th>Dates</th>
                                    <th>Total</th>
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
