<?php

namespace App\Repositories\GoogleSheetsRepository;

use App\Jobs\GoogleSheetsColorCell;
use Illuminate\Support\Facades\Log;
use Revolution\Google\Sheets\Facades\Sheets;

class ApplicationsSheets
{
    public function addNewRecordToSheet(array $data)
    {

        if (isset($data['cars'])) {
            $data['guests'] = '';
            $data['cars'] = implode("\n", $data['cars']);
            $data['application_type'] = 'Въезд';
            if (str_starts_with($data['object'], 'Ломоносова,9')) {
                $data['object'] = 'Л9';
            }
        } elseif (isset($data['guests'])) {
            $data['cars'] = '';
            $data['guests'] = implode("\n", $data['guests']);
            $data['application_type'] = 'Проход';
        };

        $array = [
            $data['application_number'], $data['department'], '', $data['signed_by'], $data['start_date'], $data['end_date'],
            $data['time_range'], $data['object'], $data['application_type'], $data['purpose'],'',
            $data['contract_number'], '', $data['equipment'], $data['guests'],'', $data['cars'], '', '', $data['responsible_person'], $data['phone_number']
        ];


        try {
            $sheetName = 'ДИИБР - Общее';
            $listName = 'Служебные записки';
            $range_to_fill = 'A1';
            $spreadSheetId = '1aij-vtxBkhL7OpZjPutJdlThGZd0fdYVR7vtPidpVaA';

            // Создаем новый лист
//            Sheets::spreadsheetByTitle($spreadsheetId)->addSheet($newSheetTitle);
            // Получаем объект листа по заголовку
            $newSheet = Sheets::spreadsheetByTitle($sheetName)->sheet($listName);
            // Вставляем данные в новый лист
            $newSheet->range($range_to_fill)->append([$array]);

            dispatch( new GoogleSheetsColorCell($spreadSheetId,$listName));


//            $range_to_paint = 'A:Z';
//            $response = Sheets::spreadsheet($spreadSheetId)->sheet($listName)->range($range_to_paint)->get();
//            $rows = $response->toArray();
//            $numRows = count($rows);
//
//            $startRow = $numRows - 1;
//
////            $range= 'O'. $numRows;
////            $response = Sheets::spreadsheetByTitle($sheetName)->sheet($listName)->range($range)->get();
////            $cellValues = $response->toArray();
////            dd($cellValues);
            return 'Данные успешно добавлены в таблицу';

        } catch (\Exception $e) {
            Log::error('Error sending data To google sheets: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

}
