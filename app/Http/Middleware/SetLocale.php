<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $supported = array_keys(config('i18n.supported'));
        $default   = config('i18n.default');
        $locale    = $request->route('locale');

        if (! $locale || ! in_array($locale, $supported)) {
            $locale = $default;
        }

        app()->setLocale($locale);
        session(['app_locale' => $locale]);

        return $next($request);
    }
}
