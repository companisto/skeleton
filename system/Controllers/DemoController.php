<?php

namespace ED\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;


class DemoController extends Controller{

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function showDemo(Request $request, Response $response, $args){
		// Sample log message
		$this->c->logger->info("Slim-Skeleton '/' route");
	
		//does not work in PHP 5.6
		//$result = $this->db::select('select * from `user` where id = 1');

		// $db = $this->db;
		// $result = $db::select('select * from `user` where id = 1');

		// echo "<pre>";
		// 	var_dump($result);
		// echo "</pre>";

		//Render index view
		//return $this->renderer->render($response, 'index.phtml', $args);

		$args['name'] = isset($args['name']) ? $args['name'] : "";


		$this->c->view->setLayout("layout/layout.php");
		return $this->c->view->render($response, 'demo1.php', array(
			"user_name" => "Dear ".$args['name'],
			"parent_function" => $this->parent_function()
		));
	}//end function demo1


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function showDemoDatatables(Request $request, Response $response, $args){
		$this->c->view->setLayout("layout/layout.php");
		return $this->c->view->render($response, 'demo_datatables.php', array(
		));
	}//end function demo_datatables


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	function showDemoForm(){

		
		$form_config = <<<FORM_JSON
{
	"items": [{
		"type": "fieldset",
		"label": "Some test label",
		"id": "some_test_id",
		"items": [{
			"type": "group", 
			"items": [{
				"type": "radio",
				"label": "Normal"
			},{
				"type": "radio",
				"label": "Equity"
			}]
		}]
	}]
}
FORM_JSON;

		$form_config = json_decode($form_config);
		//var_dump($form_config);
		echo (json_encode($form_config, JSON_PRETTY_PRINT));

		$form_config = [
			"items" => [
				"type" => "fieldset"
			]
		];

		

	}//end function showDemoForm



}//end class DemoController

?>