 <?php

use Illuminate\Support\Facades\Route;

// AUTH
// LANDING
Route::get('/', 'Auth\CustomLoginController@ClientUseLanding')->name('auth.login');
// LANDING

// LOGIN
Route::post('/auth/user-login', 'Auth\CustomLoginController@ClientUseLogin')->name('auth.user.login');
// LOGIN

// LOGIN 2FA
Route::get('/auth/login/two_factor', 'Auth\CustomLoginController@ClientUserLoginTwoFactor')->name('auth.login.two.factor');
Route::post('/auth/login/two_factor/submit', 'Auth\CustomLoginController@ClientUserLoginTwoFactorSubmit')->name('auth.login.two.factor.submit');
// LOGIN 2FA

// FORGOT PASSWORD
Route::get('/auth/reset_password', 'Auth\CustomForgotPasswordController@ClientUserForgotPassword')->name('auth.portal.reset.password');
Route::post('/auth/reset_password/send/portal', 'Auth\CustomForgotPasswordController@ClientUserForgotPasswordSend')->name('auth.portal.reset.password.send');
Route::get('/auth/reset_password/{token}/{expiry}/{clientID}', 'Auth\CustomForgotPasswordController@ClientUserForgotPasswordStart')->name('auth.portal.reset.password.started');
Route::get('/auth/reset_password/reset/{clientID}', 'Auth\CustomForgotPasswordController@ClientUserForgotPasswordReset')->name('auth.portal.reset.password.reset');
Route::post('/auth/reset_password/submit/reset', 'Auth\CustomForgotPasswordController@ClientUserForgotPasswordResetSubmit')->name('auth.portal.reset.password.reset.submit');
// FORGOT PASSWORD

// REGISTER
Route::get('/auth/get_started/{token}/{expiry}/{clientID}', 'Auth\CustomCreatePortalController@ClientUserGetStarted')->name('auth.portal.get.started');
Route::get('/auth/create_account/first_time/{clientID}', 'Auth\CustomCreatePortalController@ClientUserPortalFirstTime')->name('auth.portal.first.time');
Route::get('/auth/create_account/submit/first_time', 'Auth\CustomCreatePortalController@ClientUserPortalFirstTimeSubmit')->name('auth.portal.first.time.submit');
// REGISTER

// REGISTER 2FA
Route::get('/auth/register/two_factor', 'Auth\CustomLoginController@ClientUserRegisterTwoFactor')->name('auth.register.two.factor');
Route::get('/auth/create_account/two_factor', 'Auth\CustomCreatePortalController@ClientUserPortalTwoFactor')->name('auth.portal.two.factor');
Route::post('/auth/create_account/two_factor/submit', 'Auth\CustomCreatePortalController@ClientUserPortalTwoFactorSubmit')->name('auth.portal.two.factor.submit');
// REGISTER 2FA
// AUTH

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // ALERT
    Route::post('/coverdesk/ticket/store', 'Coverdesk\CoverdeskTicketController@TicketStore')->name('coverdesk.ticket.store');
    Route::post('/coverdesk/ticket/edit', 'Coverdesk\CoverdeskTicketController@TicketEdit')->name('coverdesk.ticket.edit');
    Route::get('/coverdesk/alert', 'Coverdesk\CoverdeskAlertController@AlertIndex')->name('coverdesk.alert');
    Route::get('/coverdesk/alert/edit', 'Coverdesk\CoverdeskAlertController@AlertEdit')->name('coverdesk.alert.edit');
    Route::put('/coverdesk/alert/download/attachment', 'Coverdesk\CoverdeskAlertController@AlertDownloadAttachment')->name('coverdesk.alert.download.attachment');

    Route::put('/coverdesk/alert/assign/ticket', 'Coverdesk\CoverdeskAlertController@AlertAssignTicket')->name('coverdesk.alert.assign.ticket');
    Route::put('/coverdesk/alert/delete', 'Coverdesk\CoverdeskAlertController@AlertDelete')->name('coverdesk.alert.delete');

    // JQUERY
    Route::get('/coverdesk/alert/push/new/alert', 'Coverdesk\CoverdeskAlertController@AlertPushNewAlert')->name('coverdesk.alert.push.new.alert');
    Route::post('/coverdesk/alert/store/filter/ticket', 'Coverdesk\CoverdeskAlertController@AlertStoreSearchTicket')->name('coverdesk.alert.store.search.ticket'); // Dynamic Dropdown
    // JQUERY
    // ALERT
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // PORTAL MANAGEMENT
    Route::get('/auth/create_account/two_factor/forgot/{email}/{password}', 'Auth\CustomCreatePortalController@ClientUserPortalTwoFactorForgot')->name('auth.portal.two.factor.forgot');
    Route::get('/auth/user-logout', 'Auth\CustomLoginController@ClientUseLogout')->name('auth.user.logout');
    // PORTAL MANAGEMENT

    // ADMIN
    Route::view('/admin_area', 'layouts.Admin.index')->name('admin.area.dashboard');

    // GENERAL
    Route::get('/admin_area/general', 'Admin\AdminGeneralController@AdminGeneral')->name('admin.area.general');
    Route::put('/admin_area/general/update', 'Admin\AdminGeneralController@AdminGeneralUpdate')->name('admin.area.general.update');
    // GENERAL
    // ADMIN
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
});
