<?php

namespace App\Models;

abstract class UserTypes
{
    const ADMIN = 'admin';
    const USER = 'user';
    const USER_TYPES = [
        self::ADMIN,
        self::USER,
    ];
}
