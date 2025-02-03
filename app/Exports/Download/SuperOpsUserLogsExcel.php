<?php

namespace App\Exports\Download;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SuperOpsUserLogsExcel implements FromView, WithEvents
{
    private $SuperOpsUserLogs;

    public function __construct(
        $SuperOpsUserLogs,
    ) {
        $this->SuperOpsUserLogs = $SuperOpsUserLogs;
    }

    public function view(): View
    {

        return view('layouts.API.SuperOps.UserLog.download_excel', [
            'SuperOpsUserLogs' => $this->SuperOpsUserLogs,
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
            },
        ];
    }
}
