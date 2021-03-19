<?php

namespace App\Utils\Navigation;

class SessionData{

	public const USER = 'USER';
	public const FLASH= 'FLASH';

	public static function addUserData(array $data)
	{
		foreach($data as $key=>$value)
		{
			$_SESSION[self::USER][$key]	= $value;
		}
	}

	public static function removeUserData(string $key)
	{
		unset($_SESSION[self::USER][$key]);
	}

	public static function logoutUser()
	{
		unset($_SESSION[self::USER]);
	}

	public static function getUserData(string $key)
	{
		if(empty($_SESSION[self::USER][$key]))
			return null;
		return $_SESSION[self::USER][$key];
	}

	public static function addCookies(array $data)
	{

	}

	public static function userLogged():bool
	{
		return !empty($_SESSION[self::USER]['id']);
	}

	public static function getInPost(string $key)
	{
		if(array_key_exists($key, $_POST))
			return $_POST[$key];
		return null;
	}

	public static function addValueInPost($key, $value)
	{
		$_POST[$key]	= $value;
	}

	public static function setFlash(string $message, string $type="info")
	{
		if($message)
		{
			$_SESSION[self::FLASH][]	= ['message'=>$message, 'type'=>$type];
		}
	}

	public static function existFlash():bool
	{
		return !empty($_SESSION[self::FLASH]);
	}

	public static function getFlashes():array
	{
		$flashes = $_SESSION[self::FLASH];
		unset($_SESSION[self::FLASH]);
		return $flashes;
	}

}