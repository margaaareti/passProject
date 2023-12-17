<?php

namespace App\Repositories\Applications;


use App\Models\CarApplication;
use App\Repositories\AppRepository;
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
            $newCarApplication = $this->createApplication($data, $this->carAppModel, 'cars', 'Car');
        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }

        try {
            $this->createAdditionalData($data, $this->carAppSheets);
        } catch (\Exception $e) {
            Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
            return $e->getMessage();
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
