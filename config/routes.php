<?php

$app->get('/', function() use ($app){
  FoodPanda\Controllers\Web\IndexController::Index($app);
});

$app->get('/csv', function() use ($app){
  FoodPanda\Controllers\Web\CSVController::MakeCSV($app);
});