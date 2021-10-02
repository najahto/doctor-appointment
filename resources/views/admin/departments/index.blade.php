@extends('layouts.admin.master')

@section('pageTitle', 'Departments - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Departments</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Departments</li>
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
                                    <h6 class="m-0 font-weight-bold text-primary ">Department Lists</h6>
                                    <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm "
                                        data-toggle="tooltip" data-placement="bottom" title="Add User"><i
                                            class="fas fa-plus"></i> Add Department</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (count($departments) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($departments as $key => $department)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $department->name }}</td>
                                                        <td>
                                                            <a href="{{ route('departments.edit', $department->id) }}"
                                                                class="btn btn-warning btn-circle btn-sm">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('departments.destroy', $department->id) }} "
                                                                style="display: inline" method="POST">
                                                                @csrf
                                                                @method("DELETE")
                                                                <a href="{{ route('departments.destroy', $department->id) }}"
                                                                    class="btn btn-danger btn-circle btn-sm btn-delete-resource redirect-after-confirmation"
                                                                    data-confirmation-message="Do you really want to delete?">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <!-- View Modal -->
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>
                                    <h5 style="color:#F00;">No Department to display</h5>
                                    </p>
                                @endif

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
