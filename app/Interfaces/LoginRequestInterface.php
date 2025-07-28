<?php

namespace App\Interfaces;

interface LoginRequestInterface
{
    public function validated($key = null, $default = null);
}
