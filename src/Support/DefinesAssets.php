<?php

namespace DonePM\PackageManager\Support;

interface DefinesAssets
{
    /**
     * returns asset paths
     *
     * @return array|string[]
     */
    public function assets();
}