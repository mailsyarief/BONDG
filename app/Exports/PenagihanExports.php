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
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PenagihanExports implements FromView, ShouldAutoSize, WithEvents, WithColumnFormatting, WithCustomStartCell
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

    public function startCell(): string
    {
        return 'A4';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                //merge for title
                $event->sheet->getDelegate()->mergeCells('A1:AA1');
                $event->sheet->getDelegate()->setCellValue('A1','LAPORAN PERIODIK MPB RUSAK');
                $event->sheet->getDelegate()->mergeCells('A3:A4');
                $event->sheet->getDelegate()->setCellValue('A3','NO');
                $event->sheet->getDelegate()->mergeCells('B3:B4');
                $event->sheet->getDelegate()->setCellValue('B3','NAMA PELANGGAN');
                $event->sheet->getDelegate()->mergeCells('C3:C4');
                $event->sheet->getDelegate()->setCellValue('C3','ID PEL');
                $event->sheet->getDelegate()->mergeCells('D3:D4');
                $event->sheet->getDelegate()->setCellValue('D3','ALAMAT');
                $event->sheet->getDelegate()->mergeCells('E3:E4');
                $event->sheet->getDelegate()->setCellValue('E3','TARIF');
                $event->sheet->getDelegate()->mergeCells('F3:F4');
                $event->sheet->getDelegate()->setCellValue('F3','DAYA');
                $event->sheet->getDelegate()->mergeCells('G3:G4');
                $event->sheet->getDelegate()->setCellValue('G3','GARDU TIANG');
                $event->sheet->getDelegate()->mergeCells('H3:I3');
                $event->sheet->getDelegate()->setCellValue('H3','PK');
                $event->sheet->getDelegate()->setCellValue('H4','NOMOR');
                $event->sheet->getDelegate()->setCellValue('I4','KEMBALI');
                $event->sheet->getDelegate()->mergeCells('J3:N3');
                $event->sheet->getDelegate()->setCellValue('J3','KWH METER DIBONGKAR');
                $event->sheet->getDelegate()->setCellValue('J4','MERK');
                $event->sheet->getDelegate()->setCellValue('K4','TYPE');
                $event->sheet->getDelegate()->setCellValue('L4','NOMOR');
                $event->sheet->getDelegate()->setCellValue('M4','TH BUAT');
                $event->sheet->getDelegate()->setCellValue('N4','SISA KWH');
                $event->sheet->getDelegate()->mergeCells('O3:R3');
                $event->sheet->getDelegate()->setCellValue('O3','KWH BARU DIPASANG');
                $event->sheet->getDelegate()->setCellValue('O4','MERK');
                $event->sheet->getDelegate()->setCellValue('P4','TYPE');
                $event->sheet->getDelegate()->setCellValue('Q4','NOMOR');
                $event->sheet->getDelegate()->setCellValue('R4','TH BUAT');
                $event->sheet->getDelegate()->mergeCells('S3:S4');
                $event->sheet->getDelegate()->setCellValue('S3','TGL BON DG');
                $event->sheet->getDelegate()->mergeCells('T3:T4');
                $event->sheet->getDelegate()->setCellValue('T3','NO BON DG');
                $event->sheet->getDelegate()->mergeCells('U3:U4');
                $event->sheet->getDelegate()->setCellValue('U3','TS KWH');
                $event->sheet->getDelegate()->mergeCells('V3:V4');
                $event->sheet->getDelegate()->setCellValue('V3','BA TS');
                $event->sheet->getDelegate()->mergeCells('W3:W4');
                $event->sheet->getDelegate()->setCellValue('W3','NO. SEGEL');
                $event->sheet->getDelegate()->mergeCells('X3:X4');
                $event->sheet->getDelegate()->setCellValue('X3','TANGGAL PASANG');
                $event->sheet->getDelegate()->mergeCells('Y3:Y4');
                $event->sheet->getDelegate()->setCellValue('Y3','JENIS KERUSAKAN');
                $event->sheet->getDelegate()->mergeCells('Z3:Z4');
                $event->sheet->getDelegate()->setCellValue('Z3','KET');
                $event->sheet->getDelegate()->mergeCells('AA3:AA4');
                $event->sheet->getDelegate()->setCellValue('AA3','PETUGAS');
                $event->sheet->getDelegate()->getStyle('A1:AA4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle('A1:AA4')->getFont()->setBold( true );
                $row = count($this->data) + 4;
                // All headers - set font size to 14
                $cellRange = 'A3:AA'.$row; 
                // Apply array of styles to B2:G8 cell range
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ]
                    ]
                ];
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($styleArray);
                $event->sheet->getDelegate()->getStyle('A3:AA4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('4bacc6');
                $event->sheet->getHeaderFooter()->setDifferentOddEven(false);
                $event->sheet->getHeaderFooter()->setOddFooter('Copyright "eGamer"'); 
                
            },
        ];
    }

    public function view(): View
    {
        return view('admin.exp-penagihan', [
            'bondg' => $this->data,
            'no' => 1, 
        ]);
    }
}