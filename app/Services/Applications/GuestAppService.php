<?php

namespace App\Services\Applications;

use App\Models\PeopleApplication;
use App\Repositories\Applications\GuestAppRepository;
use App\Services\AppService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;


class GuestAppService extends AppService
{

    protected GuestAppRepository $guestAppRepository;

    public function __construct(GuestAppRepository $guestAppRepository)
    {
        $this->guestAppRepository = $guestAppRepository;
    }

    public function create(array $data)
    {

        $data['application_type'] = 'Проход посетителей';
        $data['guests'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['guests']));
        $data['guests_count'] = count($data['guests']);

//        $data['start_date'] = date_format(date_create($data['start_date']), 'd.m.Y');
//        $data['end_date'] = date_format(date_create($data['end_date']), 'd.m.Y');

        $data = $this->processCommonData($data);

        try {
            return $this->guestAppRepository->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data Repository: ' . $e->getMessage());
            return $e->getMessage();
        }

    }

    public function fetchAllApplications(): Collection
    {

        return $this->guestAppRepository->getAllApplications();

    }

    public function fetchApplication($id): PeopleApplication
    {
        $id = (int)$id;
        return $this->guestAppRepository->getApplication($id);
    }
}
