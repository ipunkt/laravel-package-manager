<?php

namespace Ipunkt\Laravel\PackageManager\Support;

interface DefinesCommands
{
    /**
     * returns a list of commands
     *
     * @return array|string[]
     */
    public function commandClasses();
}