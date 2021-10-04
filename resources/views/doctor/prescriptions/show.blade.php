@extends('layouts.admin.master')

@section('pageTitle', 'Prescription Detail - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Prescription Detail</h2>
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
                        <div class="card">
                            <div class="card-header py-3">
                                <div class="inline-header">
                                    <h6 class="m-0 font-weight-bold text-primary ">Prescription detail</h6>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Date</td>
                                            <td>{{ $prescription->booking->date }}</td>
                                        </tr>
                                        <tr>
                                            <td>Patient</td>
                                            <td>{{ $prescription->booking->patient->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Doctor</td>
                                            <td>{{ $prescription->booking->doctor->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Disease</td>
                                            <td>{{ $prescription->disease_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Symptoms</td>
                                            <td>{{ $prescription->symptoms }}</td>
                                        </tr>
                                        <tr>
                                            <td>Medicine</td>
                                            <td>{{ $prescription->medicine }}</td>
                                        </tr>
                                        <tr>
                                            <td>Proedure to use medicine</td>
                                            <td>{{ $prescription->procedure_to_use_medicine }}</td>
                                        </tr>
                                        <tr>
                                            <td>Feedback</td>
                                            <td>{{ $prescription->feedback }}</td>
                                        </tr>
                                        <tr>
                                            <td>Doctor sognature</td>
                                            <td>{{ $prescription->signature }}</td>
                                        </tr>
                                    </tbody>
                                </table>

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

    </style>
@endpush
