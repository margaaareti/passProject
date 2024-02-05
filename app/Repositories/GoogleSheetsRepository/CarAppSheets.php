<?php

namespace App\Repositories\GoogleSheetsRepository;

class CarAppSheets extends ApplicationsSheets

{

    public function create(array $data)
    {

        $this->addNewRecordToSheet($data);

    }

}
