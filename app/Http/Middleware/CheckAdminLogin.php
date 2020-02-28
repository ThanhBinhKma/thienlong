<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $check_login_admin = Auth::guard('admin')->check();
        if(!$check_login_admin){
            return redirect()->route('admin.login');

        }else{
            return $next($request);
        }
    }
}
