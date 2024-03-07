<?php

namespace App\Modules\Admin\Actions;

use App\Jobs\GoogleSheetsColorCell;
use App\Modules\Admin\DTO\GoogleSheetDataDTO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Revolution\Google\Sheets\Facades\Sheets;

class SendDataToGoogleSheetsAction
{

    public function run(GoogleSheetDataDTO $data): string
    {

        $array = [
            $data->application_number, $data->department, $data->organization_name, $data->signed_by, $data->start_date, $data->end_date,
            $data->time_range, $data->object, $data->application_type, $data->purpose, $data->rooms,
            '', '', $data->equipment, $data->guests, $data->is_foreigner, $data->car_numbers, $data->car_numbers, $data->car_model, $data->responsible_person, $data->phone_number
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

            dispatch(new GoogleSheetsColorCell($spreadSheetId, $listName));


            return 'Данные успешно добавлены в таблицу';


        } catch (\Exception $e) {
            Log::error('Error sending data To google sheets: ' . $e->getMessage());
            return $e->getMessage();
        }
    }


}
