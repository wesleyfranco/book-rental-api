<?php

namespace App\Interfaces;

interface BookRequestInterface
{
    public function validated($key = null, $default = null);
}
