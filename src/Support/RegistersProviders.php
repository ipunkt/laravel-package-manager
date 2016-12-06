<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface RegistersProviders
{
    /**
     * returns provider classes it provides
     *
     * @return array|string[]
     */
    public function providers();
}