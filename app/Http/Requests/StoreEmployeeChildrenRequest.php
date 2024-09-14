<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEmployeeChildrenRequest extends FormRequest
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
            'employee_id'=>"required|regex:/\d/",
            'first_name'=>'required|string|max:15',
            'last_name'=>'required|string|max:15',
            'employee_childern_image'=>'required|image|mimes:png,jpg|max:2048',
            'birth_date'=>'required|date',
            'email'=>'required|email|unique:employee_childrens,email|unique:employee_childrens,email',
            'password'=>'required|confirmed|max:12|min:8',
        ];
    }
}
