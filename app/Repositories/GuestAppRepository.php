<?php

namespace App\Repositories;


use App\Models\Counter;
use App\Models\Guest;
use App\Models\PeopleApplication;
use Illuminate\Support\Facades\Auth;


class GuestAppRepository
{

    protected string $date;

    protected PeopleApplication $peopleAppModel;
    protected GuestAppSheets $guestAppSheets;



    public function __construct(PeopleApplication $peopleAppModel, GuestAppSheets $guestAppSheets )
    {
        $this->date = date('d.m.Y');
        $this->peopleAppModel = $peopleAppModel;
        $this->guestAppSheets = $guestAppSheets;

    }


    public function create(array $data)
    {

        $lastRecord = $this->peopleAppModel->latest()->first();

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

        $data['responsible_person'] = Auth::user()->name;

        $data['object'] = implode("\n", $data['object']);

            $newPeopleApplication = $this->peopleAppModel->create($data);

            foreach ($data['guests'] as $guest_name) {

                $guest = new Guest(['name' => $guest_name]);

                $guest->save();

                $newPeopleApplication->guests()->attach($guest->id);
            }


            $this->guestAppSheets->create($data);

        }
}
