<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DoctorRequest;
use App\Http\Requests\StoreDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.doctors.index")->with('users', User::where('role_id', '!=', 3)->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.doctors.create", [
            'roles' => Role::where('name', '!=', 'patient')->get(),
            'departments' => Department::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $data['picture'] = User::uploadPicture($request);

        User::create($data);

        return redirect()->route('doctors.index')->with('success', 'Doctor added successfully.');
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

        return view('admin.doctors.edit', [
            'user' => User::findOrFail($id),
            'roles' => Role::where('name', '!=', 'patient')->get(),
            'departments' => Department::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, $id)
    {
        $data = $request->all();
        $user = User::findOrFail($id);
        $image_url = $user->picture;
        $password = $user->password;

        // Check if the user uploaded a new picture
        if ($request->hasFile('picture')) {
            $image_url = User::uploadPicture($request);
        }
        $data['picture'] = $image_url;

        // Check if the user updated the password
        if ($request->password) {
            $password = bcrypt($request->password);
        }
        $data['password'] = $password;

        $user->update($data);
        return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete user picture 
        $image_url = $user->picture;
        if ($image_url) {
            User::removePicture($image_url);
        }

        $user->delete();

        return redirect()->back()->with('success', 'Doctor deleted successfully');
    }
}