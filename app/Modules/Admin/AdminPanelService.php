<?php

namespace App\Modules\Admin;


use App\Modules\Admin\Actions\ApplicationProccessAction;
use App\Modules\Admin\Actions\GetAllApplicationAction;
use App\Modules\Admin\Actions\SendDataToGoogleSheetsAction;

class AdminPanelService
{
    public function getAllApplications(): GetAllApplicationAction
    {
        return new GetAllApplicationAction();
    }

    public function sendDataToGoogleSheets(array $data): SendDataToGoogleSheetsAction
    {
        return new SendDataToGoogleSheetsAction();
    }

    public function proccessData(int $id): ApplicationProccessAction
    {
        return new ApplicationProccessAction($id);
    }

}
