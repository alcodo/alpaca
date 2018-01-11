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
        ])->validate();

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        event(new UserWasCreated($user));

        return $user;
    }

    public function update(User $user, array $data): User
    {
        Validator::make($data, [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
//            'password' => 'required|string|min:6|confirmed',
        ])->validate();

        if(isset($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        event(new UserWasUpdated($user));

        return $user;
    }

    public function delete(User $user): bool
    {
        $user->delete();

        event(new UserWasDeleted($user));

        return true;
    }

}