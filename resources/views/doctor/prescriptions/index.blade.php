@extends('layouts.admin.master')

@section('pageTitle', 'Prescriptions - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Prescriptions</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Prescriptions</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif

                        <div class="card">
                            <div class="card-header py-3">
                                <div class="inline-header">
                                    <h6 class="m-0 font-weight-bold text-primary ">My Patiets List</h6>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="filter mb-4">
                                    <form action="{{ route('prescriptions') }}" method="GET">
                                        <label>Filter:</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="date" class="form-control" name="date"
                                                    value="{{ $date }}">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary"><i class="fa fa-search mr-2"></i>
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Picture</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Prescription</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($bookings as $key=>$booking)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>
                                                    @if ($booking->patient->picture)
                                                        <img src="{{ asset('storage/' . $booking->patient->picture) }}"
                                                            height="50px" width="50px" class="cirle-image">
                                                    @else
                                                        <img src="{{ asset('admin-template/img/undraw_profile.svg') }}"
                                                            alt="No picture to show" width="50px" class="cirle-image">
                                                    @endif
                                                </td>
                                                <td>{{ $booking->patient->name }}</td>
                                                <td>{{ $booking->patient->phone_number }}</td>
                                                <td>{{ $booking->patient->gender }}</td>
                                                <td>{{ $booking->doctor->name }}</td>
                                                <td>{{ $booking->date }}</td>
                                                <td>{{ $booking->time }} </td>
                                                <td>
                                                    @if (!$booking->prescription)
                                                        <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#prescriptionModal{{ $booking->patient_id }}">Write
                                                            Prescription
                                                        </button>

                                                        @include('doctor.prescriptions.modal')
                                                    @else
                                                        <a href="{{ route('prescription.show', $booking->prescription->id) }}"
                                                            class="btn btn-info"> View Prescription</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <td>There is no appointment on: {{ $date }} </td>
                                        @endforelse

                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-center">
                                    {!! $bookings->links() !!}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('styles')
    <style>
        .status-badge {
            font-size: 0.8rem;
            padding: 10px;
        }

        .cirle-image {
            border-radius: 50%;
        }

    </style>
@endpush
@push('scripts')
    <script type="text/javascript">
        // add medicine input dynamically 
        $("#addRow").click(function() {
            var html = '';
            html += '<div id="inputFormRow">';
            html += '<div class="input-group mb-3">';
            html +=
                '<input type="text" name="title[]" class="form-control m-input" placeholder="Enter medicine name" autocomplete="off">';
            html += '<div class="input-group-append">';
            html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';

            $('#newRow').append(html);
        });

        // remove row
        $(document).on('click', '#removeRow', function() {
            $(this).closest('#inputFormRow').remove();
        });
    </script>
@endpush
