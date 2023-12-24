<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Revolution\Google\Sheets\Facades\Sheets;

class GoogleSheetsColorCell implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $spreadSheetId;
    protected string $listName;

    /**
     * Create a new job instance.
     */
    public function __construct(string $spreadSheetId, string $listName)
    {
        $this->spreadSheetId = $spreadSheetId;
        $this->listName = $listName;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->colorCellWithNewData($this->spreadSheetId,$this->listName);
    }

    public function ColorCellWithNewData(string $spreadSheetId, string $listName): void
    {
        $range_to_paint = 'A:Z';
        $response = Sheets::spreadsheet($spreadSheetId)->sheet($listName)->range($range_to_paint)->get();
        $rows = $response->toArray();
        $numRows = count($rows);

        $startRow = $numRows - 1;

        $service = Sheets::spreadsheet($spreadSheetId)->sheet($listName)->getService();

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

        $response = $service->spreadsheets->batchUpdate($spreadSheetId, $batchUpdateRequest);

    }

}
