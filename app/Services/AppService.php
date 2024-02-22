<?php

namespace App\Services;

use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Collection;

class AppService
{

    public function __construct(public AppRepository $appRepository)
    {}

    protected function processCommonData(array $data): array
    {
        $keysToDelete=['selected_form','Checkbox1','Checkbox2'];

        foreach ($keysToDelete as $key){
            unset($data[$key]);
        }

        $keysToCheck = ['time_start', 'time_end', 'contract_number', 'equipment','rooms'];

        foreach ($keysToCheck as $key) {
            if (!isset($data[$key])) {
                $data[$key] = '';
            }
        }


        if (isset($data['time_start'], $data['time_end'])) {
            $data['time_range'] = $data['time_start'] . '-' . $data['time_end'];
        } else {
            $data['time_range'] = '';
        }

        return $data;
    }

    public function fetchAllApplications(): Collection
    {
        return $this->appRepository->getAllApplications();
    }


}
