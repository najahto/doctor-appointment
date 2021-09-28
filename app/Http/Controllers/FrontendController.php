<?php

namespace App\Http\Controllers;

use App\Http\Resources\AppointmentResource;
use App\Mail\AppointmentMail;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Time;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function todayDoctors(Request $request)
    {
        $appointments = Appointment::with('doctor')->whereDate('date', date('Y-m-d'))->get();

        return AppointmentResource::collection($appointments);
    }

    public function findDoctors(Request $request)
    {
        $appointments = Appointment::with('doctor')->whereDate('date', $request->date)->get();

        return AppointmentResource::collection($appointments);
    }

    public function createAppointment($doctorId, $date)
    {
        $appointment = Appointment::where('user_id', $doctorId)->where('date', $date)->first();
        $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();
        return view('patients.appointment', [
            'times' => $times,
            'date' => $date,
            'doctor' => User::findOrFail($doctorId),
        ]);
    }

    public function bookAppointment(Request $request)
    {
        date_default_timezone_set('Africa/Casablanca');

        $request->validate(['time' => 'required']);

        // Check if the patient already booked an appointment at the same date
        $check = $this->checkBookingTimeInterval();
        if ($check) {
            return redirect()->back()->with('error', 'You already booked an appointment! 
            Please wait to make next appointment. ');
        }

        $time = $request->time;
        $date = $request->date;
        Booking::create([
            'patient_id' => auth()->user()->id,
            'doctor_id' => $request->doctorId,
            'time' => $time,
            'date' => $date,
            'status' => 0,
        ]);

        Time::where('appointment_id', $request->appointmentId)->where('time', $time)
            ->update(['status' => 1]);

        // Send email notification to the patient
        $doctor = User::findOrFail($request->doctorId);
        $this->sendAppointmentEmail($date, $time, $doctor);

        return redirect()->back()->with('success', 'Your appointment was booked');
    }

    public function myBooking()
    {
        $appointments = Booking::where('patient_id', auth()->user()->id)->get();
        return view('patients.my-booking')->with('appointments', $appointments);
    }

    public function checkBookingTimeInterval()
    {
        return Booking::orderby('id', 'desc')
            ->where('patient_id', auth()->user()->id)
            ->whereDate('created_at', date('Y-m-d'))
            ->exists();
    }

    public function sendAppointmentEmail($date, $time, $doctor)
    {
        $mailData = [
            'name' => auth()->user()->name,
            'date' => $date,
            'time' => $time,
            'doctorName' => $doctor->name
        ];
        try {
            Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));
        } catch (Exception $e) { }
    }
}