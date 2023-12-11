<?php

namespace App\Repositories\GoogleSheetsRepository;


use App\Models\CarApplication;
use Revolution\Google\Sheets\Facades\Sheets;



class CarAppSheets extends ApplicationsSheets

{

    public function create(array $data)
    {

        $this->addNewRecordToSheet($data);

    }

}
