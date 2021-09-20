<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255|unique:users',
            'password' => 'required|string|min:8|max:50',
            'gender' => 'required|string',
            'education' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'department' => 'required|string',
            'phone_number' => 'required|numeric',
            'role_id' => 'required',
            'description' => 'required|string|max:255',
            'picture' => 'image|mimes:jpeg,jpg,png',
        ];
    }
}