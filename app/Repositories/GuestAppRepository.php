<?php

namespace App\Repositories;


use App\Models\Guest;
use App\Models\PeopleList;
use Illuminate\Support\Facades\Auth;
use Revolution\Google\Sheets\Facades\Sheets;


class GuestAppRepository
{

    protected PeopleList $appModel;
    protected GuestAppSheets $guestAppSheets;


    public function __construct(PeopleList $appModel, GuestAppSheets $guestAppSheets )
    {
        $this->appModel = $appModel;
        $this->guestAppSheets = $guestAppSheets;

    }


    public function create(array $data)
    {

        $data['user_id'] = Auth::id();

        $data['responsible_person'] = Auth::user()->name;

            $appList = $this->appModel->create($data);

            foreach ($data['guests'] as $guest_name) {

                $guest = new Guest(['name' => $guest_name]);

                $guest->save();

                $appList->guests()->attach($guest->id);
            }

            $this->guestAppSheets->create($data);

        }
}
