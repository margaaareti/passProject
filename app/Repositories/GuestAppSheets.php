<?php

namespace App\Repositories;

use App\Models\PeopleList;
use Revolution\Google\Sheets\Facades\Sheets;


class GuestAppSheets
{


    protected string $date;
    protected peopleList $appModel;


    public function __construct(PeopleList $appModel)
    {

        $this->appModel = $appModel;
        $this->date = date('d.m.Y');

    }


    public function create(array $data)
    {

        $data['guests'] = implode("\n", $data['guests']);

        // форматируем номер заявки в строку с нулями в начале
        $number = sprintf('%03d',$data['counter']);
        $data['application_number'] = $this->date . '/' . $number;

        //Приводим дату к виду день.месяц.год
        $data['start_date'] = date_format(date_create($data['start_date']), 'd.m.Y');
        $data['end_date'] = date_format(date_create($data['end_date']), 'd.m.Y');


        $array = [
            $data['application_number'], $data['department'],$data['signed_by'],$data['start_date'],$data['end_date'],
            $data['time_range'],$data['object'],$data['application_type'], $data['purpose'],
            $data['contract_number'],$data['rooms'],$data['equipment'],$data['guests'],'','','',$data['responsible_person'], $data['phone_number']
        ];

        $range_to_fill = 'A1';
        $range_to_paint = 'A:Z';
        $spreadsheetId = '1QSGJj-_sfHAvJcFnPWLOsTDb71Wh_5DmEmpeuPW7iWg';



        $sheet = Sheets::spreadsheet(config('google.post_spreadsheet_id'))->sheetById('google.post_sheet_id')->range($range_to_fill)->append([$array]);


        $response = Sheets::spreadsheet($spreadsheetId)->range($range_to_paint)->get();
        $rows = $response->toArray();
        $numRows = count($rows);



        $startRow = $numRows-1;

        $service = Sheets::spreadsheet($spreadsheetId)->getService();


        $requests = [
            'updateCells' => [
                'rows' => [
                    [
                        'values' => [
                            [
                                'userEnteredFormat' => [
                                    'backgroundColor' => [
                                        'red' => 1.0,
                                        'green' => 1.0,
                                        'blue' => 0.0
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'fields' => 'userEnteredFormat.backgroundColor',
                'start' => [
                    'sheetId' => 0,
                    'rowIndex' => $startRow,
                    'columnIndex' => 0
                ]
            ]
        ];

        $batchUpdateRequest = new \Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
            'requests' => $requests
        ]);

        $response = $service->spreadsheets->batchUpdate($spreadsheetId, $batchUpdateRequest);

    }

}
