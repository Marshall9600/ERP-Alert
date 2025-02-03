<?php

namespace App\Models\Log\Coverdesk\Alert;

use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model;

class LogAlertModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'logs_coverdesk_alert';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'lgcvdalrt_alert_id',
        'lgcvdalrt_event',
        'lgcvdalrt_type',
        'lgcvdalrt_category',
        'lgcvdalrt_status',
        'lgcvdalrt_color_code',
        'lgcvdalrt_icon_code',
        'lgcvdalrt_role_type',
        'lgcvdalrt_role_id',
        'lgcvdalrt_remarks',
        'lgcvdalrt_created_date',
        'lgcvdalrt_created_date_time',
        'lgcvdalrt_created_by',
        'lgcvdalrt_created_computer_ip',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'lgcvdalrt_created_by');
    }
}

// ALERT LOG ID NAME
// --lgcvdalrt_role_id = "cvt"    -->  CONVERT TICKET
// --lgcvdalrt_role_id = "asg"    -->  ASSIGN TICKET
// --lgcvdalrt_role_id = "rmv"    -->  REMOVED FROM TICKET
// --lgcvdalrt_role_id = "2"      -->  MERGED
// --lgcvdalrt_role_id = "1"      -->  DELETED
