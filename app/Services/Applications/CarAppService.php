<?php

namespace App\Services\Applications;

use App\Models\PeopleApplication;
use App\Repositories\CarAppRepository;
use App\Repositories\GuestAppRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CarAppService
{

    protected CarAppRepository $carAppRepository;

    public function __construct(CarAppRepository $carAppRepository)
    {
        $this->carAppRepository = $carAppRepository;
    }

    public function create(array $data)
    {

        $data['application_type'] = 'Въезд автотранспорта';
        $data['cars'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['cars']));
        $data['cars_count'] = count($data['cars']);


        if (isset($data['time_start']) && isset($data['time_end'])) {
            $data['time_range'] = $data['time_start'] . '-' . $data['time_end'];
        } else {
            $data['time_range'] = '';
        }

        if (!isset($data['contract_number'])) {
            $data['contract_number'] = '';
        };

        if (!isset($data['equipment'])) {
            $data['equipment'] = '';
        };

        try {
            $this->carAppRepository->create($data);
        } catch (\Exception $error) {
            Log::error('Error sending data Repository: ' . $error->getMessage());
            return $error->getMessage();
        }

    }
}

//    public function fetchAllApplications(): Collection
//    {
//
//        return $data= $this->guestAppRepository->getAllApplications();
//
//    }
//
//    public function fetchApplication($id): PeopleApplication
//    {
//        $id=(int)$id;
//       return $this->guestAppRepository->getApplication($id);
//    }
//}
