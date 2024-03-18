<?php

namespace App\Modules\Admin\Actions;

use App\Jobs\GoogleSheetsColorCell;
use App\Modules\Admin\DTO\GoogleSheetDataDTO;
use App\Modules\Admin\Events\SendApprovingEmailNotificationEvent;
use Illuminate\Support\Facades\Log;
use Revolution\Google\Sheets\Facades\Sheets;

class SendDataToGoogleSheetsAction
{
    protected GoogleSheetDataDTO $appData;


    public function __construct(GoogleSheetDataDTO $appData)
    {
        $this->appData = $appData;
    }

    public function run(): string
    {

        $data = $this->appData->formatObject();

        $array = [
            $this->appData->application_number,
            $this->appData->department,
            $this->appData->organization_name,
            $this->appData->signed_by,
            $this->appData->start_date,
            $this->appData->end_date,
            $this->appData->time_range,
            $data,
            $this->appData->application_type,
            $this->appData->purpose,
            '',
            $this->appData->rooms,
            $this->appData->equipment,
            $this->appData->guests,
            $this->appData->is_foreigner,
            $this->appData->car_numbers,
            $this->appData->car_brand,
            $this->appData->car_model,
            $this->appData->responsible_person,
            $this->appData->phone_number
        ];


        try {
            $sheetName = 'ДИИБР - Общее';
            $listName = 'Служебные записки';
            $range_to_fill = 'A1';
            $spreadSheetId = '1aij-vtxBkhL7OpZjPutJdlThGZd0fdYVR7vtPidpVaA';

            // Создание нового листа
//            Sheets::spreadsheetByTitle($spreadsheetId)->addSheet($newSheetTitle);
            // Получаем объект листа по заголовку
            $newSheet = Sheets::spreadsheetByTitle($sheetName)->sheet($listName);

            if (property_exists($this->appData, 'object_in') && property_exists($this->appData, 'object_out') &&
                $this->appData->object_in !== null && $this->appData->object_out !== null) {
                $this->processObjectInOut($array, $newSheet, $range_to_fill,$spreadSheetId,$listName);
            } else {
                $newSheet->range($range_to_fill)->append([$array]);
                dispatch(new GoogleSheetsColorCell($spreadSheetId, $listName));
            }

            if ($this->appData->with_letter) {
                Log::info("Вызов отправки мыла 1");
                event(new SendApprovingEmailNotificationEvent([
                    'app_id' => $this->appData->app_id,
                    'email' => $this->appData->user_email,
                    'app_type' => $this->appData->application_type
                ]));
            }

            return 'Данные успешно добавлены в таблицу';

        } catch (\Exception $e) {
            Log::error('Error sending data To google sheets: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    protected function processObjectInOut(array &$array, $newSheet, $range_to_fill, $spreadSheetId, $listName)
    {
        $array[4] = $this->appData->start_date;
        $array[5] = $this->appData->start_date;
        $array[7] = $this->appData->object_in;
        $array[9] = 'Внос ' . $array[9];
        $newSheet->range($range_to_fill)->append([$array]);
        dispatch(new GoogleSheetsColorCell($spreadSheetId, $listName));

        $array[4] = $this->appData->end_date;
        $array[5] = $this->appData->end_date;
        $array[7] = $this->appData->object_out;
        $array[9] = 'Вынос ' . $array[9];
        $newSheet->range($range_to_fill)->append([$array]);
        dispatch(new GoogleSheetsColorCell($spreadSheetId, $listName));
    }
}
