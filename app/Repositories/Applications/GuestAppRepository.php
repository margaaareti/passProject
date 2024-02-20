<?php

namespace App\Repositories\Applications;


use App\Jobs\EmailNotificationsJobs\Guests\SendNewGuestApplicationNotification;
use App\Models\Application;
use App\Models\Guest;
use App\Models\PeopleApplication;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class GuestAppRepository extends AppRepository
{
    public function create(array $data)
    {
        $data = $this->GetApplicationCommonData($data);

        try {

            // Создание записи в таблице PeopleApplications
            $newPeopleApplication = $this->peopleAppModel->create([
                'rooms' => $data['rooms'], // Пример индивидуального поля
                'guests_count' => $data['guests_count'], // Пример индивидуального поля
                // Добавьте остальные индивидуальные поля заявки PeopleApplication
            ]);

            foreach ($data['guests'] as $guest_name) {
                $guest = new Guest(['name' => $guest_name]);
                $guest->save();
                $newPeopleApplication->guests()->attach($guest->id);
            }

            // Создание записи в общей таблице заявок
            $newApplication = Application::create(array_merge($data,[
                'applicationable_type' => $newPeopleApplication->getApplicationType(),
                'applicationable_id' => $newPeopleApplication->getApplicationId(),
            ]));

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }

        try {
            $data['start_date'] = $this->formatDate($data['start_date']);
            $data['end_date'] = $this->formatDate($data['end_date']);

            $this->guestAppSheets->create($data);

            try {
                dispatch(new SendNewGuestApplicationNotification($data));
            } catch (\Exception $e) {
                Log::error('Error sending email: ' . $e->getMessage());
                return $e->getMessage();
            }

        } catch (\Exception $e) {
            Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
            return $e->getMessage();
        }

        return $newApplication->id;

    }


    //Получаем коллецию заявок пользователя
    public function getAllApplications(): Collection
    {
        $userId = Auth::id();
        $applications = $this->application->with('applicationable.guests')->where('user_id', $userId)->get();
        return $applications;
    }

    //Получаем конкретную заявку
    public function getApplication($id): Application
    {
        $userId = Auth::id();
        return $this->application->where('user_id', $userId)->where('id', $id)->first();
    }
}
