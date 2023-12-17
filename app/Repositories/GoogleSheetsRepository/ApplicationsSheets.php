<?php

namespace App\Repositories\GoogleSheetsRepository;

use App\Models\CarApplication;
use App\Models\PeopleApplication;
use Revolution\Google\Sheets\Facades\Sheets;

class ApplicationsSheets
{

    protected string $date;
    protected CarApplication $carAppModel;
    protected PeopleApplication $peopleAppModel;


    public function __construct(CarApplication $carAppModel,PeopleApplication $peopleAppModel)
    {

        $this->peopleAppModel = $peopleAppModel;
        $this->carAppModel = $carAppModel;
        $this->date = date('d.m.Y');

    }


    public function addNewRecordToSheet(array $data)
    {

        if(isset($data['cars'])){
            $data['guests'] = '';
            $data['cars'] = implode("\n", $data['cars']);
            $data['application_type']= 'Въезд';
            if(str_starts_with($data['object'], 'Ломоносова,9')){
                $data['object'] = 'Л9';
            }
        } elseif (isset($data['guests'])) {
            $data['cars'] = '';
            $data['guests'] = implode("\n", $data['guests']);
            $data['application_type']= 'Проход';
        };



        $array = [
            $data['application_number'], $data['department'], '', $data['signed_by'], $data['start_date'], $data['end_date'],
            $data['time_range'], $data['object'], $data['application_type'], $data['purpose'],
            $data['contract_number'], '', $data['equipment'], $data['guests'],$data['cars'], '', '', $data['responsible_person'], $data['phone_number']
        ];


        $range_to_fill = 'A2';
        $range_to_paint = 'A:Z';
        $spreadsheetId = '1QSGJj-_sfHAvJcFnPWLOsTDb71Wh_5DmEmpeuPW7iWg';


        $sheet = Sheets::spreadsheet(config('google.post_spreadsheet_id'))->sheetById('google.post_sheet_id')->range($range_to_fill)->append([$array]);


        $response = Sheets::spreadsheet($spreadsheetId)->range($range_to_paint)->get();
        $rows = $response->toArray();
        $numRows = count($rows);


        $startRow = $numRows - 1;

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
