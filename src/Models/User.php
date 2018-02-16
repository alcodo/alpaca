<?php

namespace Alpaca\Models;

use Alpaca\Traits\Permission;
use Alpaca\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;

class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable, Permission;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'verified'];

    // verification_token

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'verified' => 'boolean',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getCreated()
    {
        return dateintl_full('short', $this->created_at);
    }

    public function getUpdated()
    {
        return dateintl_full('medium', $this->updated_at);
    }

    public function getRoles()
    {
        return $this->roles->implode('display_name', ', ');
    }

    public function getVerified()
    {
        if ($this->verified) {
            return '<i class="fa fa-check text-success" aria-hidden="true"></i>';
        }

        return '<i class="fa fa-times text-danger" aria-hidden="true"></i>';
    }
}
