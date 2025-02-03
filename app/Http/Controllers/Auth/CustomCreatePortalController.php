<?php

namespace App\Http\Controllers\Auth;

// Coverdesk
use App\Models\User;
// Coverdesk

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PragmaRX\Google2FA\Google2FA;

class CustomCreatePortalController
{
    public function ClientUserGetStarted($token, $expiry, $clientID)
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

                return view('auth.register-get-started', compact('clientID'));
            } else {
                if (! empty($ClientUser->password)) {
                    return view('auth.password-created');
                } else {
                    return view('auth.register-expired');
                }
            }
        } else {
            if (! empty($ClientUser->password)) {
                return view('auth.password-created');
            } else {
                return view('auth.register-expired');
            }
        }
    }

    public function ClientUserPortalFirstTime($clientID)
    {
        $ClientIDDecrypt = Crypt::decrypt($clientID);
        $ClientUser = User::find($ClientIDDecrypt);

        if (! empty($ClientUser)) {
            if (empty($ClientUser->password)) {
                return view('auth.register-first-time', compact('clientID'));
            } else {
                return view('auth.password-created');
            }
        } else {
            return view('auth.register-error');
        }
    }

    public function ClientUserPortalFirstTimeSubmit(Request $request)
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

            // Enable 2FA
            $google2fa = app(Google2FA::class);
            $ClientUser->two_factor_secret = encrypt($google2fa->generateSecretKey());
            $ClientUser->save();
            // Enable 2FA

            $UserFound = $ClientUser;

            return view('auth.register-two-factor', compact('UserFound'));
        }
    }

    public function ClientUserPortalTwoFactor(Request $request)
    {
        return view('auth.register-two-factor');
    }

    public function ClientUserPortalTwoFactorSubmit(Request $request)
    {
        if (empty($request->code)) {
            return redirect()->back()->with('auth-2fa-empty', 'Your 2FA credential is empty, please try again.');
        }

        $user = User::find(decrypt($request->client_id));

        $google2fa = app(Google2FA::class);

        $User2faDecrypt = decrypt($user->two_factor_secret);

        $valid = $google2fa->verifyKey($User2faDecrypt, $request->code);

        if ($valid) {
            Auth::login($user);

            $ClientUser = User::find(Auth::user()->_id);
            $ClientUser->stfusr_portal_two_factor_activation = '1';
            $ClientUser->stfusr_portal_two_factor_disabled = '0';
            $ClientUser->stfusr_portal_status = 'a';
            $ClientUser->save();

            return redirect()->route('dashboard.home');
        } else {
            $UserFound = $user;
            $incorrect2FA = '1';

            return view('auth.register-two-factor', compact('UserFound', 'incorrect2FA'));
        }
    }
}
