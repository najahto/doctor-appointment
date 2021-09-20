@extends('layouts.admin.master')

@section('pageTitle', 'Edit Doctor - ' . config('app.name'))
<!-- start content -->
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2>Doctor</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Doctor</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <!-- left column -->
                    <div class="col-lg-12">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{ Session::get('success') }}</div>
                        @endif
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Edit Doctor</h6>
                            </div>
                            <!-- /.card-header -->

                            <!-- form start -->
                            <form action="{{ route('doctors.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Full name</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Doctor name" value="{{ $user->name }}">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" value="{{ $user->email }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="doctor password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <select class="form-control @error('gender') is-invalid @enderror"
                                                    name="gender">
                                                    @foreach (['male', 'female'] as $gender)
                                                        <option value="{{ $gender }}" @if ($user->gender == $gender) selected @endif>
                                                            {{ $gender }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Education</label>
                                                <input type="text" name="education"
                                                    class="form-control @error('education') is-invalid @enderror"
                                                    placeholder="Doctor highest degree" value="{{ $user->education }}">
                                                @error('education')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Address</label>
                                                <input type="text" name="address"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    placeholder="Doctor address" value="{{ $user->address }}">
                                                @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Specialist</label>
                                                <select name="department"
                                                    class="form-control @error('department') is-invalid  @enderror">
                                                    @foreach ($departments as $department)
                                                        @if ($user->department)
                                                            <option
                                                                {{ old('department', $user->department) == $department->name ? 'selected' : '' }}
                                                                value="{{ $department->name }}">
                                                                {{ $department->name }}
                                                            </option>
                                                        @else

                                                            <option value="{{ $department->name }}">
                                                                {{ $department->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach

                                                </select>

                                                @error('department')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Phone number</label>
                                                <input type="text" name="phone_number" placeholder="Phone Number"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    value="{{ $user->phone_number }}">
                                                @error('phone_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Picture</label>
                                                <input type="file"
                                                    class="form-control file-upload-info @error('picture') is-invalid @enderror"
                                                    placeholder="Upload Image" name="picture">
                                                <span class="input-group-append">
                                                </span>
                                                @error('picture')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Role</label>
                                            <select name="role_id"
                                                class="form-control @error('role_id') is-invalid @enderror">
                                                @foreach ($roles as $role)
                                                    <option
                                                        {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}
                                                        value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('role_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="exampleTextarea1">About</label>
                                                <textarea class="form-control @error('description') is-invalid @enderror"
                                                    id="exampleTextarea1" rows="4" name="description"
                                                    placeholder="description">{{ $user->description }}</textarea>

                                                @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button class="btn btn-secondary">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
