<?php

namespace App\Repositories;

use App\Models\Counter;
use App\Models\PeopleList;
use Revolution\Google\Sheets\Facades\Sheets;

class GuestAppSheets
{

    protected string $date;
    protected peopleList $appModel;


    public function __construct(PeopleList $appModel) {

        $this ->appModel= $appModel;
        $this->date = date('d.m.Y');

    }


    public function create(array $data) {

        $data['type'] = 'Проход посетителей';

        $lastRecord = $this->appModel->latest()->first();


        //Получаем значение счетчика из базы данных
        $counter = Counter::first();
        if (!$counter) {
            $counter = new Counter(['value' => 0]);
            $counter->save();
        }

        if ($lastRecord && $lastRecord->created_at->format('d.m.Y') == $this->date) {
            $counter->increment('value');
            $counter->save();
        } else {
            $counter->update(['value'=>1]);
            $counter->save();
        }

        // форматируем номер заявки в строку с нулями в начале
        $number = sprintf('%03d', $counter->value);
        $data['number'] = $this->date . '/' . $number;
        $array = [
            $data['number'], $data['department'],//null,$data['signed_by'],$data['start_date'],$data['end_date'],
            //null,$data['object'],$data['type'],
            //null,$data['contract_number'],null,$data['equipment'],$data['guests'],null,null,null,null,
            //null,$data['responsible_person'],$data['phone_number']
        ];

        $range = 'A2';


        Sheets::spreadsheet(config('google.post_spreadsheet_id'))->sheetById('google.post_sheet_id')->range($range)->append([$array]);

    }



}
