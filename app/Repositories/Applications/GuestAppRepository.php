<?php

namespace App\Repositories\Applications;


use App\Jobs\EmailNotificationsJobs\Guests\SendNewGuestApplicationNotification;
use App\Models\Application;
use App\Models\Guest;
use App\Repositories\AppRepository;
use Illuminate\Support\Facades\Log;


class GuestAppRepository extends AppRepository
{
    public function create(array $data)
    {
        $data = $this->GetApplicationCommonData($data);

        try {

            $newPeopleApplication = $this->peopleAppModel->create([
                'rooms' => $data['rooms'],
                'guests_count' => $data['guests_count'],
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
            $data['start_date'] = formatDate($data['start_date']);
            $data['end_date'] = formatDate($data['end_date']);

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

}
