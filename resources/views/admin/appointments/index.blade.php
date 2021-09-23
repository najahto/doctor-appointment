@extends('layouts.admin.master')

@section('pageTitle', 'Show Appointments - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Appointments time</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Appointment</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-lg-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif


                        @if (Session::has('error'))
                            <div class="alert alert-danger">{{ Session::get('error') }}</div>
                        @endif

                        <ul class="list-group mb-3">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="card card-primary mb-4">

                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Check appointment time</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <form action="{{ route('appointment.check') }}" method="POST">
                                                @csrf
                                                <label class="m-0 font-weight-bold text-secondary mb-3">Choose date</label>

                                                <div class="check-date">
                                                    <input type="date" class="form-control mr-2" id="datepicker" name="date"
                                                        required>
                                                    <button type="submit" class="btn btn-primary btn-icon-split">
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </span>
                                                        <span class="text">
                                                            Check
                                                        </span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                                @if (isset($date))
                                    <hr>
                                    <div class="timetable-date text-primary  text-center">
                                        Your timetable for: {{ $date }}
                                    </div>
                                @endif

                                @if (Route::is('appointment.check'))
                                    <form action="{{ route('update.times') }}" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label
                                                        class="
                                                m-0 font-weight-bold text-secondary mb-2">
                                                        Choose
                                                        AM time</label>
                                                    <span style="float:right">
                                                        <input type="checkbox" name="select-all" id="select-all" /> Select
                                                        All
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <table class="table table-striped text-center">
                                                        <tbody>
                                                            @foreach (array_chunk($amTimes, 3) as $chunk)
                                                                <tr>
                                                                    @foreach ($chunk as $time)
                                                                        <td>
                                                                            <input type="checkbox" name="time[]"
                                                                                value="{{ $time . ' AM' }}"
                                                                                @if (isset($times)){{ $times->contains('time', $time . ' AM') ? 'checked' : '' }} @endif>
                                                                            {{ $time . ' AM' }}
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="m-0 font-weight-bold text-secondary mb-2">
                                                        Choose PM time
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <table class="table table-striped text-center">
                                                        <tbody>
                                                            @foreach (array_chunk($pmTimes, 3) as $chunk)
                                                                <tr>
                                                                    @foreach ($chunk as $time)
                                                                        <td>
                                                                            <input type="checkbox" name="time[]"
                                                                                value="{{ $time . ' PM' }}"
                                                                                @if (isset($times)){{ $times->contains('time', $time . ' PM') ? 'checked' : '' }} @endif>
                                                                            {{ $time . ' PM' }}
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                            @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="appointmentId" value="{{ $appointmentId }}">

                                        <button type=" submit" class="btn btn-primary ">Update</button>
                                    </form>

                                @endif

                            </div>

                        </div>

                        {{-- Appointments list --}}
                        @if (!Route::is('appointment.check'))
                            <div class="card card-primary mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Your appointment time list:
                                        {{ count($appointments) }}<h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">

                                                <table class="table table-striped text-center">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Creator</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">View/Update</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($appointments as $appointment)
                                                            <tr>
                                                                <td>{{ $appointment->doctor->name }}</td>
                                                                <td>{{ $appointment->date }}</td>
                                                                <td>
                                                                    <form action="{{ route('appointment.check') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="date"
                                                                            value="{{ $appointment->date }}">
                                                                        <button class=" btn btn-primary">View /
                                                                            Update</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- End appointments list --}}
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('styles')
    <style>
        .check-date {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .timetable-date {
            font-size: 1.7rem;
        }

        input[type="checkbox"] {
            width: 1.1rem;
            height: 1.1rem;
        }

    </style>
@endpush

@push('scripts')
    <script>
        $('#select-all').click(function(event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
