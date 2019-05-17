<?php
// DIC configuration

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

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Service factory for the ORM
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};
