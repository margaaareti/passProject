<?php

namespace App\Http\Requests\StoreApplicationsRequests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyAppRequest extends FormRequest
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
            'department' => ['required', 'alpha', 'max:100'],
            'signed_by' => ['required', 'regex:/^[a-zA-Zа-яА-Я\s]+$/u', 'max:100'],
            'property-in-date' => ['required_without:property-out-date', 'date', 'after or equal:today', 'nullable'],
            'property-out-date' => ['required_without:property-in-date', 'date', 'after or equal: today', 'nullable'],
            'object_out' => ['required_without:object_in'],
            'object_in' => ['required_without:object_out'],
            'rooms' => ['nullable','string'],
            'purpose' => ['required', 'string', 'max:150'],
            'contract_number' => ['nullable', 'string', 'max:150'],
            'equipment' => ['required','string', 'max:250'],
            'responsible_person' => ['required'],
            'phone_number' => ['required', 'string', 'rege/^8-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/', 'starts_with:8'],
            'additional_info' => ['nullable','max:300'],
        ];
    }

    public function messages(): array
    {
        return [
            'signed_by.regex' => 'Поле "Кем одобрена заявка" должно содержать только буквы',
            'department' => 'Поле "Подразделение" может содержать только буквы',
            'guests.regex' => 'Поле "ФИО гостя" может содержать только буквы',
            'phone_number.regex' => 'Телефон должен быть формата 8-XXX-XXX-XX-XX',
        ];
    }
}
