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
        return $this->guestAppRepository->create($data);
    }

}
