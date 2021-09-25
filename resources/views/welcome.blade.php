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
                        <button class="btn btn-success">Register as patient </button>
                        <button class="btn btn-secondary">Login </button>
                    </div>
                </div>
            </div>
        </Header>

        {{-- Find Doctor Section --}}
        <section class="mt-5">
            <div class="card">
                <div class="card-header">Find Doctors</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" id="">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block"><i class="fa fa-search mr-2"></i> Find
                                Doctors</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Find Doctor Section --}}
        <section class="mt-5">
            <div class="card">
                <div class="card-header">Doctor List</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width: 20%">#</th>
                                        <th scope="col" style="width: 20%">Picture</th>
                                        <th scope="col" style="width: 20%">Name</th>
                                        <th scope="col" style="width: 20M">Expertise</th>
                                        <th scope="col" style="width: 20%">Book</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td><button class="btn btn-success btn-block">Book Appointment</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
