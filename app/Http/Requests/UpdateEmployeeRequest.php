<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|string|max:15',
            'last_name'=>'required|string|max:15',
            'employee_image'=>'required|image|mimes:png,jpg|max:2048',
            'birth_date'=>'required|date',
            'email'=>'required|email',
            'password'=>'required|confirmed|max:12|min:8',
        ];
    }
}
