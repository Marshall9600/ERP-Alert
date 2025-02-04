<?php

namespace App\Http\Controllers\Coverdesk;

// MODEL
use App\Models\Coverdesk\Alert\AlertAttachmentModel;
use App\Models\Coverdesk\Alert\AlertModel;
use App\Models\Log\Coverdesk\Alert\LogAlertModel;
use App\Models\Log\Coverdesk\Ticket\LogTicketModel;
use App\Models\Procurement\MaintenanceContract\SLAMaintenanceContractModel as ProcurementSLAContractModel;
// LARAVEL
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CoverdeskAlertController
{
    // INDEX
    public function AlertIndex(Request $request)
    {
        // NAVBAR
        $tabtop = 'alert';
        $tabsub = 'alert';
        // NAVBAR

        // FILTER
        $getOverallFilter = $request->getOverall;
        $getCreatedDateFromFilter = $request->getCreatedDateFrom;
        $getCreatedDateToFilter = $request->getCreatedDateTo;
        $getAlertIDFilter = $request->getAlertID;
        $getSourceFilter = $request->getSource;
        $getThresholdFilter = $request->getThreshold;
        $getStatusFilter = $request->getStatus;
        $getCustodyFilter = $request->getCustody;
        $getTicketFilter = $request->getTicket;

        $ModelQuery = AlertModel::query();
        $ModelQuery->where('cvdalrt_deletion', '0');

        // OVERALL
        if (empty($getOverallFilter) || $getOverallFilter == 'active') {
            $ModelQuery->where('cvdalrt_status', 'n');
        }

        // FROM DATE
        if (! empty($getCreatedDateFromFilter) && $getCreatedDateFromFilter !== Carbon::today()->format('Y-m-d')) {
            $FromStartDate = Carbon::createFromDate(Carbon::parse($getCreatedDateFromFilter)->format('Y'), Carbon::parse($getCreatedDateFromFilter)->format('m'), Carbon::parse($getCreatedDateFromFilter)->format('d'))->startOfDay();
            $ModelQuery->whereDate('cvdalrt_created_date', '>=', $FromStartDate);
        }

        // TO DATE
        if (! empty($getCreatedDateToFilter) && $getCreatedDateToFilter !== Carbon::today()->format('Y-m-d')) {
            $ToEndDate = Carbon::createFromDate(Carbon::parse($getCreatedDateToFilter)->format('Y'), Carbon::parse($getCreatedDateToFilter)->format('m'), Carbon::parse($getCreatedDateToFilter)->format('d'))->startOfDay();
            $ModelQuery->whereDate('cvdalrt_created_date', '<=', $ToEndDate);
        }

        // ALERT ID & SUBJECT
        if (! empty($getAlertIDFilter)) {
            $AlertModelNames = AlertModel::select('cvdalrt_subject', 'cvdalrt_id')->get()->toArray();
            $AlertModelID = [];
            foreach ($AlertModelNames as $AlertModelName) {
                if (Str::contains(Str::lower($AlertModelName['cvdalrt_subject']), Str::lower($getAlertIDFilter)) || Str::contains(Str::lower($AlertModelName['cvdalrt_id']), Str::lower($getAlertIDFilter))) {
                    array_push($AlertModelID, $AlertModelName['_id']);
                }
            }

            $ModelQuery->whereIn('_id', $AlertModelID);
        }

        // STATUS
        if (! empty($getStatusFilter)) {
            $ModelQuery->where('cvdalrt_status', $getStatusFilter);
        }
        // FILTER

        // SORTING
        if ($request->has('getSort')) {
            $sortColumn = $request->get('getSort');
            $sortDirection = $request->get('getDirection', 'asc'); // Default direction is ascending
            $ModelQuery->orderBy($sortColumn, $sortDirection);
            $ModelData = $ModelQuery->get();
        } else {
            $ModelData = $ModelQuery->orderBy('cvdalrt_created_date_time', 'desc')->get();
            $sortDirection = '';
        }
        // SORTING

        // PAGINATE
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($ModelData);
        $perPage = 15;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);
        $paginatedItems->setPath($request->fullUrl());
        $ModelPaginate = $paginatedItems;
        // PAGINATE

        // COUNT
        // ACTIVE
        $TotalNewCount = count($ModelData->where('cvdalrt_deletion', '0')->where('cvdalrt_status', 'n'));
        $TotalConvertedCount = count($ModelData->where('cvdalrt_deletion', '0')->where('cvdalrt_status', 'c'));
        $TotalActiveCount = count($ModelData->where('cvdalrt_deletion', '0'));
        // ACTIVE

        // ALL
        $TotalOverallCount = count($ModelData->where('cvdalrt_deletion', '0'));
        // ALL
        // COUNT

        return view('layouts.Coverdesk.Alert.index', compact(
            'tabtop', 'tabsub', // NAVBAR
            'ModelPaginate', // DATA
            'sortDirection', 'getOverallFilter', 'getCreatedDateFromFilter', 'getCreatedDateToFilter', 'getAlertIDFilter', 'getStatusFilter', 'getCustodyFilter', 'getTicketFilter', // FILTER
            'TotalNewCount', 'TotalConvertedCount', 'TotalActiveCount', 'TotalOverallCount', // COUNT
        ));
    }
    // INDEX

    // EDIT
    public function AlertEdit(Request $request)
    {
        // NAVBAR
        $tabtop = 'alert';
        $tabsub = 'alert';
        // NAVBAR

        $ModelData = AlertModel::where('cvdalrt_id', $request->query('AlertID'))->first();
        $AlertAttachmentModels = AlertAttachmentModel::orderBy('created_at', 'desc')->where('cvdalrtatm_alert_id', ($ModelData->_id ?? ''))->get();
        $LogAlertModels = LogAlertModel::orderBy('created_at', 'desc')->where('lgcvdalrt_alert_id', ($ModelData->_id ?? ''))->get();

        // REMEMBER READ
        $RememberRead = $ModelData->cvdalrt_saved_read ?? [];
        $NewRememberUser = Auth::user()->_id;

        if (! in_array($NewRememberUser, $RememberRead)) {
            $RememberRead[] = $NewRememberUser;
        }

        $ModelData->cvdalrt_saved_read = $RememberRead;
        $ModelData->save();
        // REMEMBER READ

        // OTHERS
        // CREATE TICKET
        $SLAMaintenanceContractModels = ProcurementSLAContractModel::where('proslamtnctr_status', 'a')->where('proslamtnctr_deletion', '0')->get();
        $SLAMaintenanceContractModelArray = [];
        foreach ($SLAMaintenanceContractModels as $SLAMaintenanceContractModel) {
            array_push($SLAMaintenanceContractModelArray, $SLAMaintenanceContractModel->proslamtnctr_company_id);
        }
        // CREATE TICKET
        // OTHERS

        return view('layouts.coverdesk.alert.edit', compact(
            'tabtop', 'tabsub', // NAVBAR
            'ModelData', 'AlertAttachmentModels', 'LogAlertModels', // DATA
        ));
    }
    // EDIT

    // UPDATE
    // DOWNLOAD ATTACHMENT
    public function AlertDownloadAttachment(Request $request)
    {
        $data = [
            'cvdalrtatm_attachment_name' => $request->cvdalrtatm_attachment_name,
            'cvdalrtatm_attachment_path' => $request->cvdalrtatm_attachment_path,
        ];

        $rules = [
            'cvdalrtatm_attachment_name' => 'required',
            'cvdalrtatm_attachment_path' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('coverdesk-alert-attachment-download-error', 'Download Error');
        } else {
            $NameAttach = $request->cvdalrtatm_attachment_name;
            $DownloadAttach = public_path('storage/Coverdesk/Alert/').$request->cvdalrtatm_attachment_path;

            try {
                $CheckFileExist = File::get($DownloadAttach);
            } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
                return redirect()->back()->with('coverdesk-alert-attachment-download-not-found', 'Download Failed');
            }

            $headers = [
                'Content-Type' => mime_content_type($DownloadAttach),
            ];

            ob_end_clean();

            return response()->download($DownloadAttach, $NameAttach, $headers);
        }
    }
    // DOWNLOAD ATTACHMENT

    public function AlertAssignTicket(Request $request)
    {
        $name = Auth::user()->name ?? '';
        $stfusr_last_name = Auth::user()->stfusr_last_name ?? '';

        $data = [
            'cvdalrt_ticket_id' => $request->cvdalrt_ticket_id,
        ];

        $rules = [
            'cvdalrt_ticket_id' => 'required',
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            LogAlertModel::firstOrCreate([
                'lgcvdalrt_alert_id' => ($request->_id ?? ''),
                'lgcvdalrt_event' => 'Failed to assign Alert to Ticket by staff name '.$name.' '.$stfusr_last_name,
                'lgcvdalrt_type' => 'Assign Alert to Ticket',
                'lgcvdalrt_category' => 'Status',
                'lgcvdalrt_status' => 'Failed',
                'lgcvdalrt_color_code' => '#1e87f0',
                'lgcvdalrt_icon_code' => 'arrow-turn-right',
                'lgcvdalrt_role_type' => 'User',
                'lgcvdalrt_role_id' => 'c',
                'lgcvdalrt_remarks' => '',
                'lgcvdalrt_created_date' => Carbon::now()->format('Y-m-d'),
                'lgcvdalrt_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'lgcvdalrt_created_by' => '',
                'lgcvdalrt_created_computer_ip' => '',
            ]);

            return redirect()->back()->with('coverdesk-ticket-assign-error', 'Assigned Error');
        } else {
            $AlertModel = AlertModel::find($request->_id);

            if (! empty($AlertModel->_id)) {
                LogTicketModel::firstOrCreate([
                    'lgcvdtic_ticket_id' => ($TicketModel->_id ?? ''),
                    'lgcvdtic_ticket_original_id' => ($TicketModel->_id ?? ''),
                    'lgcvdtic_ticket_message_id' => '',
                    'lgcvdtic_queue_id' => '',
                    'lgcvdtic_event' => "Alert from '".($AlertModel->cvdalrt_id ?? 'N/A')."' assigned into Ticket '".($TicketModel->cvdtic_id ?? 'N/A')."' by staff name ".$name.' '.$stfusr_last_name,
                    'lgcvdtic_type' => 'Assigned from Alert',
                    'lgcvdtic_category' => 'Alert',
                    'lgcvdtic_status' => 'Successful',
                    'lgcvdtic_color_code' => '#1e87f0',
                    'lgcvdtic_icon_code' => 'arrow-turn-right',
                    'lgcvdtic_role_type' => 'User',
                    'lgcvdtic_role_id' => 'alt',
                    'lgcvdtic_remarks' => '',
                    'lgcvdtic_created_date' => Carbon::now()->format('Y-m-d'),
                    'lgcvdtic_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                    'lgcvdtic_created_by_owner' => 'e',
                    'lgcvdtic_created_by_id' => Auth::user()->_id,
                    'lgcvdtic_created_computer_ip' => $request->header('X-Forwarded-For'),
                ]);

                LogAlertModel::firstOrCreate([
                    'lgcvdalrt_alert_id' => ($request->_id ?? ''),
                    'lgcvdalrt_event' => "Alert assigned to ticket '".($TicketModel->cvdtic_id ?? 'N/A')."' by staff name ".$name.' '.$stfusr_last_name,
                    'lgcvdalrt_type' => 'Assign Alert to Ticket',
                    'lgcvdalrt_category' => 'Assign',
                    'lgcvdalrt_status' => 'Successful',
                    'lgcvdalrt_color_code' => '#1e87f0',
                    'lgcvdalrt_icon_code' => 'arrow-turn-right',
                    'lgcvdalrt_role_type' => 'User',
                    'lgcvdalrt_role_id' => 'asg',
                    'lgcvdalrt_remarks' => '',
                    'lgcvdalrt_created_date' => Carbon::now()->format('Y-m-d'),
                    'lgcvdalrt_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
                    'lgcvdalrt_created_by' => '',
                    'lgcvdalrt_created_computer_ip' => '',
                ]);

                $AlertModel->cvdalrt_ticket_id = ($TicketModel->_id ?? '');
                $AlertModel->cvdalrt_ticket_original_id = ($TicketModel->_id ?? '');
                $AlertModel->cvdalrt_status = 'c';
                $AlertModel->save();
            }

            return redirect()->back()->with('coverdesk-ticket-assign', 'Assigned');
        }
    }

    public function AlertDelete(Request $request)
    {
        $ModelData = AlertModel::find($request->_id);
        $ModelData->cvdalrt_status = 'c';
        $ModelData->cvdalrt_deletion = '1';
        $ModelData->cvdalrt_modified_date = Carbon::now()->format('Y-m-d');
        $ModelData->cvdalrt_modified_date_time = Carbon::now()->format('Y-m-d H:i:s');
        $ModelData->cvdalrt_closed_date = Carbon::now()->format('Y-m-d');
        $ModelData->cvdalrt_closed_date_time = Carbon::now()->format('Y-m-d H:i:s');

        $name = Auth::user()->name ?? '';
        $stfusr_last_name = Auth::user()->stfusr_last_name ?? '';

        LogAlertModel::firstOrCreate([
            'lgcvdalrt_alert_id' => $ModelData->_id,
            'lgcvdalrt_event' => 'Alert is deleted by staff name '.$name.' '.$stfusr_last_name,
            'lgcvdalrt_type' => 'Delete Alert',
            'lgcvdalrt_category' => 'Delete',
            'lgcvdalrt_status' => 'Successful',
            'lgcvdalrt_color_code' => '#ff4151',
            'lgcvdalrt_icon_code' => 'trash',
            'lgcvdalrt_role_type' => 'User',
            'lgcvdalrt_role_id' => '1',
            'lgcvdalrt_remarks' => '',
            'lgcvdalrt_created_date' => Carbon::now()->format('Y-m-d'),
            'lgcvdalrt_created_date_time' => Carbon::now()->format('Y-m-d H:i:s'),
            'lgcvdalrt_created_by_owner' => 'e',
            'lgcvdalrt_created_by_id' => Auth::user()->_id,
            'lgcvdalrt_created_computer_ip' => $request->header('X-Forwarded-For'),
        ]);

        $ModelData->save();

        // TEST
            // $source = $_GET['input'];
            // $response = new Response($source);

            // Reflected XSS
            // $query = $request->input('query');
            // return response("You searched for: " . $query);

            // XSS via URL Redirects
            $url = $request->input('next');
            return redirect($url);

            // Allowing unfiltered HTML content in WordPress is security-sensitive
            // define( 'DISALLOW_UNFILTERED_HTML', false );

            // Remote Code Execution (RCE)
            // $command = $request->input('cmd');
            // return shell_exec($command);

            // SQL Injection (SQLi)
            // $keyword = $request->input('query');
            // $users = DB::select("SELECT * FROM users WHERE name = '$keyword'"); // 🚨 Vulnerable to SQLi
            // return response()->json($users);
        // TEST

        // return redirect()->route('coverdesk.alert')->with('coverdesk-alert-delete', 'Deleted');
    }
    // UPDATE

    // NOTIFIER
    public function AlertPushNewAlert(Request $request)
    {
        $AlertIDDatas = AlertModel::latest()->where('cvdalrt_deletion', '0')->where('cvdalrt_status', 'n')->select('_id', 'cvdalrt_saved_new_alert')->take(10)->get();

        $RememberCountArray = [];
        if (! empty($AlertIDDatas) && count($AlertIDDatas) !== 0) {
            foreach ($AlertIDDatas as $AlertIDData) {
                if (in_array(Auth::user()->_id ?? '', $AlertIDData->cvdalrt_saved_new_alert ?? []) == false) {
                    array_push($RememberCountArray, '1');

                    $RememberAlert = $AlertIDData->cvdalrt_saved_new_alert ?? [];
                    $NewRememberAlert = Auth::user()->_id ?? '';

                    if (! in_array($NewRememberAlert, $RememberAlert)) {
                        $RememberAlert[] = $NewRememberAlert;
                    }

                    $AlertIDData->cvdalrt_saved_new_alert = $RememberAlert;
                    $AlertIDData->save();
                }
            }
        }

        $RememberCount = count($RememberCountArray);

        return response()->json([
            'success' => $RememberCount,
        ]);
    }
    // NOTIFIER
}
