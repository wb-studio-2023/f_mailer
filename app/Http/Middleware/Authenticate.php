<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        $getRequest = $request->getRequestUri();

        if (! $request->expectsJson()) {
            if (preg_match('/^\/member\/.*/', $getRequest)) {
                return route('member.showLoginFOrm');
            } else if (preg_match('/^\/admin\/.*/', $getRequest)) {
                return route('admin.showLoginFOrm');
            }
            return route('login');
        }
    }
}
