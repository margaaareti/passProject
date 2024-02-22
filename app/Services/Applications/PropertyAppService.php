<?php

namespace App\Services\Applications;

use App\Models\Application;
use App\Models\PropertyApplication;
use App\Repositories\Applications\PropertyAppRepository;
use App\Services\AppService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PropertyAppService extends AppService
{

    public function __construct(protected PropertyAppRepository $propertyAppRepository){}

    public function create(array $data)
    {
        $keysToDelete=['selected_form','Checkbox1','Checkbox2'];

        foreach ($keysToDelete as $key){
            unset($data[$key]);
        }

        if ($data['property-in-date'] !== null && $data['property-out-date'] === null) {
            $data['start_date'] = $data['property-in-date'];
            $data['end_date'] = $data['property-in-date'];
        } elseif ($data['property-out-date'] !== null && $data['property-in-date'] === null) {
            $data['start_date'] = $data['property-out-date'];
            $data['end_date'] = $data['property-out-date'];
        } else {
            $data['start_date'] = $data['property-in-date'] ;
            $data['end_date'] = $data['property-out-date'];
        }

        unset($data['property-in-date'], $data['property-out-date']);

        $data['application_type'] = 'Внос/Вынос';

        $propertiesList = [];
        $counter = 1;

        while (isset($data["equipment_name_$counter"])) {
            $name = $data["equipment_name_$counter"];
            $quantity = $data["equipment_quantity_$counter"];

            // Добавляем данные в массив
            $propertiesList[] = [
                'name' => $name,
                'quantity' => $quantity,
            ];

            $counter++;
        }

        try {
            return $this->propertyAppRepository->create($data, $propertiesList);
        } catch (\Exception $e) {
            Log::error('Error sending data Repository: ' . $e->getMessage());
            return $e->getMessage();
        }

    }


    public function fetchApplication($id): Application
    {
        $id = (int)$id;
        return $this->propertyAppRepository->getApplication($id);
    }
}
