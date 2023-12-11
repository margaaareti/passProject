<?php

namespace App\Repositories;

use App\Models\CarApplication;
use App\Models\Counter;
use App\Models\PeopleApplication;
use App\Repositories\GoogleSheetsRepository\CarAppSheets;
use App\Repositories\GoogleSheetsRepository\GuestAppSheets;
use Illuminate\Support\Facades\Auth;

class AppRepository
{
    protected string $date;
    protected PeopleApplication $peopleAppModel;
    protected GuestAppSheets $guestAppSheets;
    protected CarApplication $carAppModel;

    protected CarAppSheets $carAppSheets;


    public function __construct(PeopleApplication $peopleAppModel, CarApplication $carAppModel, GuestAppSheets $guestAppSheets, CarAppSheets $carAppSheets)
    {
        $this->date = date('d.m.Y');
        $this->peopleAppModel = $peopleAppModel;
        $this->carAppModel = $carAppModel;
        $this->guestAppSheets = $guestAppSheets;
        $this->carAppSheets = $carAppSheets;
    }

    public function GetApplicationCommonData(array $data): array {

        $lastCarRecord = $this->carAppModel->latest()->first();
        $lastPeopleRecord = $this->peopleAppModel->latest()->first();

        //Получаем значение счетчика из базы данных
        $counter = Counter::first();
        if (!$counter) {
            $counter = new Counter(['value' => 0]);
            $counter->save();
        }


        if (($lastCarRecord && $lastCarRecord->created_at->format('d.m.Y') == $this->date) || ($lastPeopleRecord && $lastPeopleRecord->created_at->format('d.m.Y') == $this->date )){
            $counter->increment('value');
        } else {
            $counter->update(['value' => 1]);
        }
        $counter->save();

        $data['counter'] = $counter->value;

        // форматируем номер заявки в строку с нулями в начале
        $number = sprintf('%03d', $data['counter']);
        $data['application_number'] = $this->date . '/' . $number;

        $data['user_id'] = Auth::id();

        $data['user_fullname'] = optional(auth()->user())->last_name . ' ' . optional(auth()->user())->name . ' ' . optional(auth()->user())->patronymic;

        $data['object'] = implode("\n", $data['object']);

        $data['user_email'] = auth()->user()->email;

        $data['user_isu'] = auth()->user()->isu_number;

        return $data;
    }

}
