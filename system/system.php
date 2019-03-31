<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

//session_start();

// Instantiate the app
$settings = require __DIR__ . '/settings.php';
$app = new \Slim\App($settings);

//get slim container
$container = $app->getContainer();

///////////////////////////////////////////////////////////////////////////
//add custom rederer
///////////////////////////////////////////////////////////////////////////
$container['view'] = function ($container){

	//get templates path
	$path = $container->get('settings')['renderer']['template_path'];

	//init attributes array
	$attr = array();

	//get manifest json from webpack, convert it to an object and add it to the View manager
    $manifest_raw = file_get_contents(dirname(__FILE__)."/../public/dist/manifest.json");
    $manifest = json_decode($manifest_raw);
	
	//initialize redeerer
    //$view = new \ED\View($path, $attr);
    $view = new \ED\Entropy\View($path);

    //add manifest object to the view
    $view->addData("manifest", $manifest);

    //add container to the view
    $view->addData("container", $container);


	return $view;
};

// Set up dependencies
require __DIR__ . '/dependencies.php';

// Register middleware
require __DIR__ . '/middleware.php';

// Register routes
require __DIR__ . '/routes.php';

// Run app
$app->run();