<?php

namespace App\Services;

class AppService
{

    protected function processCommonData(array $data): array
    {
        $keysToCheck = ['time_start', 'time_end', 'contract_number', 'equipments','rooms'];

        foreach ($keysToCheck as $key) {
            if (!isset($data[$key])) {
                $data[$key] = '';
            }
        }

//        if (isset($data['equipments'])) {
//            $data['guests'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['equipments']));
//        }


        if (isset($data['time_start'], $data['time_end'])) {
            $data['time_range'] = $data['time_start'] . '-' . $data['time_end'];
        } else {
            $data['time_range'] = '';
        }

        return $data;
    }

}
