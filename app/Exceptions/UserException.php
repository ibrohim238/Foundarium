<?php

namespace App\Exceptions;

use Illuminate\Support\Facades\Lang;
use RuntimeException;

class UserException extends RuntimeException
{
    public static function carBusy(): UserException
    {
        return new self(Lang::get('profile.car-busy'));
    }
}
