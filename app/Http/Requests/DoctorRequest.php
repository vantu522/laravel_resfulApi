<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
        $doctorId = $this->route('id');
        return [
            'full_name' => 'required|string|max:255',
            'specialization' => 'required|string',
            'phone_number' => 'required|string|unique:doctors,phone_number,'.$doctorId.'|max:15',
            'address' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.unique' => 'Số điện thoại đã tồn tại, vui lòng nhập lại.',
        ];
    }
}
