@extends('layouts.admin.master')

@section('pageTitle', 'Add Appointment - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Appointment time</h2>
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

                        <ul class="list-group mb-3">
                            @foreach ($errors->all() as $error)
                                <li class="list-group-item list-group-item-danger">
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="card card-primary mb-4">
                            <form action="{{ route('appointments.store') }}" method="POST">
                                @csrf
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Create appointment time</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="m-0 font-weight-bold text-secondary mb-3">Choose date</label>
                                                <input type="date" class="form-control" id="datepicker" name="date">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label
                                                    class="
                                                m-0 font-weight-bold text-secondary mb-2">Choose
                                                    AM time</label>
                                                <span style="float:right">
                                                    <input type="checkbox" name="select-all" id="select-all" /> Select All
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
                                                                            value="{{ $time . ' AM' }}">
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
                                                <label
                                                    class="
                                                m-0 font-weight-bold text-secondary mb-2">Choose
                                                    PM time</label>
                                            </div>
                                            <div class="form-group">
                                                <table class="table table-striped text-center">
                                                    <tbody>
                                                        @foreach (array_chunk($pmTimes, 3) as $chunk)
                                                            <tr>
                                                                @foreach ($chunk as $time)
                                                                    <td>
                                                                        <input type="checkbox" name="time[]"
                                                                            value="{{ $time . ' PM' }}">
                                                                        {{ $time . ' PM' }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
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
