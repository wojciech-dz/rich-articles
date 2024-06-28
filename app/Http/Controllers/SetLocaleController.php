<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        session(['locale' => $locale]);
        return back();
    }
}
