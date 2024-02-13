<?php

namespace App\Modules\Admin;


use App\Modules\Admin\Actions\GetAllApplicationAction;
use Illuminate\Database\Eloquent\Collection;

class AdminPanelService
{
    public function getAllApplications(): GetAllApplicationAction
    {
        return new GetAllApplicationAction();
    }

}
