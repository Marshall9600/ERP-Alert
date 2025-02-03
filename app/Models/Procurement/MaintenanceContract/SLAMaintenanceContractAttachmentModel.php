<?php

namespace App\Models\Procurement\MaintenanceContract;

use Jenssegers\Mongodb\Eloquent\Model;

class SLAMaintenanceContractAttachmentModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'procurement_sla_maintenance_contract_attachment';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'proslamtnctratm_contract_id',
        'proslamtnctratm_attachment_name',
        'proslamtnctratm_attachment_path',
        'proslamtnctratm_created_date',
        'proslamtnctratm_created_date_time',
        'proslamtnctratm_created_by',
        'proslamtnctratm_deletion',
    ];

    public function getContract()
    {
        return $this->belongsTo(SLAMaintenanceContractModel::class, 'proslamtnctratm_contract_id');
    }
}
