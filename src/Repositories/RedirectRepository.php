<?php

namespace Alpaca\Repositories;

use Alpaca\Models\Redirect;
use Illuminate\Support\Facades\Validator;
use Alpaca\Events\Redirect\RedirectWasCreated;
use Alpaca\Events\Redirect\RedirectWasDeleted;
use Alpaca\Events\Redirect\RedirectWasUpdated;

class RedirectRepository
{
    public function create(array $data): Redirect
    {
        Validator::make($data, [
            'from' => 'required|string|max:255|unique:redirects,from',
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
            'from' => 'required|string|max:255|unique:redirects,from,'.$redirect->id.',id',
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
        $redirect->update([
            'hits' => $redirect->hits + 1,
        ]);
    }
}
