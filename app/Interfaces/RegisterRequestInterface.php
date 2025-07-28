<?php

namespace App\Interfaces;

interface RegisterRequestInterface
{
    public function validated($key = null, $default = null);
}
