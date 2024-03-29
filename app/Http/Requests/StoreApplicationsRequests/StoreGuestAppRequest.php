<?php

namespace App\Http\Requests\StoreApplicationsRequests;

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
            'time_start' => ['nullable', 'required_with:time_end', 'regex:/^\d{2}:\d{2}$/'],
            'time_end' => ['nullable', 'required_with:time_start', 'regex:/^\d{2}:\d{2}$/' ],
            'object' => ['required','array'],
            'rooms' => ['nullable','string'],
            'purpose' => ['required', 'string', 'max:150'],
            'contract_number' => ['nullable', 'string', 'max:150'],
            'equipment' => ['nullable','string', 'max:250'],
            'guests' => ['required', 'string', 'max:1000','regex:/^[^0-9]+$/'],
            'responsible_person' => ['required'],
            'phone_number' => ['required', 'string', 'regex:/^8-[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}$/', 'starts_with:8'],
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
            'responsible_person.required' => 'ФИО ответственного лица обязательны!',
            'phone_number.required' => 'Контактные данные ответственного лица обязательны!',
        ];
    }
}

