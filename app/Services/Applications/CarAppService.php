<?php

namespace App\Services\Applications;

use App\Models\CarApplication;
use App\Repositories\Applications\CarAppRepository;
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

        $data['application_type'] = 'Въезд';
        $data['cars'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", mb_strtoupper($data['cars'], 'UTF-8')));
        $data['cars_count'] = count($data['cars']);

        if (str_starts_with($data['object'][0], 'Л9_1')) {
            $data['object'][0] = 'Ломоносова,9- Въезд на главную парковку';
        } elseif (str_starts_with($data['object'][0], 'Л9_2')) {
            $data['object'][0] = 'Ломоносова,9- Въезд с Банного переулка';
        } elseif (str_starts_with($data['object'][0], 'Л9_3')) {
            $data['object'][0] = 'Ломоносова,9- Въезд за шлагбаум (парковка ректората)';
        }


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
