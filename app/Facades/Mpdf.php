<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Mpdf extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mpdf\Mpdf::class;
    }
}
