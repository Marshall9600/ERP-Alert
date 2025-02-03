<?php

namespace App\Models\Procurement\MaintenanceContract;

use App\Models\Client\Asset\AssetModel;
use Jenssegers\Mongodb\Eloquent\Model;

class SLAMaintenanceContractAssetModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'procurement_sla_maintenance_contract_asset';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'proslamtnctrast_contract_id',
        'proslamtnctrast_contract_list_id',
        'proslamtnctrast_asset_id',
        'proslamtnctrast_created_date',
        'proslamtnctrast_created_date_time',
        'proslamtnctrast_created_by',
        'proslamtnctrast_deletion',
    ];

    public function getContractList()
    {
        return $this->belongsTo(SLAMaintenanceContractListModel::class, 'proslamtnctrast_contract_list_id');
    }

    public function getAsset()
    {
        return $this->belongsTo(AssetModel::class, 'proslamtnctrast_asset_id');
    }
}
