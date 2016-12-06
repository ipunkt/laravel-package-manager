<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesAliases
{
    /**
     * returns list of alias with alias as key and facade as value
     *
     * @return array
     */
    public function aliases();
}