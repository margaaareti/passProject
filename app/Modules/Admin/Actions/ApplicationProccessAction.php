<?php

namespace App\Modules\Admin\Actions;

use App\Models\Application;
use App\Models\Counter;
use App\Modules\Admin\DTO\GoogleSheetDataDTO;
use Illuminate\Support\Facades\Auth;

class ApplicationProccessAction
{

    protected string $date;

    public function __construct(
        public int $applicationId
    )
    {
        $this->date = date('d.m.Y');
    }

    public function run(): GoogleSheetDataDTO | array
    {

        $admin = Auth::user();
        $adminId = $admin->id;
        $sheetData = new GoogleSheetDataDTO();

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
        ]);

        if($applicationType === 'Внос/Вынос') {
            $equipmentData = '';
            foreach($data['applicationable']['properties'] as $property) {
                $equipmentData .= "{$property['name']} - {$property['quantity']} шт.\n";
            }
            $data['equipment'] = $equipmentData;
        }


        $keysToDelete = ['id', 'created_at', 'updated_at', 'user_id', 'is_approved', 'approved_by', 'viewed'];
        $data = array_diff_key($data, array_flip($keysToDelete));


        $data['department'] = $application->user->department;
        $data['start_date'] = date_format(date_create($data['start_date']), 'd.m.Y');
        $data['end_date'] = date_format(date_create($data['end_date']), 'd.m.Y');
        $data['time_range'] = $data['time_range'] ?? '';
        $data['contract_number'] = $data['contract_number'] ?? '';
        $data['application_number'] = $this->getAppNumber($application);

        if ($relatedModel->type === 'Внос-Вынос') {
            unset($data['object']);
            $data['object_in'] = $relatedModel->object_in;
            $data['object_out'] = $relatedModel->object_out;
        }

        foreach ($data as $key => $value) {
            $sheetData->{$key} = $value;
        }

        return $sheetData;
    }


    protected function getAppNumber(Application $application): string
    {
        $lastRecord = $application->latest()->first();

        //Получаем значение счетчика из базы данных
        $counter = Counter::first();
        if (!$counter) {
            $counter = new Counter(['value' => 0]);
            $counter->save();
        }

        if (
            ($lastRecord && $lastRecord->created_at->format('d.m.Y') == $this->date)
        ) {
            $counter->increment('value');
        } else {
            $counter->update(['value' => 1]);
        }
        $counter->save();

        $counter= $counter->value;

        // форматируем номер заявки в строку с нулями в начале
        $number = sprintf('%03d', $counter);

        return $this->date . '/' . $number;
    }

}


