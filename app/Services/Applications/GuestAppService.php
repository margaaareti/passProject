<?php

namespace App\Services\Applications;

use App\Models\PeopleApplication;
use App\Repositories\Applications\GuestAppRepository;
use App\Services\AppService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;


class GuestAppService extends AppService
{
    public function __construct(protected GuestAppRepository $guestAppRepository)
    {}

    public function create(array $data)
    {

        $data['application_type'] = 'Проход';
        $data['guests'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['guests']));
        $data['guests_count'] = count($data['guests']);


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
