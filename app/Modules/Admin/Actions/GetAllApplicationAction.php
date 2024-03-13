<?php

namespace App\Modules\Admin\Actions;

use App\Models\Application;
use App\Models\CarApplication;
use App\Models\PeopleApplication;
use App\Models\PropertyApplication;
use Illuminate\Database\Eloquent\Collection;

class GetAllApplicationAction
{
    public function run(): Collection
    {

        return Application::all()->sortByDesc('created_at');
    }

}
