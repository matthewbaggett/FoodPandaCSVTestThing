<?php
require_once("bootstrap.php");

// Initialise app.
$app = new \Slim\Slim(array(
  'templates.path' => APP_ROOT . "/themes/Base/templates",
));

$view_controller = new \FoodPanda\ViewController($app);
$app->view($view_controller);

$app->view()->setSiteTitle("FoodPanda CSV Thing");

require_once("themes/Ubuntu/template.php");
require_once("config/routes.php");

$app->run();
