<?php

namespace Alpaca\Exceptions;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

class UserStartVerificationProcess extends \Exception
{

    public function render(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();

        Flash::success(
            trans('alpaca::user.registered_successful')
        );

        return redirect('/');
    }

}