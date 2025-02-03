<?php

namespace App\Models\Procurement\MaintenanceContract;

use App\Models\Procurement\MaintenancePackages\SLAMaintenancePackagesModel;
use App\Models\Setting\MaintenanceServices\SLAMaintenanceServicesModel as SettingServicesModel;
use Jenssegers\Mongodb\Eloquent\Model;

class SLAMaintenanceContractListModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'procurement_sla_maintenance_contract_list';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'proslamtnctrlst_contract_id',
        'proslamtnctrlst_service_id',
        'proslamtnctrlst_package_id',
        'proslamtnctrlst_asset_limit_count',
        'proslamtnctrlst_created_date',
        'proslamtnctrlst_created_date_time',
        'proslamtnctrlst_modified_date',
        'proslamtnctrlst_modified_date_time',
        'proslamtnctrlst_created_by',
        'proslamtnctrlst_deletion',
    ];

    public function getContract()
    {
        return $this->belongsTo(SLAMaintenanceContractModel::class, 'proslamtnctrlst_contract_id');
    }

    public function getPackage()
    {
        return $this->belongsTo(SLAMaintenancePackagesModel::class, 'proslamtnctrlst_package_id');
    }

    public function getSettingService()
    {
        return $this->belongsTo(SettingServicesModel::class, 'proslamtnctrlst_service_id');
    }
}
