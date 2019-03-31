<?php

use \ED\Controllers\DemoController;
use \ED\Controllers\AuthController;
use \Slim\Http\Request;
use \Slim\Http\Response;

// Routes

$app->get('/demo[/{name}]', DemoController::class . ':showDemo')->setName('demo');
$app->get('/demo_datatables', DemoController::class . ':showDemoDatatables')->setName('demo_datatables');
$app->get('/demo_form', DemoController::class . ':showDemoForm')->setName('demo_form');
$app->get('/login', AuthController::class . ':login')->setName('login');

// $app->get('/[{name}]', function (Request $request, Response $response, array $args) {
// 	// Sample log message
// 	$this->logger->info("Slim-Skeleton '/' route");
	
// 	//does not work in PHP 5.6
// 	//$result = $this->db::select('select * from `user` where id = 1');

// 	// $db = $this->db;
// 	// $result = $db::select('select * from `user` where id = 1');

// 	// echo "<pre>";
// 	// 	var_dump($result);
// 	// echo "</pre>";

// 	//Render index view
// 	//return $this->renderer->render($response, 'index.phtml', $args);


// 	$this->view->setLayout("layout/layout.php");
// 	return $this->view->render($response, 'index.php', array(
// 		"user_name" => "Dear User"
// 	));
// });
