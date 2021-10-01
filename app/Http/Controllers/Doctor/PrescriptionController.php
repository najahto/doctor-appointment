<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{

    public function index(Request $request)
    {
        date_default_timezone_set('Africa/Casablanca');

        $date = date('Y-m-d');

        if ($request->date) {
            $date = $request->date;
            $bookings = Booking::where('date', $date)->where('status', 1)
                ->where('doctor_id', auth()->user()->id)->paginate(15);
            return view('admin.prescriptions.index', compact('bookings', 'date'));
        }

        $bookings = Booking::where('date', $date)->where('status', 1)
            ->where('doctor_id', auth()->user()->id)->paginate(15);

        return view('admin.prescriptions.index', compact('bookings', 'date'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['medicine'] = implode(', ', $request->medicine);

        Prescription::create($data);

        return redirect()->back()->with('success', 'Prescription created successfully');
    }

    public function show($id)
    {
        // dd($id);
        $prescription = Prescription::findOrFail($id);

        return view('admin.prescriptions.show')->with('prescription', $prescription);
    }
}