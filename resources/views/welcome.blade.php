@extends('layouts.app')

@section('content')
    <div class="container">
        <Header>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <img src="{{ asset('/images/doctor-appointments.png') }}" draggable="false" width="400"
                        class="img-fluid select-disable ">
                </div>
                <div class="col-md-6 header-items">
                    <h1>Create an account & book your appointment</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque neque rerum provident sequi cumque,
                        corrupti at omnis, obcaecati officia eos inventore natus optio eaque asperiores fugit pariatur
                        aliquid
                        qui dicta?</p>

                    <div class="mt-3">
                        <a href="{{ route('register') }}"><button class="btn btn-success">Register as patient </button></a>
                        <a href="{{ route('login') }}"><button class="btn btn-secondary">Login </button></a>
                    </div>
                </div>
            </div>
        </Header>

        {{-- Date Picker Section --}}
        <find-doctors></find-doctors>
        {{-- Find Doctor Section --}}

    </div>
@endsection

@push('styles')
    <style>
        .header-items {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .select-disable {
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        .search-group {
            display: flex;
        }

    </style>
@endpush
