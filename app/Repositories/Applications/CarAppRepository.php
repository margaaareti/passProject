<?php

namespace App\Repositories\Applications;


use App\Models\Car;
use App\Models\CarApplication;
use App\Models\Counter;
use App\Models\PeopleApplication;
use App\Repositories\AppRepository;
use App\Repositories\GoogleSheetsRepository\CarAppSheets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CarAppRepository extends AppRepository
{

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {

        $data = $this->GetApplicationCommonData($data);

        try {
            $newCarApplication = $this->carAppModel->create($data);

            foreach ($data['cars'] as $car_number) {

                $car = new Car(['number' => $car_number]);

                $car->save();

                $newCarApplication->cars()->attach($car->id);
            }

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
        }

        try {
            $this->carAppSheets->create($data);
        } catch (\Exception $e) {
          Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
        }

        return $newCarApplication->id;

    }


   public function getAllCarApplications(): Collection
    {
        $userId = Auth::id();
        return $this->carAppModel->with('cars')->where('user_id', $userId)->get();
    }

    //Получаем конкретную заявку
    public function getCarApplication($id): CarApplication
    {
        $userId = Auth::id();
        return $this->carAppModel->where('user_id', $userId)->where('id', $id)->first();
    }
}
