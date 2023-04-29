<?php

namespace App\Repositories;


use App\Models\Counter;
use App\Models\Guest;
use App\Models\PeopleList;
use Illuminate\Support\Facades\Auth;
use Revolution\Google\Sheets\Facades\Sheets;


class GuestAppRepository
{

    protected PeopleList $appModel;


    public function __construct(PeopleList $appModel)
    {
        $this->appModel = $appModel;

    }


    public function create(array $data)
    {

        $date = date('d.m.Y');
        $data['user_id'] = Auth::id();
        $data['type'] = 'проход';
        $data['responsible_person'] = Auth::user()->name;


        for ($i = 0; $i < 10; $i++) {
            //получаем последнюю запись из базы данных
            $lastRecord = $this->appModel->latest()->first();


            //Получаем значение счетчика из базы данных
            $counter = Counter::find(1);
            if (!$counter) {
                $counter = new Counter(['value' => 1]);
                $counter->save();
            }

            if ($lastRecord && $lastRecord->created_at->format('d.m.Y') == $date) {
                $counter->increment('value');
            } else {
                $counter->update(['value'=>1]);
                $counter->save();
            }



            // форматируем номер заявки в строку с нулями в начале
            $number = sprintf('%03d', $counter->value);
            $data['number'] = $date . '/' . $number;


            $appList = $this->appModel->create($data);

            foreach ($data['guests'] as $guest_name) {

                $guest = new Guest(['name' => $guest_name]);

                $guest->save();

                $appList->guests()->attach($guest->id);
            }


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

}
