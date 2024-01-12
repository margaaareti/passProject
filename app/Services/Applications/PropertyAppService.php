<?php

namespace App\Services\Applications;

use App\Models\PropertyApplication;
use App\Repositories\Applications\PropertyAppRepository;
use App\Services\AppService;
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

        try {
            return $this->propertyAppRepository->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data Repository: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function fetchApplication($id): PropertyApplication
    {
        $id = (int)$id;
        return $this->propertyAppRepository->getApplication($id);
    }
}
