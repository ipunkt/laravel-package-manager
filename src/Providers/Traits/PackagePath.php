<?php

namespace Ipunkt\Laravel\PackageManager\Providers\Traits;

trait PackagePath
{
    /**
     * you have to set the package path to the absolute root path of your package like __DIR__ . '/../../' within
     * your Service Provider;
     *
     * @var string
     */
    protected $packagePath = '';

    /**
     * give relative path from package root and return absolute path
     *
     * @param string $relativePath
     *
     * @return string
     */
    private function packagePath(string $relativePath): string
    {
    	$packagePath = rtrim(str_replace('/', DIRECTORY_SEPARATOR, $this->packagePath), DIRECTORY_SEPARATOR);
        $relativePath = ltrim(str_replace('/', DIRECTORY_SEPARATOR, $relativePath), DIRECTORY_SEPARATOR);

        return realpath($packagePath . DIRECTORY_SEPARATOR . $relativePath);
    }
}
