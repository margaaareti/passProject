<?php

namespace App\Repositories\Applications;


use App\Jobs\EmailNotificationsJobs\Guests\SendNewApplicationNotification;
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
            $newPeopleApplication = $this->peopleAppModel->create($data);

            foreach ($data['guests'] as $guest_name) {

                $guest = new Guest(['name' => $guest_name]);

                $guest->save();

                $newPeopleApplication->guests()->attach($guest->id);
            }

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }

        try {
            $data['start_date'] = date_format(date_create($data['start_date']), 'd.m.Y');
            $data['end_date'] = date_format(date_create($data['end_date']), 'd.m.Y');

            $this->guestAppSheets->create($data);

            try {
                dispatch(new SendNewApplicationNotification($data));
            } catch (\Exception $e) {
                Log::error('Error sending email: ' . $e->getMessage());
                return $e->getMessage();
            }

        } catch (\Exception $e) {
            Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
            return $e->getMessage();
        }

        return $newPeopleApplication->id;

    }



    //Получаем коллецию заявок пользователя
    public function getAllApplications(): Collection
    {
        $userId = Auth::id();
        return $this->peopleAppModel->with('guests')->where('user_id', $userId)->get();
    }

    //Получаем конкретную заявку
    public function getApplication($id): PeopleApplication
    {
        $userId = Auth::id();
        return $this->peopleAppModel->where('user_id', $userId)->where('id', $id)->first();
    }
}
