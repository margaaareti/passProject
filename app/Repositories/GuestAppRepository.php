<?php

namespace App\Repositories;

use App\Models\Guest;
use App\Models\PeopleList;
use Illuminate\Support\Facades\Auth;


class GuestAppRepository
{

    protected PeopleList $appModel;
    protected Guest $guestModel;

    public function __construct(PeopleList $appModel, Guest $guestModel)
    {
        $this->appModel = $appModel;
        $this->guestModel = $guestModel;
    }

    public function create(array $data)
    {
        $data['user_id'] = Auth::id();

        $appList = $this->appModel->create($data);

        foreach ($data['guests'] as $guest) {

            $newGuest = new Guest(['name'=> $guest]);

            $newGuest->save();

            $appList->guests()->attach($newGuest->id);
        }

        return $appList;

    }

}
