<?php

namespace Alpaca\Controllers\old_Auth;

use Validator;
use Laracasts\Flash\Flash;
use Alpaca\User\Models\User;
use Illuminate\Http\Request;
use Alpaca\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'form_name' => 'honeypot',
            'form_time' => 'required|honeytime:5',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $redirect = request('redirect');
        if (! empty($redirect)) {
            $this->redirectTo = $redirect;
        }

        Flash::success(trans('user::user.registered_successful'));

        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(18),
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        return view('alpaca::auth.register');
    }

    public function verify($token)
    {
        User::where('email_token', $token)->firstOrFail()->verified();

        Flash::success(trans('user::user.verification_successful'));

        return redirect('login');
    }
}
