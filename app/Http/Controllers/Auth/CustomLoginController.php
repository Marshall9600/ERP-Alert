<?php

namespace App\Http\Controllers\Auth;

// Model
use App\Models\User;
// Model

use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use PragmaRX\Google2FA\Google2FA;

class CustomLoginController
{
    use TwoFactorAuthenticatable;

    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function ClientUseLanding(Request $request)
    {
        if (Auth::check()) {
            // LAST LOGIN
            $user = $request->user();
            $user->stfusr_last_login = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
            // LAST LOGIN

            // LOGIN LOGS
            $user_first_name = $user->name ?? '';
            $user_last_name = $user->stfusr_last_name ?? '';
            // LOGIN LOGS

            return redirect()->route('coverdesk.alert');
        } else {
            return view('auth.login');
        }
    }

    public function ClientUseLogin(Request $request)
    {
        $Users = User::where('stfusr_deletion', '0')->get();

        $UserFound = '';
        $EmailFound = '';
        $PasswordFound = '';
        $StatusFound = '';
        $StatusPortalFound = '';
        $AuthActivationFound = '';
        $TwoFactorDisabledFound = '';
        foreach ($Users as $user) {
            if ($request->email == Crypt::decryptString($user->email)) {
                $UserFound = $user;
                $EmailFound = Crypt::decryptString($user->email);
                $PasswordFound = $user->password;
                $StatusFound = $user->stfusr_status;
                $StatusPortalFound = $user->stfusr_portal_status;
                $AuthActivationFound = $user->stfusr_portal_two_factor_activation;
                $TwoFactorDisabledFound = $user->stfusr_portal_two_factor_disabled;
            }
        }

        if ($request->email == $EmailFound && Hash::check($request->password, $PasswordFound) && $StatusFound == 'a') {
            // CHECK IF INACTIVE PORTAL
            if ($StatusPortalFound !== 'a') {
                return redirect()->back()->with('auth-login-inactive', 'Your portal is not active, kindly contact our support for more info.');
            }
            // CHECK IF INACTIVE PORTAL

            // CHECK IF REMEMBER ME
            if (! empty($request->remember)) {
                $remember = $request->remember;
            } else {
                $remember = '';
            }
            // CHECK IF REMEMBER ME

            // CHECK IF 2FA IS REGISTERED
            if ($AuthActivationFound == '1') {
                return view('auth.login-two-factor', compact('UserFound', 'remember'));
            } else {
                return view('auth.register-two-factor', compact('UserFound', 'remember'));
            }
            // CHECK IF 2FA IS REGISTERED
        } else {
            return redirect()->route('auth.login')->with('auth-login-incorrect', 'Your login credential was incorrect, please try again.');
        }
    }

    public function ClientUserRegisterTwoFactor(Request $request)
    {
        return view('auth.register-two-factor');
    }

    public function ClientUserLoginTwoFactor(Request $request)
    {
        return view('auth.login-two-factor');
    }

    public function ClientUserLoginTwoFactorSubmit(Request $request)
    {
        if (empty($request->code)) {
            return redirect()->back()->with('auth-2fa-empty', 'Your 2FA credential is empty, please try again.');
        }

        $user = User::find(decrypt($request->client_id));

        $google2fa = app(Google2FA::class);

        $User2faDecrypt = decrypt($user->two_factor_secret);

        $valid = $google2fa->verifyKey($User2faDecrypt, $request->code);

        if ($valid == true) {
            if (! empty($request->remember)) {
                Auth::login($user, true);
            } else {
                Auth::login($user);
            }

            // LAST LOGIN
            $user->stfusr_last_login = Carbon::now()->format('Y-m-d H:i:s');
            $user->save();
            // LAST LOGIN

            // LOGIN LOGS
            $user_first_name = $user->name ?? '';
            $user_last_name = $user->stfusr_last_name ?? '';
            // LOGIN LOGS

            return redirect()->route('coverdesk.alert');
        } else {
            $UserFound = $user;
            $remember = $request->remember;
            $incorrect2FA = '1';

            return view('auth.login-two-factor', compact('UserFound', 'remember', 'incorrect2FA'));
        }
    }

    public function ClientUseLogout(Request $request)
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
