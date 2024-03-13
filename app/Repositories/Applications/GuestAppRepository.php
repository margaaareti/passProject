<?php

namespace App\Repositories\Applications;

use App\Models\Application;
use App\Models\Enums\ApplicationStatusEnum;
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
                'rooms' => $data['rooms'] ?? null,
                'guests_count' => $data['guests_count'],
            ]);

            foreach ($data['guests'] as $guest_name) {
                $guest = new Guest(['name' => $guest_name]);
                $guest->save();
                $newPeopleApplication->guests()->attach($guest->id);
            }

            unset($data['unset']);

            // Создание записи в общей таблице заявок
            $newApplication = Application::create(array_merge($data,[
                'applicationable_type' => $newPeopleApplication->getApplicationType(),
                'applicationable_id' => $newPeopleApplication->getApplicationId(),
                'status'=>ApplicationStatusEnum::new
            ]));


            try {
                $this->createAdditionalData($data);
            } catch (\Exception $e) {
                Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
                return $e->getMessage();
            }


        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }


        return $newApplication->id;
    }

}
