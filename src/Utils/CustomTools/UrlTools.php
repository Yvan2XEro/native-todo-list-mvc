<?php

namespace App\Utils\CustomTools;

class UrlTools{

	public static function redirect(string $location)
	{
		header("Location:$location");
		die();
	}
}