<?php
namespace FoodPanda\Controllers\Web;

class IndexController{
  static public function Index ($app) {
    $app->render('home/home.phtml', array(
    ));
  }
}

