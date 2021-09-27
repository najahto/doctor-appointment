@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Your appointments({{ $appointments->count() }})</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Date for</th>
                                    <th scope="col">Created date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $key=>$appointment)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ $appointment->doctor->name }}</td>
                                        <td>{{ $appointment->time }}</td>
                                        <td>{{ $appointment->date }}</td>
                                        <td>{{ $appointment->created_at }}</td>
                                        <td>
                                            @if ($appointment->status == 0)
                                                <span class="badge badge-primary status-badge">Not visited</span>
                                            @else
                                                <span class="badge badge-success status-badge">Cheked</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <td>You have no appointments</td>
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
    <style>
        .status-badge {
            font-size: 0.8rem;
            padding: 10px;
        }

    </style>
@endpush
