<?php

namespace Alpaca\User\Controllers;

use Alpaca\User\Models\User;
use Alpaca\Core\Controllers\Controller;
use Illuminate\Cache\RateLimiter;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    // trait ThrottlesLogins

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return app(RateLimiter::class)->tooManyAttempts(
            $this->getThrottleKey($request),
            $this->maxLoginAttempts(), $this->lockoutTime() / 60
        );
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return int
     */
    protected function incrementLoginAttempts(Request $request)
    {
        app(RateLimiter::class)->hit(
            $this->getThrottleKey($request)
        );
    }

    /**
     * Determine how many retries are left for the user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return int
     */
    protected function retriesLeft(Request $request)
    {
        $attempts = app(RateLimiter::class)->attempts(
            $this->getThrottleKey($request)
        );

        return $this->maxLoginAttempts() - $attempts + 1;
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = app(RateLimiter::class)->availableIn(
            $this->getThrottleKey($request)
        );

        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getLockoutErrorMessage($seconds),
            ]);
    }

    /**
     * Get the login lockout error message.
     *
     * @param int $seconds
     *
     * @return string
     */
    protected function getLockoutErrorMessage($seconds)
    {
        return trans('user::user.throttle', ['seconds' => $seconds]);
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    protected function clearLoginAttempts(Request $request)
    {
        app(RateLimiter::class)->clear(
            $this->getThrottleKey($request)
        );
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function getThrottleKey(Request $request)
    {
        return mb_strtolower($request->input($this->loginUsername())).'|'.$request->ip();
    }

    /**
     * Get the maximum number of login attempts for delaying further attempts.
     *
     * @return int
     */
    protected function maxLoginAttempts()
    {
        return 5;
    }

    /**
     * The number of seconds to delay further login attempts.
     *
     * @return int
     */
    protected function lockoutTime()
    {
        return 60;
    }

    // trait AuthenticatesUsers

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('user::login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        Flash::error($this->getFailedLoginMessage());

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param bool                     $throttles
     *
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        Flash::success(trans('user::user.login_successful'));

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return trans('user::user.failed');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();
        Flash::success(trans('user::user.logout_successful'));

        return redirect('/');
    }

    /**
     * Get the path to the login route.
     *
     * @return string
     */
    public function loginPath()
    {
        return action('\Alpaca\User\Controllers\AuthController@getLogin', [], false);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return true;
    }

    // trait RegistersUsers

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('user::register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $user = $this->create($request->all());
        Auth::login($user);

        Flash::success(trans('user::user.registered_login_successful'));

        return redirect($this->redirectPath());
    }

    // trait RedirectsUsers

    /**
     * Get redirect path after register / login.
     *
     * @return string
     */
    public function redirectPath()
    {
        return '/';
    }

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest', ['except' => 'getLogout']);
//    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);
    }
}
