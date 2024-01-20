<?php

namespace App\Services\Applications;

use App\Models\PropertyApplication;
use App\Repositories\Applications\PropertyAppRepository;
use App\Services\AppService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class PropertyAppService extends AppService
{

    protected PropertyAppRepository $propertyAppRepository;

    public function __construct(PropertyAppRepository $propertyAppRepository)
    {
        $this->propertyAppRepository = $propertyAppRepository;
    }

    public function create(array $data)
    {
        $keysToDelete=['selected_form','Checkbox1','Checkbox2'];

        foreach ($keysToDelete as $key){
            unset($data[$key]);
        }

        $data['application_type'] = 'Внос/Вынос';
//      $data['equipment'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['equipment']));

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

    public function fetchAllApplications(): Collection
    {

        return $this->propertyAppRepository->getAllApplications();

    }


    public function fetchApplication($id): PropertyApplication
    {
        $id = (int)$id;
        return $this->propertyAppRepository->getApplication($id);
    }
}
