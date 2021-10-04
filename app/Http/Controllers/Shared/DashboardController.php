<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Department;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role->name == 'patient') {
            return view('welcome');
        }

        $patients = User::where('role_id', 3)->count();
        $doctors = User::where('role_id', 1)->count();
        $prescriptions = Prescription::count();
        $bookings = Booking::count();
        $departments = Department::count();

        return view('admin.dashboard', compact('patients', 'doctors', 'prescriptions', 'bookings', 'departments'));
    }
}