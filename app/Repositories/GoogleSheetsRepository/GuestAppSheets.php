<?php

namespace App\Repositories\GoogleSheetsRepository;

use App\Models\PeopleApplication;
use Revolution\Google\Sheets\Facades\Sheets;


class GuestAppSheets extends ApplicationsSheets
{

    public function create(array $data) {

        $this->addNewRecordToSheet($data);

    }

}
