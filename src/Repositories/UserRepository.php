<?php

namespace Alpaca\Repositories;


use Alpaca\Events\User\UserWasCreated;
use Alpaca\Events\User\UserWasDeleted;
use Alpaca\Events\User\UserWasUpdated;
use Alpaca\Models\User;
use Illuminate\Support\Facades\Validator;

class UserRepository
{

    public function create(array $data): User
    {
        Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'verified' => 'nullable|boolean',
        ])->validate();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);


        if (isset($data['roles']) && !empty($data['roles'])) {
            $user->assignRole($data['roles']);
        }

        event(new UserWasCreated($user));

        return $user;
    }

    public function update(User $user, array $data): User
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|string|min:6',
            'verified' => 'nullable|boolean',
        ])->validate();

        // password
        if (array_key_exists('password', $data)) {
            if (is_null($data['password'])) {
                unset($data['password']);
            } elseif (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            }
        }

        $user->update($data);

        if (isset($data['roles']) && !empty($data['roles'])) {
            $roleRepo = new RoleRepository();
            $roleRepo->syncRoleByIds($user, $data['roles']);
        }

        event(new UserWasUpdated($user));

        return $user;
    }

    public function delete(User $user): bool
    {
        $user->delete();

        event(new UserWasDeleted($user));

        return true;
    }

    public function generateVerifyToken(User $user)
    {
        $token = hash_hmac('sha256', str_random(40), config('app.key'));

        $user->verification_token = $token;
        $user->save();
        event(new UserWasUpdated($user));

        return $token;
    }

    public function verify($token): User
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = 1;
        $user->verification_token = null;
        $user->save();
        event(new UserWasUpdated($user));

        return $user;
    }

}