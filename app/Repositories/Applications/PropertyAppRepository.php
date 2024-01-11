<?php

namespace App\Repositories\Applications;

use App\Models\PropertyApplication;
use App\Repositories\AppRepository;
use App\Services\Applications\PropertyAppService;
use Illuminate\Support\Facades\Log;
use Laravel\Octane\Exceptions\DdException;

class PropertyAppRepository extends AppRepository
{

    /**
     * @throws DdException
     */
    public function create(array $data)
    {

        $data = $this->GetApplicationCommonData($data);

        try {
            $newPropertyApplication = $this->propertyAppModel->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
            return $e->getMessage();
        }
        return $newPropertyApplication->id;

    }
}
