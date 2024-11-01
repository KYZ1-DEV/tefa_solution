<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
         $user = Auth::user(); 

         if ($user && $user->role === $role) {
             return $next($request);
         } else {
             if ($user && $user->role === 'industri') {
                 return redirect('/industries')->withErrors('Anda tidak dapat mengakses halaman tersebut!');
             } else if ($user && $user->role === 'sekolah') {
                 return redirect('/schools')->withErrors('Anda tidak dapat mengakses halaman tersebut!');
             } else {
                 $url = "/" . $user->role;
                 return redirect($url)->withErrors('Anda tidak dapat mengakses halaman tersebut!');
             }
         }
    }
}
