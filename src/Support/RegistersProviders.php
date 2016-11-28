<?php

namespace DonePM\PackageManager\Support;

interface RegistersProviders
{
    /**
     * returns provider classes it provides
     *
     * @return array|string[]
     */
    public function providers();
}