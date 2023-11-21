<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function set(Request $request)
    {
        return redirect()->route('settings.index');
    }
}
