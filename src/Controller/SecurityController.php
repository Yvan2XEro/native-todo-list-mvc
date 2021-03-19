<?php

namespace App\Controller;

use App\Utils\Dev\VarDumper;
use App\Utils\CustomTools\UrlTools;
use App\Utils\Navigation\SessionData;

class SecurityController extends Controller{

	public function login()
	{
		$cred['email']	= SessionData::getInPost('username');
		$cred['password']	= SessionData::getInPost('password');
		if($cred['email'] && $cred['password'])
		{
			$user = $this->entityManager->findBy('user', $cred);
			if(!empty($user[0]))
			{
				SessionData::addUserData(['id'=>$user[0]->getId()]);
				SessionData::addUserData(['username'=>$user[0]->getName()]);
				SessionData::setFlash('Login success!');
				UrlTools::redirect("/todos");
			}else{
				SessionData::setFlash('Login failed please check your credentials', 'danger');
			}
		}

		return $this->render("login");
	}

	public function logout()
	{
		SessionData::logoutUser();
		SessionData::setFlash('You are logout now');
		UrlTools::redirect('/login');
	}
}