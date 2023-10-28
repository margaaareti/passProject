<?php

namespace App\Repositories\GoogleSheetsRepository;


use App\Models\CarApplication;
use Revolution\Google\Sheets\Facades\Sheets;



class CarAppSheets extends ApplicationsSheets

{

    protected string $date;
    protected CarApplication $appModel;


    public function __construct(CarApplication $appModel)
    {

        $this->appModel = $appModel;
        $this->date = date('d.m.Y');

    }


    public function create(array $data)
    {

        $this->addNewRecordToSheet($data);

    }

}
