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
            'signed_by' => ['required', 'regex:/^[a-zA-Zа-яА-Я\s]+$/u', 'max:100'],
            'department' => ['required', 'alpha', 'max:100'],
            'start_date' => ['required', 'date', 'after or equal:today'],
            'end_date' => ['required', 'after or equal: today'],
            'time_start' => ['required_with:time_end','nullable', 'regex:/^\d{2}:\d{2}$/'],
            'time_end' => ['required_with:time_start','nullable', 'regex:/^\d{2}:\d{2}$/' ],
            'object' => ['required','array'],
            'rooms' => ['required','string'],
            'purpose' => ['required', 'string', 'max:150'],
            'contract_number' => ['string', 'max:150','nullable'],
            'equipment' => ['string', 'max:250', 'nullable'],
            'guests' => ['required', 'string', 'max:1000','regex:/^[^0-9]+$/'],
            'phone_number' => ['required', 'string', 'regex:/^8[0-9]{10}$/', 'starts_with:89', 'size:11', 'min:11'],
        ];
    }

    public function messages(): array
    {
        return [
            'signed_by.regex' => 'Поле "Кем одобрена заявка" должно содержать только буквы',
            'department' => 'Поле "Подразделение" может содержать только буквы',
            'guests.regex' => 'Поле "ФИО гостя" может содержать только буквы',
        ];
    }
}

