<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MemberMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            if(auth()->user()->role->name == 'member' && auth()->user()->status == 'active') {
                return $next($request);
            } else if (auth()->user()->role->name == 'admin' && auth()->user()->status == 'active') {
                return $next($request);
            } else if (auth()->user()->status == 'banned') {
                return redirect()->route('home.index')->with(['forbidden' => 'Your account was banned. Please contact us if you feel this is mistake']);     
            }       
        }
        return redirect()->route('login.index')->with(['forbidden' => 'Forbidden. Please login first!']);
    }
}
