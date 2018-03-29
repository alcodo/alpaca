<?php

namespace Alpaca\Repositories;

use Alpaca\Events\Redirect\RedirectWasCreated;
use Alpaca\Events\Redirect\RedirectWasDeleted;
use Alpaca\Events\Redirect\RedirectWasUpdated;
use Alpaca\Models\Page;
use Alpaca\Models\Redirect;
use Illuminate\Support\Facades\Validator;

class RedirectRepository
{

    public function create(array $data): Redirect
    {
        Validator::make($data, [
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'code' => 'nullable|integer',
        ])->validate();

        $redirect = Redirect::create($data);

        event(new RedirectWasCreated($redirect));

        return $redirect;
    }

    public function update(Redirect $redirect, array $data): Redirect
    {
        Validator::make($data, [
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'code' => 'nullable|integer',
        ])->validate();

        $redirect->update($data);

        event(new RedirectWasUpdated($redirect));

        return $redirect;
    }

    public function delete(Redirect $redirect): bool
    {
        $redirect->delete();

        event(new RedirectWasDeleted($redirect));

        return true;
    }

    public function addHit(Redirect $redirect): void
    {
        $redirect->hits++;
        $redirect->save();
    }

}