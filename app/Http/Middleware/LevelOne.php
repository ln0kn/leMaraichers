<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class LevelOne
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        
//        $st =strpos(Auth::user()->pageUtilisateur,$role);
        $st =explode(",",Auth::user()->pageUtilisateur,'-1');
//        dd($st);
        foreach($st as $val){
            if($val === $role)
                return $next($request);
        }
        abort(401, "A Custom Exception Message");
        
    }
}
