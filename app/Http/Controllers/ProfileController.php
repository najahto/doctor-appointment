<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        return view('patients.profile');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'gender' => 'required'
        ]);
        User::where('id', auth()->user()->id)
            ->update($request->except('_token'));
        return redirect()->back()->with('success', 'Profile updated Successfully');
    }

    public function profilePicture(Request $request)
    {
        $this->validate($request, ['picture' => 'required|image|mimes:jpeg,jpg,png']);

        $picture_url = User::uploadPicture($request);

        $user = User::where('id', auth()->user()->id)->update(['picture' => $picture_url]);

        return redirect()->back()->with('success', 'Profile updated Successfully');
    }
}