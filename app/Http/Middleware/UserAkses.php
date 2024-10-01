<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        if (auth()->user()->role === $role) {
            return $next($request);
        }else {
            // dd(auth()->user()->role);
            if(auth()->user()->role === 'industri'){
                return redirect('/industries')->withErrors('Anda tidak dapat mengakses halaman ini');
            }else if(auth()->user()->role === 'sekolah'){
                return redirect('/schools')->withErrors('Anda tidak dapat mengakses halaman ini');
            }else{
                $url = "/".auth()->user()->role;
                return redirect($url)->withErrors('Anda tidak dapat mengakses halaman ini');
            }
        }
    }
}
