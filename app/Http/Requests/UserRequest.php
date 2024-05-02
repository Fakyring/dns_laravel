<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array {
        if (request()->isMethod('post')) {
            return [
                'email' => 'required|email|max:100|min:10|',
                'password' => 'required|string|max:20|min:8',
                'name' => 'required|string|max:30|min:4',
                'role' => 'nullable|boolean'
            ];
        } else {
            return [
                'password' => 'string|max:20|min:8',
                'name' => 'string|max:30|min:4',
                'role' => 'nullable|boolean'
            ];
        }
    }
}
