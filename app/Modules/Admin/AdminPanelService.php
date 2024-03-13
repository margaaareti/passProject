<?php

namespace App\Modules\Admin;


use App\Modules\Admin\Actions\ApplicationProccessAction;
use App\Modules\Admin\Actions\GetAllApplicationAction;
use App\Modules\Admin\Actions\SendDataToGoogleSheetsAction;
use App\Modules\Admin\DTO\GoogleSheetDataDTO;

class AdminPanelService
{
    public function getAllApplications(): GetAllApplicationAction
    {
        return new GetAllApplicationAction();
    }

    public function sendDataToGoogleSheets(GoogleSheetDataDTO $data): SendDataToGoogleSheetsAction
    {
        return new SendDataToGoogleSheetsAction($data);
    }

    public function proccessData(array $reqData): ApplicationProccessAction
    {
        return new ApplicationProccessAction($reqData);
    }

}
