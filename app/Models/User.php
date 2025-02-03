<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $table = 'staff_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'stfusr_status',
        'stfusr_domain_username',
        'stfusr_title',
        'name',
        'stfusr_last_name',
        'email',                   // ENCRYPTED
        'stfusr_email',            // NOT ENCRYPTED
        'stfusr_email_domain',     // NOT ENCRYPTED
        'stfusr_office_number',    // ENCRYPTED
        'stfusr_mobile_number',    // ENCRYPTED
        'stfusr_department',
        'stfusr_position',
        'stfusr_staff_id',
        'stfusr_signature',
        'stfusr_job_description',
        'stfusr_admin_note',

        'stfusr_address',
        'stfusr_postcode',
        'stfusr_city',
        'stfusr_state',
        'stfusr_country',

        'stfusr_onboard_date',
        'stfusr_transfer_date',
        'stfusr_resign_date',

        'password',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'two_factor_confirmed_at',
        'remember_token',
        'stfusr_portal_status',
        'stfusr_portal_rights',
        'stfusr_portal_expiration',
        'stfusr_portol_token',
        'stfusr_portal_two_factor_activation',
        'stfusr_portal_two_factor_disabled',

        'stfusr_profile_image',

        'stfusr_drag_id',

        'stfusr_last_login',
        'stfusr_created_date',
        'stfusr_created_date_time',
        'stfusr_modified_date',
        'stfusr_modified_date_time',
        'stfusr_created_by',
        'stfusr_deletion',

        'token',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
