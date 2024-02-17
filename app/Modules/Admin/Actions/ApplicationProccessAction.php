<?php

namespace App\Modules\Admin\Actions;

use App\Models\CarApplication;
use App\Models\PeopleApplication;
use App\Models\PropertyApplication;

class ApplicationProccessAction
{
    public function __construct(public array $applicationData)
    {}
    public function run(): array
    {
        $application = match ($this->applicationData['type']) {
            'car' => CarApplication::findOrFail($this->applicationData['id']),
            'property' => PropertyApplication::findOrFail($this->applicationData['id']),
            'people' => PeopleApplication::findOrFail($this->applicationData['id']),
        };

        $applicationArray = $application->toArray(); // Преобразуем данные приложения в массив

// Получаем гостей приложения и преобразуем их в массив
        $guestsArray = [];
        foreach ($application->guests as $guest) {
            $guestsArray[] = $guest->toArray();
        }

// Объединяем данные приложения и гостей в один массив
        $data = array_merge($applicationArray, ['guests' => $guestsArray]);

// Добавляем перенос строки после каждого гостя
        $data['guests'] = implode("\n", array_column($guestsArray, 'name'));

        return $data;

//        if ($data['application_type'] === "Въезд") {
//            $data['guests'] = '';
//            $data['cars'] = implode("\n", $data['cars']);
//            if (str_starts_with($data['object'], 'Ломоносова,9')) {
//                $data['object'] = 'Л9';
//            }
//        } elseif ($data['application_type'] === "Проход") {
//            $data['cars'] = '';
//            $data['guests'] = implode("\n", $data['guests']);
//        };


//      return  $array = [
//            $data['application_number'], $data['department'], '', $data['signed_by'], $data['start_date'], $data['end_date'],
//            $data['time_range'], $data['object'], $data['application_type'], $data['purpose'],'',
//            $data['contract_number'], '', $data['equipment'], $data['guests'],'', $data['cars'], '', '', $data['responsible_person'], $data['phone_number']
//        ];
    }

}
