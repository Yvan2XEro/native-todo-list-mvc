<?php

namespace App\Utils\CustomTools;

class ArrayTools{
	public static function purge(array $array):array
	{
		$t=[];
		foreach ($array as $key => $value) {
			if(is_bool($value) || null != $value)
				$t[$key]=$value;
		}
		return $t;
	}
}