<?php

namespace stojankukrika\PaxumPayment\Facades;

use Illuminate\Support\Facades\Facade;

class SegpayPayment extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'segpay'; }

}
