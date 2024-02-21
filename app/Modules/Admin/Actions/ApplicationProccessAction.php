<?php

namespace App\Modules\Admin\Actions;

use App\Models\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ApplicationProccessAction
{
    public function __construct(public int $applicationId)
    {
    }

    public function run(): Model|array|Collection
    {

        $admin = Auth::user();
        $adminId = $admin->id;

        $application = Application::findOrFail($this->applicationId);

        $application->update([
            'approved_by' => $adminId,
            'is_approved' => true
        ]);

        $relatedModel = $application->applicationable;

        // Получаем гостей приложения и преобразуем их в массив
        $itemArray = [];
        $applicationType = $application->application_type;

        if ($relatedModel) {
            $itemName = $application->application_type === 'Въезд' ? "number" : "name";
            $itemArray = collect($relatedModel->{$application->applicationable->getType()})->pluck($itemName)->toArray();
        }

        $data = array_merge($application->toArray(), [
            'guests' => $applicationType === 'Проход' ? implode("\n", $itemArray) : '',
            'cars' => $applicationType === 'Въезд' ? implode("\n", $itemArray) : '',
            'equipment' => $applicationType === 'Внос/Вынос' ? implode("\n", $itemArray) : '',
        ]);

        $itemName = $application->application_type === 'Въезд' ? "number" : "name";

        $applicationType = $application->application_type;

        $keysToDelete = ['id', 'created_at', 'updated_at', 'user_id', 'is_approved', 'approved_by', 'viewed'];
        $data = array_diff_key($data, array_flip($keysToDelete));

        $data['department'] = $application->user->department;
        $data['start_date'] = date_format(date_create($data['start_date']), 'd.m.Y');
        $data['end_date'] = date_format(date_create($data['end_date']), 'd.m.Y');
        $data['time_range'] = $data['time_range'] ?? '';
        $data['contract_number'] = $data['contract_number'] ?? '';


        if ($applicationType === 'Внос/Вынос') {
            if (isset($data['property-in-date'], $data['property-out-date'])) {
                $data['start_date'] = $data['property-in-date'];
                $data['end_date'] = $data['property-out-date'];
                $data['object'] = [
                    'object_in' => $data['object_in'],
                    'object_out' => $data['object_out']
                ];
                unset($data['property-in-date'], $data['property-out-date']);
            } elseif (isset($data['property-out-date'])) {
                $data['start_date'] = $data['property-out-date'];
                $data['end_date'] = $data['property-out-date'];
                $data['object'] = [
                    'object_out' => $data['object_out']
                ];
                unset($data['property-out-date']);
            } elseif (isset($data['property-in-date'])) {
                $data['start_date'] = $data['property-in-date'];
                $data['end_date'] = $data['property-in-date'];
                $data['object'] = [
                    'object_in' => $data['object_in']
                ];
                unset($data['property-in-date']);
            }
        }

        return $array = [
            $data['application_number'], $data['department'], '', $data['signed_by'], $data['start_date'], $data['end_date'],
            $data['time_range'], $data['object'], $data['application_type'], $data['purpose'], '',
            $data['contract_number'], '', $data['equipment'], $data['guests'], '', $data['cars'], '', '', $data['responsible_person'], $data['phone_number']
        ];
    }

}


