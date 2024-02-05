<?php

namespace App\Repositories\GoogleSheetsRepository;


use Illuminate\Support\Facades\Log;
use Laravel\Octane\Exceptions\DdException;
use Revolution\Google\Sheets\Facades\Sheets;

class PropertyAppSheets extends ApplicationsSheets
{
    /**
     * @throws DdException
     */
    public function create(array $data)
    {
        $sheetName = 'ДИИБР - Общее';
        $listName = 'Служебные записки';
        $range_to_fill = 'A1';
        $spreadSheetId = '1aij-vtxBkhL7OpZjPutJdlThGZd0fdYVR7vtPidpVaA';

        $equipmentList = '';
        $counter = 1;



        while (isset($data["equipment_name_$counter"])) {
            // Получаем название имущества и его количество
            $itemName = $data["equipment_name_$counter"];
            $itemQuantity = $data["equipment_quantity_$counter"];

            // Если оба значения присутствуют, добавляем их к строке
            if ($itemName && $itemQuantity) {
                $equipmentList .= "$itemName - $itemQuantity шт.";
                // Добавляем перенос строки после каждой записи, кроме последней
                if ($counter < $data['equipmentCounter'] - 1) {
                    $equipmentList .= "\n";
                }
            }
            $counter++;
        }

        $array = [
            $data['application_number'], $data['department'], '', $data['signed_by'], '', '',
            '', '', $data['application_type'], $data['purpose'], '', '', '', $equipmentList, '', '', '', '', '', $data['responsible_person'], $data['phone_number']
        ];

        try {
            // Получаем объект листа по заголовку
            $newSheet = Sheets::spreadsheetByTitle($sheetName)->sheet($listName);

            if ($data['type'] === 'Внос') {
                $array[4] = $data['property-in-date'];
                $array[5] = $data['property-in-date'];
                $array[7] = $data['object_in'];

                // Вставляем данные в новый лист
                $newSheet->range($range_to_fill)->append([$array]);

            } else if ($data['type'] === 'Вынос') {
                $array[4] = $data['property-out-date'];
                $array[5] = $data['property-out-date'];
                $array[7] = $data['object_out'];

                // Вставляем данные в новый лист
                $newSheet->range($range_to_fill)->append([$array]);

            } else if ($data['type'] === 'Внос-Вынос' && $data['object_in'] === $data['object_out']) {
                $array[4] = $data['property-in-date'];
                $array[5] = $data['property-out-date'];
                $array[7] = $data['object_in'];

                // Вставляем данные в новый лист
                $newSheet->range($range_to_fill)->append([$array]);
            } else if ($data['type'] === 'Внос-Вынос' && $data['object_in'] !== $data['object_out']) {
                $array[4] = $data['property-out-date'];
                $array[5] = $data['property-out-date'];
                $array[7] = $data['object_out'];
                // Вставляем данные в новый лист
                $newSheet->range($range_to_fill)->append([$array]);

                $array[4] = $data['property-in-date'];
                $array[5] = $data['property-in-date'];
                $array[7] = $data['object_out'];

                $newSheet->range($range_to_fill)->append([$array]);
            }

            return 'Данные успешно добавлены в таблицу';

        } catch (\Exception $e) {
            Log::error('Error sending data To google sheets: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

}
