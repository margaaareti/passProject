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

            // Создаем новый лист
//            Sheets::spreadsheetByTitle($spreadsheetId)->addSheet($newSheetTitle);
            // Получаем объект листа по заголовку
            $newSheet = Sheets::spreadsheetByTitle($sheetName)->sheet($listName);
            // Вставляем данные в новый лист
            $newSheet->range($range_to_fill)->append([$array]);

            dispatch(new GoogleSheetsColorCell($spreadSheetId, $listName));

            if ($this->appData->with_letter === true) {
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
}
