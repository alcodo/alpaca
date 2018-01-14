<?php

namespace Alpaca\Models;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Alpaca\Notifications\ResetPassword;

class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable;
//    use Notifiable, EntrustUserTrait;

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
    protected $fillable = ['name', 'email', 'password', 'verified', 'email_token'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function verified()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
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
