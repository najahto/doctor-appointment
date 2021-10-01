@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Your prescriptions ({{ $prescriptions->count() }})</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Disease name</th>
                                    <th scope="col">Symptoms</th>
                                    <th scope="col">Medicine</th>
                                    <th scope="col">Proedure to use medicine</th>
                                    <th scope="col">Feedback</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prescriptions as $key=>$prescription)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $prescription->booking->date }}</td>
                                        <td>{{ $prescription->booking->doctor->name }}</td>
                                        <td>{{ $prescription->disease_name }}</td>
                                        <td>{{ $prescription->symptoms }}</td>
                                        <td>{{ $prescription->medicine }}</td>
                                        <td>{{ $prescription->procedure_to_use_medicine }}</td>
                                        <td>{{ $prescription->feedback }}</td>
                                    </tr>
                                @empty
                                    <td>You have no prescription</td>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
@endpush
