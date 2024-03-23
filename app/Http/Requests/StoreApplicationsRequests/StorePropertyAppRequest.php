<?php

namespace App\Http\Requests\StoreApplicationsRequests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'type' => ['required', Rule::in(['Внос','Вынос','Внос-Вынос'])],
            'department' => ['required', 'alpha', 'max:100'],
            'signed_by' => ['required', 'regex:/^[a-zA-Zа-яА-Я\s]+$/u', 'max:100'],
            'property-in-date' => [
                Rule::requiredIf(function () {
                    return $this->type === 'Внос';
                }),
                'date',
                'after_or_equal:today',
                'nullable',
            ],
            'property-out-date' => [
                Rule::requiredIf(function () {
                    return $this->type === 'Вынос';
                }),
                'date',
                'after_or_equal:today',
                'nullable',
            ],
            'object_in' => [
                Rule::requiredIf(function () {
                    return $this->type === 'Внос' || $this->type === 'Внос-Вынос';
                }),
            ],
            'object_out' => [
                Rule::requiredIf(function () {
                    return $this->type === 'Вынос' || $this->type === 'Внос-Вынос';
                })
            ],
            'rooms' => ['nullable','string'],
            'purpose' => ['required', 'string', 'max:150'],
            'contract_number' => ['nullable', 'string', 'max:150'],
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
            'object_in' => __('Поле "Локация для вноса" обязательно для заполнения'),
            'object_out' => __('Поле "Локация для выноса" обязательно для заполнения'),
        ];
    }
}
