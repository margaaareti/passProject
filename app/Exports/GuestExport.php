<?php

namespace App\Exports;

use App\Models\PeopleApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class GuestExport implements FromCollection, WithHeadings, WithStyles
{
    protected $peopleApplicationId;

    public function __construct($peopleApplicationId)
    {
        $this->peopleApplicationId = $peopleApplicationId;
    }

    public function collection()
    {
        $peopleApplication = PeopleApplication::find($this->peopleApplicationId);

        return $peopleApplication->guests->map(function ($guest) {
            $nameParts = explode(' ', $guest->name);
            return [
                'Фамилия' => array_shift($nameParts),
                'Имя' => array_shift($nameParts),
                'Отчество' => implode(' ', $nameParts),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Фамилия',
            'Имя',
            'Отчество',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:C1')->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(20);
    }
}
