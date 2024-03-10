<?php

namespace App\Repositories\Applications;

use App\Repositories\AppRepository;
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
            $this->createAdditionalData($data);
        } catch (\Exception $e) {
            Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
            return $e->getMessage();
        }

        return $newCarApplication->id;
    }

}
