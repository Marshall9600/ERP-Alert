<?php

namespace App\Exports\Download;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportTicketingExcel implements FromView, ShouldAutoSize, WithEvents
{
    private $ModelPaginateTicketList;

    private $TicketVoucherModels;

    private $TicketModelMergeds;

    private $ProcurementServiceModels;

    private $KnowledgebaseSymptomModels;

    private $KnowledgebaseRootCauseModels;

    private $KnowledgebaseResolutionModels;

    public function __construct(
        $ModelPaginateTicketList,
        $TicketVoucherModels,
        $TicketModelMergeds,
        $ProcurementServiceModels,
        $KnowledgebaseSymptomModels,
        $KnowledgebaseRootCauseModels,
        $KnowledgebaseResolutionModels,
    ) {
        $this->ModelPaginateTicketList = $ModelPaginateTicketList;
        $this->TicketVoucherModels = $TicketVoucherModels;
        $this->TicketModelMergeds = $TicketModelMergeds;
        $this->ProcurementServiceModels = $ProcurementServiceModels;
        $this->KnowledgebaseSymptomModels = $KnowledgebaseSymptomModels;
        $this->KnowledgebaseRootCauseModels = $KnowledgebaseRootCauseModels;
        $this->KnowledgebaseResolutionModels = $KnowledgebaseResolutionModels;
    }

    public function view(): View
    {

        return view('layouts.Report.Ticket.Ticketing.download_excel', [
            'ModelPaginateTicketList' => $this->ModelPaginateTicketList,
            'TicketVoucherModels' => $this->TicketVoucherModels,
            'TicketModelMergeds' => $this->TicketModelMergeds,
            'ProcurementServiceModels' => $this->ProcurementServiceModels,
            'KnowledgebaseSymptomModels' => $this->KnowledgebaseSymptomModels,
            'KnowledgebaseRootCauseModels' => $this->KnowledgebaseRootCauseModels,
            'KnowledgebaseResolutionModels' => $this->KnowledgebaseResolutionModels,
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
            },
        ];
    }
}
