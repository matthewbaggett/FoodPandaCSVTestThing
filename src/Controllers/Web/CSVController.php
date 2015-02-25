<?php
/**
 * Created by PhpStorm.
 * User: Matthew Baggett
 * Date: 25/02/2015
 * Time: 19:34
 */

namespace FoodPanda\Controllers\Web;


use FoodPanda\CSV\CSV;

class CSVController {
  static public function MakeCSV(){
    $csv_generator = new CSV();
    $writer = $csv_generator->generate_csv();
    $writer->output("countries.csv");
    exit;
  }
}