<?php

namespace App\Exports\Download;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SettingServicesInBulkExcel implements FromView, WithEvents
{
    private $Download;

    public function __construct(
        $Download,
    ) {
        $this->Download = $Download;
    }

    public function view(): View
    {

        return view('layouts.Export.Download.setting_service_in_bulk_excel', [
            'Download' => $this->Download,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
            },
        ];
    }
}
