<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\ModelExtractor;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ApplicationProccessAction
{
    public function __construct(public array $applicationData)
    {
    }

    public function run(): Model|array|Collection
    {

        $admin = Auth::user();
        $adminId = $admin->id;

        $application = ModelExtractor::getModel($this->applicationData['type'], $this->applicationData['id']);

        if($application) {
            $application->approved_by = $adminId;
            $application->is_approved = true;
            $application->save();
        }

        $applicationArray = $application->toArray(); // Преобразуем данные приложения в массив

// Получаем гостей приложения и преобразуем их в массив
        $itemArray = [];
        foreach ($application->{$application->getType()} as $item) {
            $itemsArray[] = $item->toArray();
        }

        $departmentData = $application->user->department;

        $itemName = $application->application_type === 'Въезд' ? "number" : "name";

        $applicationType = $application->application_type;

        if ($applicationType === 'Проход') {
            $data = array_merge($applicationArray, ['guests' => $itemArray]);
            $data['guests'] = implode("\n", array_column($itemsArray, $itemName));
            $data['cars'] = '';
        } else if ($applicationType === 'Въезд') {
            $data = array_merge($applicationArray, ['cars' => $itemArray]);
            $data['cars'] = implode("\n", array_column($itemsArray, $itemName));
            $data['guests'] = '';
        } else if ($applicationType === 'Внос/Вынос') {
            $data = array_merge($applicationArray, ['equipment' => $itemArray]);
            $data['equipment'] = implode("\n", array_column($itemsArray, $itemName));
            $data['guests'] = '';
            $data['cars'] = '';
            if (isset($data['property-in-date']) && isset($data['property-out-date'])) {
                $data['start_date'] = $data['property-in-date'];
                $data['end_date'] = $data['property-out-date'];
                $data['object'] = ['object_in'=>$data['object_in'], 'object_out'=>$data['object_out']];
                unset($data['property-in-date'], $data['property-out-date']);
            } elseif (isset($data['property-out-date'])) {
                $data['start_date'] = $data['property-out-date'];
                $data['end_date'] = $data['property-out-date'];
                $data['object'] = ['object_out'=>$data['object_out']];
                unset($data['property-out-date']);
            } elseif (isset($data['property-in-date'])) {
                $data['start_date'] = $data['property-in-date'];
                $data['end_date'] = $data['property-in-date'];
                $data['object'] = ['object_in'=>$data['object_in']];
                unset($data['property-in-date']);
            }
        }

        if(!isset($data['contract_number'])) {
            $data['contract_number'] = '';
        }
        $keyToDelete = ['id', 'created_at', 'updated_at', 'user_id', 'is_approved', 'approved_by', 'viewed'];
        foreach ($keyToDelete as $key) {
            unset($data[$key]);
        }

        $data['department'] = $departmentData;
        $data['start_date'] = date_format(date_create($data['start_date']), 'd.m.Y');
        $data['end_date'] = date_format(date_create($data['end_date']), 'd.m.Y');
        if (!isset($data['time_range'])) {
            $data['time_range'] = '';
        }

        return $array = [
            $data['application_number'], $data['department'], '', $data['signed_by'], $data['start_date'], $data['end_date'],
            $data['time_range'], $data['object'], $data['application_type'], $data['purpose'], '',
            $data['contract_number'], '', $data['equipment'], $data['guests'], '', $data['cars'], '', '', $data['responsible_person'], $data['phone_number']
        ];
    }

    protected function getApplicationNumber(): string|null
    {

    }
}


