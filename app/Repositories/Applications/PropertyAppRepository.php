<?php

namespace App\Repositories\Applications;

use App\Models\PropertyApplication;
use App\Services\Applications\PropertyAppService;
use Illuminate\Support\Facades\Log;

class PropertyAppRepository
{
    protected PropertyApplication $propertyAppModel;

    public function __construct(PropertyApplication $propertyAppModel)
    {
        $this->propertyAppModel = $propertyAppModel;
    }

    public function store(array $data)
    {
        $data['application_number'] = '3333';
        try {
            $newPropertyApplication = $this->propertyAppModel->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }
        return $newPropertyApplication->id;

    }
}
