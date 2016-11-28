<?php

namespace DonePM\PackageManager\Support;

interface DefinesCommands
{
    /**
     * returns a list of commands
     *
     * @return array|string[]
     */
    public function commandClasses();
}