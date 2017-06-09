<?php

namespace Faacsilva\BuscaCep\Facades;

use Illuminate\Support\Facades\Facade;

class BuscaCep extends Facade{
    protected static function getFacadeAccessor() { return 'buscacep'; }
}