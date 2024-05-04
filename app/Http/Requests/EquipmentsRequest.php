<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EquipmentsRequest extends FormRequest {
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
                'name' => 'required|string|max:50|min:10',
                'type' => 'required|int|exists:types,id_type',
                'descr' => 'string|max:1000',
                'count' => 'required|int|min:0|max:999999',
                'price' => 'required|decimal:0,2|min:0|max:9999999'
            ];
        } else {
            return [
                'name' => 'string|max:50|min:10',
                'type' => 'int|exists:types,id_type',
                'descr' => 'string|max:1000',
                'count' => 'int|min:0|max:999999',
                'price' => 'decimal:0,2|min:0|max:9999999'
            ];
        }
    }
}
