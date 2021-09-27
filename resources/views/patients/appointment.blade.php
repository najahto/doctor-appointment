@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Doctor Information</div>
                    <div class="card-body">
                        <div class="doctor-image text-center mb-3">
                            <img src="{{ asset('/images/doctor-avatar.svg') }}" width="100px" class="cirle-image">
                        </div>
                        <div class="doctor-info">
                            <p> <b>Name:</b> {{ $doctor->name }}</p>
                            <p> <b>Degree:</b> {{ $doctor->education }}</p>
                            <p><b> Specialist:</b> {{ $doctor->department }} </p>
                        </div>
                    </div>

                </div>

            </div>
            <div class="
                            col-md-9">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif


                <form action="{{ route('book.appointment') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">{{ $date }}</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($times as $time)
                                    <div class="col-md-3">
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="time" value="{{ $time->time }}">
                                            <span>{{ $time->time }}
                                            </span>
                                        </label>
                                    </div>
                                    <input type="hidden" name="doctorId" value="{{ $doctor->id }}">
                                    <input type="hidden" name="appointmentId" value="{{ $time->appointment_id }}">
                                    <input type="hidden" name="date" value="{{ $date }}">
                                @endforeach
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block">Book Appointment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <style>
        label.btn {
            padding: 0;
        }

        label.btn input {
            opacity: 0;
            position: absolute;
        }

        label.btn span {
            text-align: center;
            padding: 6px 12px;
            display: block;
            min-width: 80px;
        }

        label.btn input:checked+span {
            background: #3490dc;
            color: #fff;
        }

    </style>
@endpush
