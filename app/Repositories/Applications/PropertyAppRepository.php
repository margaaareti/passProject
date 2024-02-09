<?php

namespace App\Repositories\Applications;

use App\Models\PropertyApplication;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PropertyAppRepository extends AppRepository
{

    public function create(array $data, array $propertiesList)
    {

        $data = $this->GetApplicationCommonData($data);

        try {

            $newPropertyApplication = $this->propertyAppModel->create($data);

            $newPropertyApplication->properties()->createMany($propertiesList);

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }

        try {
            if (isset($data['property-in-date'])) {
                $data['property-in-date'] = $this->formatDate($data['property-in-date']);
            }

            if (isset($data['property-out-date'])) {
                $data['property-out-date'] = $this->formatDate($data['property-out-date']);
            }

            $this->propertyAppSheets->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }
        return $newPropertyApplication->id;
    }


    public function getAllApplications(): Collection
    {
        $userId = Auth::id();
        return $this->propertyAppModel->where('user_id', $userId)->get();
    }

    //Получаем конкретную заявку
    public function getApplication($id): PropertyApplication
    {
        $userId = Auth::id();
        return $this->propertyAppModel->where('user_id', $userId)->where('id', $id)->first();
    }
}
