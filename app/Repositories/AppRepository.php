<?php

namespace App\Repositories;

use App\Jobs\EmailNotificationsJobs\Cars\SendNewCarApplicationNotification;
use App\Jobs\EmailNotificationsJobs\Guests\SendAddNewGuestNotification;
use App\Models\Application;
use App\Models\CarApplication;
use App\Models\Counter;
use App\Models\PeopleApplication;
use App\Models\PropertyApplication;
use App\Repositories\GoogleSheetsRepository\ApplicationsSheets;
use App\Repositories\GoogleSheetsRepository\CarAppSheets;
use App\Repositories\GoogleSheetsRepository\GuestAppSheets;
use App\Repositories\GoogleSheetsRepository\PropertyAppSheets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AppRepository
{
    protected string $date;

    public function __construct(
         protected PeopleApplication $peopleAppModel,
         protected CarApplication $carAppModel,
         protected PropertyApplication $propertyAppModel,
         protected Application $application,
         protected GuestAppSheets $guestAppSheets,
         protected CarAppSheets $carAppSheets,
         protected PropertyAppSheets $propertyAppSheets,

    ) {
        $this->date = date('d.m.Y');
    }


    protected function createApplication(array $data, Model $appModel, string $relationshipKey, string $relationshipModel)
    {

        $newCarApplication = $appModel->create([
            'cars_count' => $data['cars_count']
        ]);

        foreach ($data[$relationshipKey] as $car_number) {

            $modelClass = 'App\Models\\' . $relationshipModel;

            $model = new $modelClass(['number' => $car_number]);

            $model->save();

            $newCarApplication->{$relationshipKey}()->attach($model->id);
        }

        return Application::create(array_merge($data,[
            'applicationable_type'=> $newCarApplication ->getApplicationType(),
            'applicationable_id' => $newCarApplication->getApplicationId(),
        ]));
    }

    protected function createAdditionalData(array $data, ApplicationsSheets $appSheets)
    {
        $data = $this->formatDates($data);

        $appSheets->create($data);

        try {
            // Импорт правильного класса уведомлений в зависимости от типа заявки
            if ($data['selected_form'] === 'Guests') {
                dispatch(new SendAddNewGuestNotification($data));
            } elseif ($data['selected_form'] === 'Car') {
                dispatch(new SendNewCarApplicationNotification($data));
            }

        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    protected function formatDates(array $data, $outputFormat = 'd.m.Y'): array
    {
        $data['start_date'] = date_format(date_create($data['start_date']), $outputFormat);
        $data['end_date'] = date_format(date_create($data['end_date']), $outputFormat);

        return $data;
    }

    public function GetApplicationCommonData(array $data): array {

        $lastRecord = $this->application->latest()->first();

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

        $data['counter'] = $counter->value;

        // форматируем номер заявки в строку с нулями в начале
        $number = sprintf('%03d', $data['counter']);
        $data['application_number'] = $this->date . '/' . $number;

        $data['user_id'] = Auth::id();

        $data['user_fullname'] = optional(auth()->user())->last_name . ' ' . optional(auth()->user())->name . ' ' . optional(auth()->user())->patronymic;

        if (isset($data['object'])) {
            $data['object'] = implode("\n", $data['object']);
        }

        $data['user_email'] = auth()->user()->email;

        $data['user_isu'] = auth()->user()->isu_number;

        return $data;
    }

    public function getApplication($id): Application
    {
        $userId = Auth::id();
        return $this->application->where('user_id', $userId)->where('id', $id)->first();
    }

    public function getAllApplications(): Collection
    {
        $userId = Auth::id();
        return $this->application->where('user_id', $userId)->get();
    }

}
