<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, \Closure $next)
    {
        // Bloqueia qualquer um que não seja o ID 1 (Você)
        if (auth()->check() && auth()->id() === 1) {
            return $next($request);
        }

        return redirect('/dashboard')->with('erro', 'Acesso restrito apenas para o administrador geral do Vicariato.');
    }

}
