<?php

namespace App\Http\Controllers\CronJob;

// MODEL
use App\Models\API\Oauth\Oauth;
use App\Models\Coverdesk\Alert\AlertAttachmentModel;
use App\Models\Coverdesk\Alert\AlertModel;
use App\Models\Log\Coverdesk\Alert\LogAlertModel;
use App\Models\Setting\Alert\AlertBlacklistModel;
// LARAVEL
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
// PACKAGE
use Webklex\IMAP\Facades\Client;

class AlertController
{
    public function AlertCronJob(Request $request)
    {
        $OauthIMAP = Oauth::where('apioauth_alert_imap_id', '1')->first();
        config(['imap.accounts.Alert.password' => $OauthIMAP->apioauth_alert_imap_access_token]);

        set_time_limit(100000);

        $attachment_mask = \Webklex\PHPIMAP\Support\Masks\AttachmentMask::class;
        $client = Client::account('Alert');
        $client->connect();
        $client->setDefaultAttachmentMask($attachment_mask);
        $folder = $client->getFolderByName('INBOX');

        $aMessage = $folder->query()->where(['UNSEEN'])->setFetchOrder('desc')->limit(10)->get();

        foreach ($aMessage as $bmessage) {
            $bmessage->setFlag('SEEN');

            $cvdalrt_from = $bmessage->getFrom()[0];
            $cvdalrt_created_at = new Carbon($bmessage->getAttributes()['date'][0]);
            $cvdalrt_from_domain = substr($cvdalrt_from->mail, strpos($cvdalrt_from->mail, '@') + 1);

            $AlertBlacklistModelArray = collect(AlertBlacklistModel::where('setalrtblklst_deletion', '0')->select('setalrtblklst_name')->get())->pluck('setalrtblklst_name')->toArray();

            if (in_array($cvdalrt_from->mail, $AlertBlacklistModelArray) == false) {  // <--- BLACKLIST RULES SETTING (If Exist)
                // SUBJECT
                $cvdalrt_subject_before = $bmessage->getSubject()[0] ?? '';

                if (preg_match('/=\?UTF-8\?B\?(.+)\?=/', $cvdalrt_subject_before, $matches)) {
                    $decodedSubject = base64_decode($matches[1]);
                } else {
                    $decodedSubject = $cvdalrt_subject_before;
                }

                if (preg_match('/Fwd:|fw:|FW:|RE:|re:/i', $decodedSubject)) {
                    $cleaned_subject = preg_replace("/\b(FW|Fwd|RE|Re):\s*/i", '', $decodedSubject);
                    $cvdalrt_subject = trim($cleaned_subject);
                } else {
                    $cvdalrt_subject = $decodedSubject;
                }
                // SUBJECT

                // BODY
                if ($bmessage->hasHTMLBody() == true) {
                    $htmlContent = $bmessage->getHTMLBody() ?? '';
                } else {
                    $htmlContent = $bmessage->getRawBody() ?? '';
                }

                if (! empty($htmlContent)) {
                    $cvdalrtmsg_body_html = $htmlContent;
                    $cvdalrtmsg_body = strip_tags($htmlContent);
                } else {
                    $cvdalrtmsg_body_html = '';
                    $cvdalrtmsg_body = '';
                }
                // BODY

                // ALERTID GENERATOR
                $date = (new Carbon($bmessage->getDate()))->format('ymd');
                $randomString = sprintf('%06d', mt_rand(1, 999999));
                $AlertRandomString = '#'.$date.'-'.'A'.$randomString;
                // ALERTID GENERATOR

                // ATTACHMENTS
                // ARRAY
                $attachmentArray = [];
                $files = $bmessage->getAttachments()->all();
                foreach ($files as $file) {
                    $fileOriginalMime = explode('/', $file->getMimeType());
                    $fileOriginalMimePart = isset($fileOriginalMime[1]) ? $fileOriginalMime[1] : '';

                    $fileOriginalName = ($file->getAttributes()['name'] ?? '');
                    $fileOriginalPath = hash('sha256', $file->content).'.'.$fileOriginalMimePart;
                    $filePath = storage_path('app/public/Coverdesk/Alert/');
                    $file->save($filePath, $fileOriginalPath);

                    array_push($attachmentArray, [
                        'name' => $fileOriginalName,
                        'path' => $fileOriginalPath,
                        'type' => $fileOriginalMimePart,
                    ]);
                }
                // ARRAY

                // MESSAGE BODY REPLACE
                if (! empty($cvdalrtmsg_body_html) && ! empty($attachmentArray) && is_array($attachmentArray)) {
                    // FILTER IMAGE FILE ONLY
                    $filterAttachTypes = array_filter($attachmentArray, function ($attachmentArray) {

                        $AttachTypeName = $attachmentArray['type'] ?? '';

                        return $AttachTypeName == 'png' || $AttachTypeName == 'jpeg' || $AttachTypeName == 'jpg';
                    });
                    // FILTER IMAGE FILE ONLY

                    // GET ALL <IMG>
                    preg_match_all('/<img\s[^>]*>/i', $cvdalrtmsg_body_html, $attach_body_matches);
                    // GET ALL <IMG>

                    // REPLACE BODY
                    $GetBodyMessageReplaceSRCArray = [];
                    $GetBodyMessageReplaceFilePathArray = [];
                    foreach ($filterAttachTypes as $filterAttachType) {
                        foreach ($attach_body_matches[0] as $attach_body_match) {
                            if (Str::contains($attach_body_match, ($filterAttachType['name'] ?? ''))) {
                                preg_match('/src="([^"]*)"/i', $attach_body_match, $src);

                                $fileImagePath = asset('/storage/Coverdesk/Alert/'.($filterAttachType['path'] ?? ''));

                                array_push($GetBodyMessageReplaceSRCArray, $src[1]);
                                array_push($GetBodyMessageReplaceFilePathArray, $fileImagePath);
                            }
                        }
                    }
                    // REPLACE BODY

                    $cvdalrtmsg_body_html_replaced = str_replace($GetBodyMessageReplaceSRCArray, $GetBodyMessageReplaceFilePathArray, ($cvdalrtmsg_body_html ?? ''));
                } else {
                    $cvdalrtmsg_body_html_replaced = ($cvdalrtmsg_body_html ?? '');
                }
                // MESSAGE BODY REPLACE
                // ATTACHMENTS

                // GET TO & CC
                $cvdalrt_toAll = [];
                foreach ($bmessage->getTo()->all() as $ToEmail) {
                    array_push($cvdalrt_toAll, Crypt::encryptString($ToEmail->mail));
                }

                $cvdalrt_ccAll = [];
                foreach ($bmessage->getCc()->all() as $CCEmail) {
                    array_push($cvdalrt_ccAll, Crypt::encryptString($CCEmail->mail));
                }
                // GET TO & CC

                // STORE ALERT, SEND AUTO
                // ALERT ID
                AlertModel::firstOrCreate([
                    'cvdalrt_ticket_id' => '',
                    'cvdalrt_ticket_original_id' => '',
                    'cvdalrt_id' => $AlertRandomString,
                    'cvdalrt_subject' => $cvdalrt_subject ?? '',
                    'cvdalrt_body_html' => $cvdalrtmsg_body_html_replaced ?? '',
                    'cvdalrt_body' => $cvdalrtmsg_body ?? '',
                    'cvdalrt_from' => Crypt::encryptString($bmessage->getFrom()[0]->mail) ?? '',
                    'cvdalrt_to' => $cvdalrt_toAll ?? [],
                    'cvdalrt_cc' => $cvdalrt_ccAll ?? [],

                    'cvdalrt_status' => 'n',

                    'cvdalrt_saved_read' => [],
                    'cvdalrt_saved_new_alert' => [],

                    'cvdalrt_created_date' => Carbon::parse($cvdalrt_created_at)->setTimezone('Asia/Kuala_Lumpur')->format('Y-m-d'),
                    'cvdalrt_created_date_time' => Carbon::parse($cvdalrt_created_at)->setTimezone('Asia/Kuala_Lumpur')->format('Y-m-d H:i:s'),
                    'cvdalrt_modified_date' => '',
                    'cvdalrt_modified_date_time' => '',
                    'cvdalrt_closed_date' => '',
                    'cvdalrt_closed_date_time' => '',
                    'cvdalrt_created_by' => '',
                    'cvdalrt_deletion' => '0',
                ]);
                // ALERT ID

                // ALERT CONVERSATION
                $AlertIDNew = AlertModel::where('cvdalrt_id', $AlertRandomString)->first();

                if (! empty($AlertIDNew->_id)) {
                    // STORE ATTACHMENT DATA
                    $attachmentIDArray = [];
                    foreach ($attachmentArray as $attachmentOne) {
                        AlertAttachmentModel::firstOrCreate([
                            'cvdalrtatm_alert_id' => $AlertIDNew->_id,
                            'cvdalrtatm_alert_original_id' => $AlertIDNew->_id,
                            'cvdalrtatm_attachment_name' => $attachmentOne['name'],
                            'cvdalrtatm_attachment_path' => $attachmentOne['path'],
                            'cvdalrtatm_created_date' => Carbon::now()->format('Y-m-d'),
                            'cvdalrtatm_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                            'cvdalrtatm_deletion' => '0',
                        ]);

                        $AlertAttachmentModelID = AlertAttachmentModel::latest()->first();

                        array_push($attachmentIDArray, $AlertAttachmentModelID->_id);
                    }
                    // STORE ATTACHMENT DATA

                    // LOGS
                    LogAlertModel::firstOrCreate([
                        'lgcvdalrt_alert_id' => $AlertIDNew->_id ?? '',
                        'lgcvdalrt_event' => 'Alert Message received from system',
                        'lgcvdalrt_type' => 'Alert Message Received',
                        'lgcvdalrt_category' => 'Received Alert Message',
                        'lgcvdalrt_status' => 'Successful',
                        'lgcvdalrt_color_code' => '#000000',
                        'lgcvdalrt_icon_code' => 'message-arrow-down',
                        'lgcvdalrt_role_type' => 'System',
                        'lgcvdalrt_role_id' => 'rcmsg',
                        'lgcvdalrt_remarks' => '',
                        'lgcvdalrt_created_date' => Carbon::now()->format('Y-m-d'),
                        'lgcvdalrt_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                        'lgcvdalrt_created_by' => '',
                        'lgcvdalrt_created_computer_ip' => '',
                    ]);

                    LogAlertModel::firstOrCreate([
                        'lgcvdalrt_alert_id' => $AlertIDNew->_id ?? '',
                        'lgcvdalrt_event' => "Alert id '".$AlertRandomString."' created by system",
                        'lgcvdalrt_type' => 'New Alert',
                        'lgcvdalrt_category' => 'Status',
                        'lgcvdalrt_status' => 'Successful',
                        'lgcvdalrt_color_code' => '#AE0000',
                        'lgcvdalrt_icon_code' => 'sparkles',
                        'lgcvdalrt_role_type' => 'System',
                        'lgcvdalrt_role_id' => 'n',
                        'lgcvdalrt_remarks' => '',
                        'lgcvdalrt_created_date' => Carbon::now()->format('Y-m-d'),
                        'lgcvdalrt_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                        'lgcvdalrt_created_by' => '',
                        'lgcvdalrt_created_computer_ip' => '',
                    ]);
                    // LOGS
                }
                // ALERT CONVERSATION
                // STORE ALERT, SEND AUTO
            }

        }

        return redirect()->route('coverdesk.alert');
    }
}
