<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesConfigurations
{
    /**
     * returns an array of config files with their corresponding config_path(name)
     *
     * @return array
     */
    public function configurationFiles();
}