<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesMigrations
{
    /**
     * returns an array of migration paths
     *
     * @return array|string[]
     */
    public function migrations();
}