<?php

namespace Alpaca\Exceptions;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

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