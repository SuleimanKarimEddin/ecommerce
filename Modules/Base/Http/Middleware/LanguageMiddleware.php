<?php

namespace Modules\Base\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $defaultedLanguage = config('base.languages');
        $lang_from_header = $request->header('language');

        if (in_array($lang_from_header, $defaultedLanguage)) {
            App::setLocale($request->header('language'));
            $request['language'] = $lang_from_header;
        } else {
            App::setLocale(config('app.fallback_locale'));
            $request['language'] = $defaultedLanguage[0];
        }

        return $next($request);
    }
}
