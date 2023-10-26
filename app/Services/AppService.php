<?php

namespace App\Services;

class AppService
{

//    protected AppRepository $appRepository;
//
//    public function __construct(AppRepository $appRepository)
//    {
//        $this->appRepository = $appRepository;
//    }

    protected function processCommonData(array $data): array
    {
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


}
