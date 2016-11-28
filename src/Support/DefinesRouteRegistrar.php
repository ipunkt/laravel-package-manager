<?php

namespace DonePM\PackageManager\Support;

use Illuminate\Routing\Router;

interface DefinesRouteRegistrar
{
    /**
     * defines routes by using the router
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function registerRoutesWithRouter(Router $router);
}