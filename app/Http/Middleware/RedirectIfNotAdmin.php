<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
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
    // Vérifie si l'utilisateur est authentifié en tant qu'administrateur
    if (!Auth::guard('admin')->check()) {
        // Redirige l'utilisateur vers la page de connexion
        return view('connection');
    }

    return $next($request);
}
}
