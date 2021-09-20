@extends('layouts.admin.master')

@section('pageTitle', 'Doctors - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Doctors</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Doctors</li>
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
                                    <h6 class="m-0 font-weight-bold text-primary ">Doctor Lists</h6>
                                    <a href="{{ route('doctors.create') }}" class="btn btn-primary btn-sm "
                                        data-toggle="tooltip" data-placement="bottom" title="Add User"><i
                                            class="fas fa-plus"></i> Add Doctor</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (count($users) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Avatar</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Phone number</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Avatar</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Phone number</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>
                                                            @if ($user->picture)
                                                                <img src="{{ asset('storage/' . $user->picture) }}"
                                                                    height="50px" width="50px" class="cirle-image">
                                                            @else
                                                                <img src="{{ asset('admin-template/img/undraw_profile.svg') }}"
                                                                    alt="No picture to show" width="50px"
                                                                    class="cirle-image">
                                                            @endif
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->phone_number }}</td>
                                                        <td>
                                                            <a href="#" data-toggle="modal"
                                                                data-target="#detailModal{{ $user->id }}"
                                                                class="btn btn-info btn-circle btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('doctors.edit', $user->id) }}"
                                                                class="btn btn-warning btn-circle btn-sm">
                                                                <i class="fas fa-pen"></i>
                                                            </a>
                                                            <form action="{{ route('doctors.destroy', $user->id) }} "
                                                                style="display: inline" method="POST">
                                                                @csrf
                                                                @method("DELETE")
                                                                <a href="{{ route('doctors.destroy', $user->id) }}"
                                                                    class="btn btn-danger btn-circle btn-sm btn-delete-resource redirect-after-confirmation"
                                                                    data-confirmation-message="Do you really want to delete?">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <!-- View Modal -->
                                                    @include('admin.doctors.include.modal')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                @else
                                    <p>
                                    <h5 style="color:#F00;">No User to display</h5>
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
        .cirle-image {
            border-radius: 50%;
        }

        .image-display {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .picture-margin {
            margin-bottom: 20px;
        }

        .media {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: start;
            -ms-flex-align: start;
            align-items: flex-start;
        }

        .media-body {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        .text-black {
            color: #000000;
        }

        .font-weight-normal {
            font-weight: 500 !important;
        }

        .w-25 {
            width: 25% !important;
        }

        .text-muted {
            color: #b2b2b2 !important;
        }

        .mr-1,
        .mx-1 {
            margin-right: 0.625rem !important;
        }

    </style>
@endpush
