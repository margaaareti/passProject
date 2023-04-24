<?php

namespace App\Services\Applications;
use App\Repositories\GuestAppRepository;


class GuestAppService {

    protected GuestAppRepository $guestAppRepository;

    public function __construct(GuestAppRepository $guestAppRepository)
    {
        $this->guestAppRepository=$guestAppRepository;
    }

    public function create(array $data)
    {

        $data['guests_count'] = count(explode(',', $data['guests']));
        $data['guests'] = explode(',', $data['guests']);

        return $this->guestAppRepository->create($data);
    }

}
