<?php

namespace Ipunkt\Laravel\PackageManager\Providers\Traits;

trait PackagePath
{
	/**
	 * give relative path from package root and return absolute path
	 *
	 * @param string $relativePath
	 * @param string $dir
	 * @return string
	 */
	private function packagePath(string $relativePath, string $dir) : string
	{
		$relativePath = ltrim(str_replace('/', DIRECTORY_SEPARATOR, $relativePath), DIRECTORY_SEPARATOR);

		return realpath($dir . DIRECTORY_SEPARATOR .
			implode(DIRECTORY_SEPARATOR, [
				'..',
				'..',
				$relativePath,
			]));
	}
}