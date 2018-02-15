<?php

namespace Alpaca\Controllers;

use Alpaca\Repositories\UserRepository;
use Laracasts\Flash\Flash;

class VerifyController extends Controller
{

    public function verify($token, UserRepository $repo)
    {
        $user = $repo->verify($token);

        Flash::success(trans('alpaca::user.verification_successful'));

        return redirect('/');
    }
}
