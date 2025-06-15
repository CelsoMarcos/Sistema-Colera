<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
{
    // Se a requisição esperar JSON, não redireciona — só devolve 401
    if ($request->expectsJson()) {
        return null;
    }

    // Para evitar erro, retorna uma mensagem JSON padrão para rotas não-API
    abort(response()->json([
        'mensagem' => 'Autenticação necessária. Página de login ainda em construção.'
    ], 401));
}

}
