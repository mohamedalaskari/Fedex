<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MiddleWareHas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $ability): Response
    {
        $abilites=explode('|',$ability);
        $user=Auth::user();
        $user_ability=$user->role;
        $match=array_intersect($abilites,$user_ability);
        if(count($match)=== 0){
            abort(401,'you are not authorized to visit the route');

        }
        return $next($request);
    }
}
