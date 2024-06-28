<?php

namespace App\Models;

abstract class AvailableLocales
{
    const PL = ['code'=>'pl', 'desc'=>'Polski'];
    const EN = ['code'=>'en', 'desc'=>'English'];
    const AVAILABLE_LOCALES = [
        self::PL,
        self::EN,
    ];
}
