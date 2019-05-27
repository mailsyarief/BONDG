<?php

namespace App\Exports;


use App\bondg;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class PenagihanExports implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                //merge for title
                $event->sheet->getDelegate()->mergeCells('A1:AA1');
                $event->sheet->getDelegate()->setCellValue('A1','LAPORAN PERIODIK MPB RUSAK');
                

                //$event->sheet->getDelegate()->getStyle('A1:O2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                //$row = count($this->data) + 2;
                // All headers - set font size to 14
               


                // Apply array of styles to B2:G8 cell range
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ]
                ];
                
                
                
            },
        ];
    }

    public function view(): View
    {
        return view('admin.exp-bondg', [
            'bondg' => $this->data,
            'no' => 1, 
        ]);
    }
}