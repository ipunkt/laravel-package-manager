<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesViews
{
    /**
     * returns view file paths
     *
     * @return array|string[]
     */
    public function views();
}