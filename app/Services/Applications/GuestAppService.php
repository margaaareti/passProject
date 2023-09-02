<?php

namespace App\Services\Applications;

use App\Repositories\GuestAppRepository;
use Illuminate\Support\Facades\Auth;


class GuestAppService
{

    protected GuestAppRepository $guestAppRepository;

    public function __construct(GuestAppRepository $guestAppRepository)
    {
        $this->guestAppRepository = $guestAppRepository;
    }

    public function create(array $data)
    {

        try {

            $data['application_type'] = 'Проход посетителей';
            $data['guests'] = preg_split("/[\n,]+/", str_replace("\r\n", "\n", $data['guests']));
            $data['guests_count'] = count($data['guests']);


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

            if (!isset($data['rooms'])) {
                $data['rooms'] = '';
            };

            if (!isset($data['responsible_person'])) {
                $data['responsible_person'] = Auth::user()->name;
            };


            $this->guestAppRepository->create($data);

        } catch (\Exception $error) {
            return $error->getMessage();
        }

    }
}
