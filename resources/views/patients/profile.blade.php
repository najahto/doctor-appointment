@extends('layouts.app')

@section('content')
    <div class="container">

        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        {{-- User informations --}}
        <div class="row ">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">User Profile</div>

                    <div class="card-body">
                        <p>Name: {{ auth()->user()->name }}</p>
                        <p>Email: {{ auth()->user()->email }}</p>
                        <p>Gender: {{ auth()->user()->gender }}</p>
                        <p>Address: {{ auth()->user()->address ? auth()->user()->address : 'undefined' }}</p>
                        <p>Phone number: {{ auth()->user()->phone_number ? auth()->user()->phone_number : 'undefined' }}
                        </p>
                        <p>Bio: {{ auth()->user()->description ? auth()->user()->description : 'undefined' }}</p>

                    </div>
                </div>
            </div>

            {{-- Update user informations --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Update Profile</div>
                    <div class="card-body">
                        <form action="{{ route('profile.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ auth()->user()->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ auth()->user()->address }}">

                            </div>
                            <div class="form-group">
                                <label>Phone number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ auth()->user()->phone_number }}">

                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">select gender</option>
                                    <option value="male" @if (auth()->user()->gender === 'male')selected @endif>Male</option>
                                    <option value="female" @if (auth()->user()->gender === 'female')selected @endif>Female</option>
                                </select>
                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea name="description"
                                    class="form-control">{{ auth()->user()->description }}</textarea>

                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Upload user picture --}}
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Update Pictre</div>
                    <form action="{{ route('profile.picture') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="text-center mb-3">
                                @if (!auth()->user()->picture)
                                    <img src="{{ asset('/images/user-avatar.svg') }}" class="cirle-image">
                                @else
                                    <img src="{{ asset('storage/' . auth()->user()->picture) }}" class="cirle-image">
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="file" name="picture"
                                    class="form-control @error('picture') is-invalid @enderror">


                                @error('picture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('styles')
    <style>
        .cirle-image {
            border-radius: 50%;
            border: 3px solid #38c172;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

    </style>
@endpush
