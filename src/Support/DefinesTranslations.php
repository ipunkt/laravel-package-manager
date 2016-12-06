<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesTranslations
{
    /**
     * returns translation files
     *
     * @return array|string[]
     */
    public function translations();
}