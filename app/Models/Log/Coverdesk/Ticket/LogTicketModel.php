<?php

namespace App\Models\Log\Coverdesk\Ticket;

use App\Models\Client\User\UserModel;
use App\Models\Coverdesk\Ticket\TicketMessageModel;
use App\Models\Coverdesk\Ticket\TicketModel;
use App\Models\User;
use Jenssegers\Mongodb\Eloquent\Model;

class LogTicketModel extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'logs_coverdesk_ticket';

    /**
     * The attributes which are mass assigned will be used.
     *
     * It will return @var array
     */
    protected $fillable = [
        'lgcvdtic_ticket_id',
        'lgcvdtic_ticket_original_id',
        'lgcvdtic_ticket_message_id',
        'lgcvdtic_queue_id',
        'lgcvdtic_event',
        'lgcvdtic_type',
        'lgcvdtic_category',
        'lgcvdtic_status',
        'lgcvdtic_color_code',
        'lgcvdtic_icon_code',
        'lgcvdtic_role_type',
        'lgcvdtic_role_id',
        'lgcvdtic_remarks',
        'lgcvdtic_created_date',
        'lgcvdtic_created_date_time',
        'lgcvdtic_created_by_owner',
        'lgcvdtic_created_by_id',
        'lgcvdtic_created_computer_ip',
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'lgcvdtic_created_by_id');
    }

    public function getClient()
    {
        return $this->belongsTo(UserModel::class, 'lgcvdtic_created_by_id');
    }

    public function getMessage()
    {
        return $this->belongsTo(TicketMessageModel::class, 'lgcvdtic_ticket_message_id');
    }

    public function getTicket()
    {
        return $this->belongsTo(TicketModel::class, 'lgcvdtic_ticket_original_id');
    }
}

// TICKET LOG ID NAME
// --lgcvdtic_role_id = "n"      -->  NEW
// --lgcvdtic_role_id = "atrp"   -->  AUTO RESPONSE
// --lgcvdtic_role_id = "susr"   -->  SELECTED USER
// --lgcvdtic_role_id = "scpn"   -->  SELECTED COMPANY
// --lgcvdtic_role_id = "ro"     -->  RE-OPEN
// --lgcvdtic_role_id = "alt"    -->  ALERT
// --lgcvdtic_role_id = "cssj"   -->  CHANGE SUBJECT
// --lgcvdtic_role_id = "csts"   -->  CHANGE ANY STATUS
// --lgcvdtic_role_id = "cctd"   -->  CHANGE CUSTODIAN
// --lgcvdtic_role_id = "cusr"   -->  CHANGE USER
// --lgcvdtic_role_id = "ccpn"   -->  CHANGE COMPANY
// --lgcvdtic_role_id = "csrv"   -->  CHANGE SERVICE
// --lgcvdtic_role_id = "csmr"   -->  CHANGE SUMMARY
// --lgcvdtic_role_id = "uvcr"   -->  USE VOUCHER
// --lgcvdtic_role_id = "upnt"   -->  ADD NOTE
// --lgcvdtic_role_id = "upspdc" -->  ADD SUPPORTING DOC
// --lgcvdtic_role_id = "rpmsg"  -->  REPLY MESSAGE
// --lgcvdtic_role_id = "rcmsg"  -->  RECEIVED MESSAGE
// --lgcvdtic_role_id = "c"      -->  CLOSED
// --lgcvdtic_role_id = "pc"     -->  PERMANENT CLOSED
// --lgcvdtic_role_id = "rtic"   -->  REF TICKET
// --lgcvdtic_role_id = "1"      -->  DELETED
// --lgcvdtic_role_id = "2"      -->  MERGED
// --lgcvdtic_role_id = "3"      -->  SPAM
