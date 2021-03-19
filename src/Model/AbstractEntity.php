<?php

namespace App\Model;


abstract class AbstractEntity{

	abstract public function normalize():array;

    public function hydrate(array $props)
    {
    	foreach ($props as $key => $value) {
    		$method = 'set'.ucfirst($key);
    		if(method_exists($this, $method))
    			$this->$method($value);
    	}

        return $this;    	
    }
}