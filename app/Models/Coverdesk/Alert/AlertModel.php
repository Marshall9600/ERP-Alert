<?php

namespace App\Models\Coverdesk\Alert;

use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model;

class AlertModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'coverdesk_alert';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'cvdalrt_ticket_id',
        'cvdalrt_ticket_original_id',
        'cvdalrt_id',
        'cvdalrt_subject',
        'cvdalrt_body_html',
        'cvdalrt_body',
        'cvdalrt_from',
        'cvdalrt_to',
        'cvdalrt_cc',

        'cvdalrt_status',

        'cvdalrt_saved_read',
        'cvdalrt_saved_new_alert',

        'cvdalrt_created_date',
        'cvdalrt_created_date_time',
        'cvdalrt_modified_date',
        'cvdalrt_modified_date_time',
        'cvdalrt_closed_date',
        'cvdalrt_closed_date_time',
        'cvdalrt_created_by',
        'cvdalrt_deletion',
    ];

    public function getCustody()
    {
        return $this->belongsTo(User::class, 'cvdalrt_custody_id');
    }
}

// ALERT STATUS NAME
// --cvdalrt_threshold_type  = "h"     -->  HIGH
// --cvdalrt_threshold_type  = "l"     -->  LOW
// --cvdalrt_status          = "n"     -->  NEW
// --cvdalrt_status          = "cvt"   -->  CONVERTED
// --cvdalrt_status          = "c"     -->  CLOSED
// --cvdalrt_status          = "nmlog" -->  NORMAL LOG
// --cvdalrt_custody_id      = "cctd"  -->  CLOSED
// --cvdalrt_deletion        = "2"     -->  TAKEN
// --cvdalrt_deletion        = "3"     -->  FALSE ALARM
// --cvdalrt_deletion        = "3"     -->  FALSE ALARM
