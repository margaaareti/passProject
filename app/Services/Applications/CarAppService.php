<?php

namespace App\Services\Applications;

use App\Models\CarApplication;
use App\Repositories\CarAppRepository;
use App\Services\AppService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;


class CarAppService extends AppService
{

    protected CarAppRepository $carAppRepository;

    public function __construct(CarAppRepository $carAppRepository)
    {
        $this->carAppRepository = $carAppRepository;
    }

    public function create(array $data)
    {

        $data['application_type'] = 'Въезд автотранспорта';
        $data['cars'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", mb_strtoupper($data['cars'], 'UTF-8')));
        $data['cars_count'] = count($data['cars']);


        $data = $this->processCommonData($data);


        try {
            return $this->carAppRepository->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data Repository: ' . $e->getMessage());
            return $e->getMessage();
        }

    }

    public function fetchAllCarApplications(): Collection
    {

        return $data = $this->carAppRepository->getAllCarApplications();

    }

    public function fetchCarApplication($id): CarApplication
    {
        $id = (int)$id;
        return $this->carAppRepository->getCarApplication($id);
    }
}
