<?php

namespace ED\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
// use Typemill\Models\Validation;
// use Typemill\Models\User;
// use Typemill\Models\WriteYaml;

class AuthController extends Controller{


	function login(Request $request, Response $response, $args){

		$this->c->view->setLayout("layout/layout.php");
		return $this->c->view->render($response, 'login.php', array());

	}//end funciton login


	function demo1(Request $request, Response $response, $args){
		// Sample log message
		//$this->c->logger->info("Slim-Skeleton '/' route");
	
		//does not work in PHP 5.6
		//$result = $this->db::select('select * from `user` where id = 1');

		// $db = $this->db;
		// $result = $db::select('select * from `user` where id = 1');

		// echo "<pre>";
		// 	var_dump($result);
		// echo "</pre>";

		//Render index view
		//return $this->renderer->render($response, 'index.phtml', $args);


		$this->c->view->setLayout("layout/layout.php");
		return $this->c->view->render($response, 'demo1.php', array(
			"user_name" => "Dear ".$args['name'],
			"parent_function" => $this->parent_function()
		));
	}//end function demo1

}//end class DemoController

?>