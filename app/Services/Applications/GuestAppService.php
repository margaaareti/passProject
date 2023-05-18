<?php

namespace App\Services\Applications;

use App\Repositories\GuestAppRepository;


class GuestAppService
{

    protected GuestAppRepository $guestAppRepository;

    public function __construct(GuestAppRepository $guestAppRepository)
    {
        $this->guestAppRepository = $guestAppRepository;
    }

    public function create(array $data)
    {

        $data['guests'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['guests']));
        $data['guests_count'] = count($data['guests']);
        $data['application_type'] = 'Проход посетителей';


        if (isset($data['time_start']) && isset($data['time_end'])) {
            $data['time_range'] = $data['time_start'] . '-' . $data['time_end'];
        } else {
            $data['time_range'] = '';
        }

        if (!isset($data['contract_number'])) {
            $data['contract_number'] = '';
        };

        return $this->guestAppRepository->create($data);

    }

}
