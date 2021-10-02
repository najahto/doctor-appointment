<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Department;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $patients = User::where('role_id', 3)->count();
        $doctors = User::where('role_id', 1)->count();
        $prescriptions = Prescription::count();
        $bookings = Booking::count();
        $departments = Department::count();

        return view('admin.dashboard', compact('patients', 'doctors', 'prescriptions', 'bookings', 'departments'));
    }
}