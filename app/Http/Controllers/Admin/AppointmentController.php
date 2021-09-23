<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amTimes = Appointment::getAMWorkingTimes();
        $pmTimes = Appointment::getPMWorkingTimes();
        $appointments = Appointment::latest()->where('user_id', Auth::user()->id)->get();
        return view('admin.appointments.index', [
            'amTimes' => $amTimes,
            'pmTimes' => $pmTimes,
            'appointments' => $appointments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amTimes = Appointment::getAMWorkingTimes();
        $pmTimes = Appointment::getPMWorkingTimes();
        return view('admin.appointments.create', [
            'amTimes' => $amTimes,
            'pmTimes' => $pmTimes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'user_id' => Auth::user()->id,
            'date' => $request->date,
        ]);

        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time
            ]);
        }

        return redirect()->back()->with('success', 'Appointment created for ' . $request->date);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function check(Request $request)
    {
        $date = $request->date;
        $appointment = Appointment::where('date', $date)->where('user_id', auth()->user()->id)->first();
        if (!$appointment) {
            return redirect()->to('appointments')->with('error', 'Appointment time not available 
            for this date');
        }
        $appointmentId = $appointment->id;
        $times = Time::where('appointment_id', $appointmentId)->get();

        $amTimes = Appointment::getAMWorkingTimes();
        $pmTimes = Appointment::getPMWorkingTimes();

        return view('admin.appointments.index', [
            'date' => $date,
            'amTimes' => $amTimes,
            'pmTimes' => $pmTimes,
            'appointmentId' => $appointmentId,
            'times' => $times
        ]);
    }
    public function updateTime(Request $request)
    {
        $appointmentId =  $request->appointmentId;
        Time::where('appointment_id', $appointmentId)->delete();
        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointmentId,
                'time' => $time
            ]);
        }

        return redirect()->route('appointments.index')->with('success', 'Appointment time updated successfully');
    }
}