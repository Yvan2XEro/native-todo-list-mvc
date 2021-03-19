<?php

namespace App\Model;

class User{

    private $id;
    private $name;
    private $email;
    private $password;

    public function setId(int $id):self
    {
    	$this->id = $id;
    	return $this;
    }
    public function setName(string $name):self
    {
    	$this->name = $name;
    	return $this;
    }
    public function setEmail(string $email):self
    {
    	$this->email = $email;
    	return $this;
    }

	public function getId(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getEmail(){
		return $this->email;
	}
}