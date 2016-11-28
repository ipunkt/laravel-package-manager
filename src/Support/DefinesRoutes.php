<?php

namespace DonePM\PackageManager\Support;

interface DefinesRoutes
{
    /**
     * returns routes.php file (absolute path)
     *
     * @return string
     */
    public function routesFile();
}