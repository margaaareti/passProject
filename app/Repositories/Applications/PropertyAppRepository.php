<?php

namespace App\Repositories\Applications;

use App\Models\Application;
use App\Repositories\AppRepository;
use Illuminate\Support\Facades\Log;

class PropertyAppRepository extends AppRepository
{

    public function create(array $data, array $propertiesList)
    {

        $data = $this->GetApplicationCommonData($data);

        try {

            $newPropertyApplication = $this->propertyAppModel->create([
                'type'=> $data['type'],
                'object_in' => $data['object_in'] ?? null,
                'object_out' => $data['object_out'] ?? null,
            ]);

            $newPropertyApplication->properties()->createMany($propertiesList);

            $newApplication = Application::create(array_merge($data, [
                'object' => $data['object_in'] ?? $data['object_out'],
                'applicationable_type' => $newPropertyApplication->getApplicationType(),
                'applicationable_id' => $newPropertyApplication->getApplicationId(),
            ]));

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }

        try {

            $data = $this->formatDates($data);

            $this->propertyAppSheets->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }

        return $newApplication->id;
    }

}
