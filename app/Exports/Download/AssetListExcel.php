<?php

namespace App\Exports\Download;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AssetListExcel implements FromView, ShouldAutoSize, WithEvents
{
    private $ModelPaginate;

    private $AssetUserModels;

    private $SLAMaintenanceContractAssetModels;

    public function __construct(
        $ModelPaginate, $AssetUserModels, $SLAMaintenanceContractAssetModels
    ) {
        $this->ModelPaginate = $ModelPaginate;
        $this->AssetUserModels = $AssetUserModels;
        $this->SLAMaintenanceContractAssetModels = $SLAMaintenanceContractAssetModels;
    }

    public function view(): View
    {

        return view('layouts.Procurement.Asset.download_excel', [
            'ModelPaginate' => $this->ModelPaginate,
            'AssetUserModels' => $this->AssetUserModels,
            'SLAMaintenanceContractAssetModels' => $this->SLAMaintenanceContractAssetModels,
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
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('I')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('J')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('L')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('M')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('N')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('O')->setWidth(30);
            },
        ];
    }
}
