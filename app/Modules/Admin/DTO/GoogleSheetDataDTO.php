<?php

namespace App\Modules\Admin\DTO;

class GoogleSheetDataDTO
{
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
    public string $car_numbers ='';
    public string $car_brand ='';
    public string $car_model = '';
    public string $responsible_person;
    public string $phone_number;

    public function __set($name,$value)
    {
        $this->{$name} = $value;
    }

}
