<?php

namespace App\Http\Middleware;

use App\Exceptions\UnavailableLocaleException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class Localized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->missing('locale')) {
            App::setLocale(config('app.locale'));
        } else {
            $locale = $request->session()->get('locale');

            if (! key_exists($locale, config('app.available_locales'))) {
                throw new UnavailableLocaleException('Unavailable locale.', 400);
            }
    
            App::setLocale($locale);
        }
        
        return $next($request);
    }
}
