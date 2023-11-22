<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SettingController extends Controller
{
    public function index(string $locale)
    {
        if (! in_array($locale, ['en', 'pt'])) {
            abort(400);
        }

        App::setLocale(session('locale'));

        return view('settings.index');
    }
}
