<?php
/**
 * Nom : Bertrand Nicolas
 * Nom du fichier : AdminMiddleware.php
 * Description : Middleware pour la vérification si l'utilisateur est Administrateur 
 */
namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        if ($request->user()->is_admin != '1')
        {
            return redirect('home');
        }

        return $next($request);
    }
}
