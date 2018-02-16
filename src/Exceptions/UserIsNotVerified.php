<?php

namespace Alpaca\Exceptions;

use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserIsNotVerified extends \Exception
{
    public function render(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();

        Flash::success(trans('alpaca::user.not_verified'));

        return redirect('/');
    }
}
