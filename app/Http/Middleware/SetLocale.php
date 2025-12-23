<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['en', 'ar'];

        if ($request->has('lang') && in_array($request->string('lang')->toString(), $supported, true)) {
            $lang = $request->string('lang')->toString();
            session(['lang' => $lang]);
        }

        $lang = session('lang', 'en');
        if (!in_array($lang, $supported, true)) {
            $lang = 'en';
        }

        app()->setLocale($lang);

        return $next($request);
    }
}
