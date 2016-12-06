<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesRoutes
{
    /**
     * returns routes.php file (absolute path)
     *
     * @return array|string[]
     */
    public function routesFiles();
}