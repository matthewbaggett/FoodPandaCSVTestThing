<?php
/**
 * Created by PhpStorm.
 * User: Matthew Baggett
 * Date: 25/02/2015
 * Time: 19:41
 */
namespace FoodPanda\Tests\CSV;
use FoodPanda\CSV\CSV;

class CSVTest extends \PHPUnit_Framework_TestCase {

  /* @var $_csv \FoodPanda\CSV\CSV */
  private $_csv;

  public function setUp(){
    $this->_csv = new CSV();
  }

  public function testCSVRawDownload(){
    /* @var $curl \FoodPanda\Curl */
    list($data, $curl) = $this->_csv->get_raw_data();
    $this->assertEquals(200, $curl->get_status());
    $this->assertEquals(4505, strlen($data)); // I know that file is this long..
    return $data;
  }

  public function testCSVDecode(){
    $decoded = $this->_csv->parse_csv_data();
    $this->assertArrayHasKey("UK", $decoded);
    $this->assertEquals($decoded['UK'], "United Kingdom");
    $this->assertArrayNotHasKey("", $decoded);
  }

  public function testCSVGenerate(){
    $writer = $this->_csv->generate_csv();

    $this->assertEquals("League\\Csv\\Writer", get_class($writer));

    $csv = $writer->__toString();

    file_put_contents(APP_ROOT . "/generated/countries.csv", $csv);
    $file = fopen(APP_ROOT . "/generated/countries.csv", "r");
    $data = [];
    while($row = fgetcsv($file)){
      $data[$row[0]] = $row;
    }
    fclose($file);
    unlink(APP_ROOT . "/generated/countries.csv");

    $this->assertEquals(253, count($data)); // 252 countries + headers.
    $this->assertEquals(["United Kingdom", "UK"], $data['United Kingdom']);
  }


}
