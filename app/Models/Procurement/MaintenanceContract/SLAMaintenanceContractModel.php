<?php

namespace App\Models\Procurement\MaintenanceContract;

use App\Models\Client\Company\CompanyModel;
use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model;

class SLAMaintenanceContractModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'procurement_sla_maintenance_contract';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'proslamtnctr_company_id',
        'proslamtnctr_status',
        'proslamtnctr_id',
        'proslamtnctr_start_date',
        'proslamtnctr_expire_date',
        'proslamtnctr_admin_note',
        'proslamtnctr_created_date',
        'proslamtnctr_created_date_time',
        'proslamtnctr_modified_date',
        'proslamtnctr_modified_date_time',
        'proslamtnctr_created_by',
        'proslamtnctr_deletion',
    ];

    public function getCompany()
    {
        return $this->belongsTo(CompanyModel::class, 'proslamtnctr_company_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'proslamtnctr_created_by');
    }
}
