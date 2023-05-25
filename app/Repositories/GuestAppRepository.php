<?php

namespace App\Repositories;


use App\Models\Counter;
use App\Models\Guest;
use App\Models\PeopleList;
use Illuminate\Support\Facades\Auth;


class GuestAppRepository
{

    protected string $date;

    protected PeopleList $appModel;
    protected GuestAppSheets $guestAppSheets;


    public function __construct(PeopleList $appModel, GuestAppSheets $guestAppSheets)
    {
        $this->date = date('d.m.Y');
        $this->appModel = $appModel;
        $this->guestAppSheets = $guestAppSheets;

    }


    public function create(array $data)
    {

        $lastRecord = $this->appModel->latest()->first();

        //Получаем значение счетчика из базы данных
        $counter = Counter::first();
        if (!$counter) {
            $counter = new Counter(['value' => 0]);
            $counter->save();
        }

        if ($lastRecord && $lastRecord->created_at->format('d.m.Y') == $this->date) {
            $counter->increment('value');
        } else {
            $counter->update(['value' => 1]);
        }
        $counter->save();


        $data['counter'] = $counter->value;

        $data['user_id'] = Auth::id();

        $data['object'] = implode("\n", $data['object']);

        $appList = $this->appModel->create($data);

        foreach ($data['guests'] as $guest_name) {

            $guest = new Guest(['name' => $guest_name]);

            $guest->save();

            $appList->guests()->attach($guest->id);
        }


        $this->guestAppSheets->create($data);

    }
}
