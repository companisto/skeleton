<?php

namespace ED\Controllers;

use Interop\Container\ContainerInterface;
//use Typemill\Events\OnPageReady;

abstract class Controller{

	protected $c;

	public function __construct(ContainerInterface $c){
		$this->c = $c;
	}//end function __construct

	public function parent_function(){
		return "Parent function";
	}

}//end class Controller