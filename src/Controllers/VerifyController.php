<?php

namespace Alpaca\Controllers;

use Laracasts\Flash\Flash;
use Alpaca\Repositories\UserRepository;

class VerifyController extends Controller
{
    public function verify($token, UserRepository $repo)
    {
        $user = $repo->verify($token);

        Flash::success(trans('alpaca::user.verification_successful'));

        return redirect('/');
    }
}
