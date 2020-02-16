<?php

session_start();

/* AUTOLOADING all classes from \Classes.
“PHP: Autoloading Classes - Manual.” 
[Online]. Available: https://www.php.net/manual/en/language.oop5.autoload.php. 
[Accessed: 08-Jan-2020].
*/

class Autoloader
{
	public static function register()
	{
		spl_autoload_register(function ($class) {// registers autoloaders

			$file = __DIR__.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
			if (file_exists($file)) {
				require $file;
				return true;
			}
			return false;
		});
	}
}
Autoloader::register();