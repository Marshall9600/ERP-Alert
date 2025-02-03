<?php

namespace App\Exports\Download;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportClientAssetExcel implements FromView, ShouldAutoSize, WithEvents
{
    private $ModelDataArray;

    public function __construct(
        $ModelDataArray,
    ) {
        $this->ModelDataArray = $ModelDataArray;
    }

    public function view(): View
    {

        return view('layouts.Report.Client.Asset.download_excel', [
            'ModelDataArray' => $this->ModelDataArray,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('P')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('Q')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('R')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('S')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('T')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('U')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('V')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('W')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('X')->setWidth(30);
            },
        ];
    }
}
