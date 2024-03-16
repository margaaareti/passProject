<?php

namespace App\Modules\Admin\DTO;

class GoogleSheetDataDTO
{
    public string $app_id;
    public string $application_number;
    public string $department;
    public string $organization_name = '';
    public string $signed_by;
    public string $start_date;
    public string $end_date;
    public string $time_range = '';
    public ?string $object = null;
    public ?string $object_in = null;
    public ?string $object_out = null;
    public string $application_type;
    public string $purpose;
    public ?string $rooms = '';
    public string $equipment = '';
    public string $guests = '';
    public string $is_foreigner = '';
    public string $car_numbers = '';
    public string $car_brand = '';
    public string $car_model = '';
    public string $responsible_person;
    public string $phone_number;
    public string $user_email = '';
    public bool $with_letter = false;

    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    public function formatObject(): string
    {
        $object = $this->object;

        $object = str_replace('Кронверский,49', 'К49', $object);
        $object = str_replace('Ломоносова,9 лит.А', 'Л9 лит.А', $object);
        $object = str_replace('Ломоносова,9 лит.М (Главный вход)', 'Л9', $object);

        return $object;
    }
}