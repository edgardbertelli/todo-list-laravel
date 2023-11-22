<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('localized');
    }

    public function set(string $locale)
    {
        if (! in_array($locale, ['en', 'pt'])) {
            abort(400);
        }

        session(['locale' => $locale]);

        App::setLocale(session('locale'));

        return redirect()->route('settings.index', [
            'locale' => session('locale')
        ]);
    }
}
