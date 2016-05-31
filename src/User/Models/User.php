<?php

namespace Alpaca\User\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, EntrustUserTrait;

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
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Fill the model with an array of attributes.
     *
     * @param array $attributes
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     *
     * @return $this
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (array_key_exists('password', $attributes)) {
            // encrypt password
            $this->password = bcrypt($this->password);
        }

        return $this;
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
}
