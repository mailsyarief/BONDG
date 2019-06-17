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

class BondgExports implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting
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
                $event->sheet->getDelegate()->mergeCells('A1:A2');
                $event->sheet->getDelegate()->setCellValue('A1','NO.');
                $event->sheet->getDelegate()->mergeCells('B1:B2');
                $event->sheet->getDelegate()->setCellValue('B1','POSKO');
                $event->sheet->getDelegate()->mergeCells('C1:C2');
                $event->sheet->getDelegate()->setCellValue('C1','TGL DG');
                $event->sheet->getDelegate()->mergeCells('D1:D2');
                $event->sheet->getDelegate()->setCellValue('D1','NOMOR DG');
                $event->sheet->getDelegate()->mergeCells('E1:E2');
                $event->sheet->getDelegate()->setCellValue('E1','NAMA');
                $event->sheet->getDelegate()->mergeCells('F1:F2');
                $event->sheet->getDelegate()->setCellValue('F1','IDPEL');
                $event->sheet->getDelegate()->mergeCells('G1:G2');
                $event->sheet->getDelegate()->setCellValue('G1','GARDU');
                $event->sheet->getDelegate()->mergeCells('H1:H2');
                $event->sheet->getDelegate()->setCellValue('H1','TARIF');
                $event->sheet->getDelegate()->mergeCells('I1:I2');
                $event->sheet->getDelegate()->setCellValue('I1','DAYA');
                $event->sheet->getDelegate()->mergeCells('J1:J2');
                $event->sheet->getDelegate()->setCellValue('J1','NO. AGENDA');
                $event->sheet->getDelegate()->mergeCells('K1:K2');
                $event->sheet->getDelegate()->setCellValue('K1','NO. HP');
                $event->sheet->getDelegate()->mergeCells('L1:M1');
                $event->sheet->getDelegate()->setCellValue('L1','NOMOR METER');
                $event->sheet->getDelegate()->setCellValue('L2','LAMA');
                $event->sheet->getDelegate()->setCellValue('M2','BARU');
                $event->sheet->getDelegate()->mergeCells('N1:N2');
                $event->sheet->getDelegate()->setCellValue('N1','NAMA PETUGAS');
                $event->sheet->getDelegate()->mergeCells('O1:O2');
                $event->sheet->getDelegate()->setCellValue('O1','STATUS');

                $event->sheet->getDelegate()->getStyle('A1:O2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $row = count($this->data) + 2;
                // All headers - set font size to 14
                $cellRange = 'A1:O'.$row; 


                // Apply array of styles to B2:G8 cell range
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ]
                ];
                
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                
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