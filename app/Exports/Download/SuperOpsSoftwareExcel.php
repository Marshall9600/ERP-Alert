<?php

namespace App\Exports\Download;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SuperOpsSoftwareExcel implements FromView, WithEvents
{
    private $SuperOpsSoftware;

    public function __construct(
        $SuperOpsSoftware,
    ) {
        $this->SuperOpsSoftware = $SuperOpsSoftware;
    }

    public function view(): View
    {

        return view('layouts.API.SuperOps.Software.download_excel', [
            'SuperOpsSoftware' => $this->SuperOpsSoftware,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(30);
            },
        ];
    }
}
