<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switchLocale(Request $request, $locale)
    {
        // if (in_array($locale, ['en', 'ru', 'tr'])) {
        //     return redirect()->back()->withCookie(cookie('app_locale', $locale, 60 * 24 * 30)); // 30days
        // }

        if (in_array($locale, ['en', 'ru', 'tr']) && $request->user()) {
            $request->user()->update([
                'locale' => $locale,
            ]);
            return redirect()->back();
        }
        return redirect()->back();
    }
}
