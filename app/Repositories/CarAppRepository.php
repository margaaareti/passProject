<?php

namespace App\Repositories;


use App\Models\Car;
use App\Models\CarApplication;
use App\Models\Counter;
use App\Models\PeopleApplication;
use App\Repositories\GoogleSheetsRepository\CarAppSheets;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CarAppRepository
{
    protected string $date;

    protected CarApplication $carAppModel;
    protected PeopleApplication $peopleAppModel;
    protected CarAppSheets $carAppSheets;


    public function __construct(CarApplication $carAppModel, CarAppSheets $carAppSheets, PeopleApplication $peopleAppModel)
    {
        $this->date = date('d.m.Y');
        $this->carAppModel = $carAppModel;
        $this->peopleAppModel = $peopleAppModel;
        $this->carAppSheets = $carAppSheets;

    }


    /**
     * @throws \Exception
     */
    public function create(array $data)
    {

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

        $data['user_id'] = Auth::id();

        $data['object'] = implode("\n", $data['object']);

        try {
            $newCarApplication = $this->carAppModel->create($data);

            foreach ($data['cars'] as $car_number) {

                $car = new Car(['number' => $car_number]);

                $car->save();

                $newCarApplication->cars()->attach($car->id);
            }

        } catch (\Exception $e) {
            Log::error('Error sending data to Database: ' . $e->getMessage());
        }

        try {
            $this->carAppSheets->create($data);
        } catch (\Exception $e) {
          Log::error('Error sending data to Google Sheets: ' . $e->getMessage());
        }

        return $newCarApplication->id;

    }


   public function getAllCarApplications(): Collection
    {
        $userId = Auth::id();
        return $this->carAppModel->with('cars')->where('user_id', $userId)->get();
    }

    //Получаем конкретную заявку
    public function getCarApplication($id): CarApplication
    {
        $userId = Auth::id();
        return $this->carAppModel->where('user_id', $userId)->where('id', $id)->first();
    }
}
