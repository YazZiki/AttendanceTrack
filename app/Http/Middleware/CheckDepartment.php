<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDepartment
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next , $department): Response
    {
        // 1. Check if the user is logged in at all
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'login first');
        }

        // 2. Check if the user's department matches this module (as shown on Slide 14 & 20)
        if (session('department_id') != $department) {
            abort(403, 'Unauthorized action. You do not have access to this module.');
        }

        // 3. Allow the request to pass to the Controller
        return $next($request);
    }
}
