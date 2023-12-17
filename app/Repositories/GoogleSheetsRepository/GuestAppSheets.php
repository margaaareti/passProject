<?php

namespace App\Repositories\GoogleSheetsRepository;




class GuestAppSheets extends ApplicationsSheets
{

    public function create(array $data) {

        $this->addNewRecordToSheet($data);

    }

}
