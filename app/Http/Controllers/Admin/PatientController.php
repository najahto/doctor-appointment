<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        date_default_timezone_set('Africa/Casablanca');

        if ($request->date) {
            $bookings = Booking::latest()->where('date', $request->date)->paginate(15);
            return view('admin.patients.index')->with('bookings', $bookings);
        }

        $bookings = Booking::latest()->where('date', date('Y-m-d'))->paginate(15);
        return view('admin.patients.index')->with('bookings', $bookings);
    }

    public function updateStatus($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = !$booking->status;
        $booking->save();

        return redirect()->back();
    }
}