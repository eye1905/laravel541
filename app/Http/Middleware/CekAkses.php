<?php

namespace App\Http\Middleware;

use Closure;

class CekAkses
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
        $user = \App\User::where('jabatan', $request->email)->first();
        $akses = $user;
        
        return $next($request);
    }
}
