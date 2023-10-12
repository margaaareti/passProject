<?php

namespace App\Repositories;


use App\Models\Counter;
use App\Models\Guest;
use App\Models\PeopleApplication;
use Couchbase\QueryException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class GuestAppRepository
{
    protected string $date;

    protected PeopleApplication $peopleAppModel;
    protected GuestAppSheets $guestAppSheets;


    public function __construct(PeopleApplication $peopleAppModel, GuestAppSheets $guestAppSheets)
    {
        $this->date = date('d.m.Y');
        $this->peopleAppModel = $peopleAppModel;
        $this->guestAppSheets = $guestAppSheets;

    }


    /**
     * @throws \Exception
     */
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

        $data['object'] = implode("\n", $data['object']);

        try {
            $newPeopleApplication = $this->peopleAppModel->create($data);

            foreach ($data['guests'] as $guest_name) {

                $guest = new Guest(['name' => $guest_name]);

                $guest->save();

                $newPeopleApplication->guests()->attach($guest->id);
            }

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
        }

        try {
            $this->guestAppSheets->create($data);
        } catch (\Exception $e) {
            Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
        }

        return $newPeopleApplication->id;

    }

    //Получаем коллецию заявок пользователя
    public function getAllApplications(): Collection
    {
        $userId = Auth::id();
        return $this->peopleAppModel->with('guests')->where('user_id', $userId)->get();
    }

    //Получаем конкретную заявку
    public function getApplication($id): PeopleApplication
    {
        $userId = Auth::id();
        return $this->peopleAppModel->where('user_id', $userId)->where('id', $id)->first();
    }
}
