<?php

namespace App\Models\Coverdesk\Alert;

use Jenssegers\Mongodb\Eloquent\Model;

class AlertAttachmentModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'coverdesk_alert_attachment';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'cvdalrtatm_alert_id',
        'cvdalrtatm_alert_original_id',
        'cvdalrtatm_attachment_name',
        'cvdalrtatm_attachment_path',
        'cvdalrtatm_created_date',
        'cvdalrtatm_created_date_time',
        'cvdalrtatm_deletion',
    ];
}
