<?php

namespace App\View\Components;

use App\Models\AvailableLocales;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $languages = AvailableLocales::AVAILABLE_LOCALES;

        return view('layouts.app', compact('languages'));
    }
}
