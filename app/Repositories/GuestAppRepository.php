<?php

namespace App\Repositories;

use App\Models\PeopleList;
use Illuminate\Support\Facades\Auth;


class GuestAppRepository
{

    protected PeopleList $appModel;

    public function __construct(PeopleList $appModel)
    {
        $this->appModel = $appModel;
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();
        return $this->appModel->create($data);
    }

}
