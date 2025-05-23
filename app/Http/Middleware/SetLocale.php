<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

use \Illuminate\Support\Facades\Auth;
// use \Illuminate\Container\Attributes\Auth;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $locale = $request->cookie('app_locale', config('app.locale'));
        // App::setLocale($locale);
        $locale = Auth::check() ? Auth::user()->locale : config('app.locale');
        App::setLocale($locale);
        return $next($request);
    }
}
