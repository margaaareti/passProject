<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuestAppRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'signed_by' => ['required', 'string', 'max:100'],
            'start_date' => ['required', 'date', 'after or equal:today'],
            'end_date' => ['required', 'after or equal: today'],
            'object' => ['required', 'string'],
            'purpose' => ['required', 'string', 'max:150'],
            'contract_number' => ['string', 'max:150'],
            'equipment' => ['required', 'string', 'max:250'],
            'guest' => ['required', 'string', 'max:250'],
            'phone_number' => ['required', 'string', 'regex:/^8[0-9]{10}$/', 'starts_with:89', 'size:11', 'min:11'],
        ];
    }
}
