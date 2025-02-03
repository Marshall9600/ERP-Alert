<?php

namespace App\Http\Controllers\Auth;

// Coverdesk
use App\Jobs\Admin\SendingForgotPassword;
// Coverdesk

// Jobs
use App\Models\User;
// Jobs

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomForgotPasswordController
{
    public function ClientUserForgotPassword(Request $request)
    {
        return view('auth.forgot-password');
    }

    public function ClientUserForgotPasswordSend(Request $request)
    {
        $ManageUser = User::find($request->_id);
        $token = uniqid();
        $time = Carbon::now()->format('Y-m-d H:i:s');
        $clientID = $ManageUser->_id;
        $clientName = $ManageUser->name;
        $domain = env('ADMIN_URL');

        // Save
        $ManageUser->stfusr_portol_token = $token;
        $ManageUser->stfusr_portal_expiration = $time;
        $ManageUser->save();
        // Save

        // Send Email
        $details = [
            'clientName' => $clientName,
            'domain' => $domain,
            'token' => $token,
            'time' => $time,
            'clientID' => Crypt::encrypt($clientID),
        ];
        $sub = 'Submit A Reset Password';

        $email = Crypt::decryptString($ManageUser->email);

        SendingForgotPassword::dispatch($email, $details, $sub);
        // Send Email

        return redirect()->back()->with('home-staff-employee-portal-update', 'Updated!');
    }

    public function ClientUserForgotPasswordStart($token, $expiry, $clientID)
    {
        $ClientIDDecrypt = Crypt::decrypt($clientID);
        $ClientUser = User::find($ClientIDDecrypt);

        // LAST SENT
        if (! empty($ClientUser->stfusr_portal_expiration)) {
            $LastSentFrom = Carbon::createFromFormat('Y-m-d H:i:s', $ClientUser->stfusr_portal_expiration);
            $LastSentTo = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->format('Y-m-d H:i:s'));
            $diff_in_hours = $LastSentFrom->diffInHours($LastSentTo);
        } else {
            $diff_in_hours = '';
        }
        // LAST SENT

        if ($ClientUser->stfusr_portol_token == $token) {
            if (stripslashes($diff_in_hours) <= 24 == true) {
                $ClientUser->stfusr_portol_token = '';
                $ClientUser->stfusr_portal_expiration = '';
                $ClientUser->save();

                return view('auth.forgot-password-get-started', compact('clientID'));
            } else {
                return view('auth.forgot-password-expired');
            }
        } else {
            return view('auth.forgot-password-expired');
        }
    }

    public function ClientUserForgotPasswordReset($clientID)
    {
        $ClientIDDecrypt = Crypt::decrypt($clientID);
        $ClientUser = User::find($ClientIDDecrypt);

        if (! empty($ClientUser)) {
            return view('auth.forgot-password-reset', compact('clientID'));
        } else {
            return view('auth.forgot-password-error');
        }
    }

    public function ClientUserForgotPasswordResetSubmit(Request $request)
    {
        $ClientIDDecrypt = Crypt::decrypt($request->clientID);
        $ClientUser = User::find($ClientIDDecrypt);

        $inputs = request()->validate([
            'password' => 'required',
            'password_confirmation' => 'required',
        ]);

        $rules = [
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'password_confirmation' => [
                'required',
                'same:password',
            ],
        ];

        $validation = Validator::make($inputs, $rules);

        if ($validation->fails()) {
            // If Failed
            $validationInvalid = $validation->errors()->all();

            return redirect()->back()->with('auth-password-failed', $validationInvalid);
        } else {
            // If Success
            if (! empty($ClientUser)) {
                $ClientUser->password = Hash::make($request->password);
                $ClientUser->save();
            }

            // Delete Token & Expiration
            $ClientUser->stfusr_portol_token = '';
            $ClientUser->stfusr_portal_expiration = '';
            $ClientUser->save();
            // Delete Token & Expiration

            return view('auth.forgot-password-reset-completed');
        }
    }
}
