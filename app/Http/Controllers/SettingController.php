<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class SettingController extends Controller
{
    public function index()
    {
        App::setLocale(session('locale'));

        return view('settings.index');
    }
}
