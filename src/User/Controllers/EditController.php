<?php

namespace Alpaca\User\Controllers;

use App\Http\Controllers\Controller;
use App\Model\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class EditController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getEdit()
    {
        $user = Auth::getUser();

        return view('auth.edit', compact('user'));
    }

    public function postUpdate($id, Request $request)
    {
        $user = Auth::getUser();

        if ($user->email == $request->get('email')) {
            // user try to change own password
            $validatorRules = [
                'password' => 'confirmed|min:6',
            ];
        } else {
            // user try another email
            $validatorRules = [
                'email'    => 'required|email|max:255|unique:users',
                'password' => 'confirmed|min:6',
            ];
        }

        $this->validate($request, $validatorRules);

        $data = $request->all();

        // password crypt
        if (isset($data['password'])) {
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = bcrypt($data['password']);
            }
        }

        $user = User::findOrFail($id);
        $user->update($data);

        Flash::success('Benutzerdaten sind aktualisiert.');

        return redirect()->action('Auth\EditController@getEdit');
    }
}
