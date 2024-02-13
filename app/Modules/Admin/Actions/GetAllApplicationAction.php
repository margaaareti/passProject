<?php

namespace App\Modules\Admin\Actions;

use App\Models\CarApplication;
use App\Models\PeopleApplication;
use App\Models\PropertyApplication;
use Illuminate\Database\Eloquent\Collection;

class GetAllApplicationAction
{

    private function carApps(): Collection
    {
        return CarApplication::with('cars')->get();
    }

    private function guestApps(): Collection
    {
        return PeopleApplication::with('guests')->get();
    }

    private function propApps(): Collection
    {
        return PropertyApplication::with('properties')->get();
    }

    public function run(): Collection
    {

        $guestApplications = $this->guestApps();
        $carApplications = $this->carApps();
        $propertyApplications = $this-> propApps();


        return $guestApplications->concat($carApplications)->concat($propertyApplications)->sortByDesc('created_at');
    }

}
