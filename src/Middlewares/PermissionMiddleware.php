<?php

namespace Alpaca\Middlewares;

use Closure;
use Illuminate\Support\Facades\Auth;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
        // TODO check permission

        return $next($request);

//        if (app('auth')->guest()) {
//            throw UnauthorizedException::notLoggedIn();
//        }
//
//        $permissions = is_array($permission)
//            ? $permission
//            : explode('|', $permission);
//
//        foreach ($permissions as $permission) {
//            if (app('auth')->user()->can($permission)) {
//                return $next($request);
//            }
//        }
//
//        throw UnauthorizedException::forPermissions($permissions);
    }
}
