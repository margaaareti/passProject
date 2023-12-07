<?php

namespace App\Repositories\Applications;


use App\Jobs\SendNewApplicationNotification;
use App\Models\CarApplication;
use App\Models\Counter;
use App\Models\Guest;
use App\Models\PeopleApplication;
use App\Repositories\AppRepository;
use App\Repositories\GoogleSheetsRepository\GuestAppSheets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class GuestAppRepository extends AppRepository
{

    public function create(array $data)
    {
        $data = $this->GetApplicationCommonData($data);

        $data['user_email'] = auth()->user()->email;

        $data['user_isu'] = auth()->user()->isu_number;

        $data['user_fullname'] = optional(auth()->user())->last_name . ' ' . optional(auth()->user())->name . ' ' . optional(auth()->user())->patronymic;

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
