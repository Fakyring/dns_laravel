<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CartsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        if (request()->isMethod('post')) {
            return [
                'id_user' => 'int|exists:users,id_user',
                'id_eq' => 'required|int|exists:equipments,id_eq',
                'count' => 'required|int|min:1|max:999999'
            ];
        } else {
            return [
                'id_user' => 'int|exists:users,id_user',
                'id_eq' => 'int|exists:equipments,id_eq',
                'count' => 'int|min:1|max:999999'
            ];
        }
    }
}
