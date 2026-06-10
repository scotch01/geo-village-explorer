<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceChangePassword
{
    public function handle(
        Request $request,
        Closure $next
    )
    {
        if (
            ! auth()->check()
        ) {
            return $next(
                $request
            );
        }

        if (
            $request->routeIs([
                'password.force.change',
                'password.force.update',
                'logout',
            ])
        ) {
            return $next(
                $request
            );
        }

        if (
            auth()->user()->must_change_password
        ) {

            return redirect()->route(
                'password.force.change'
            );

        }

        return $next(
            $request
        );
    }
}