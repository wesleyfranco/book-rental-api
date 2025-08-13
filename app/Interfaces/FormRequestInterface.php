<?php

namespace App\Interfaces;

interface FormRequestInterface
{
    public function validated($key = null, $default = null);
}
