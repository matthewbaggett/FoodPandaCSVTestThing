<?php
namespace FoodPanda\CSV;

use FoodPanda\Curl;
use League\Csv\Writer;

class CSV{
  public function get_raw_data(){
    $url = "http://pastebin.com/raw.php?i=943PQQ0n";
    $curl = new Curl();
    $result = $curl->get($url);
    return [$result, $curl];
  }

  public function parse_csv_data(){
    list($data, $curl) = $this->get_raw_data();
    $rows = explode("\n", $data);

    // Snip off the "obtained from" lines.
    $rows = array_slice($rows,3);

    // Filter out blanks
    $rows = array_filter($rows);

    $countries = [];
    foreach($rows as $i => $row){
      $elements = explode("   ", $row, 2);
      if(count($elements) == 2){
        list($code, $country) = $elements;
        $countries[trim($code)] = trim($country);
      }
    }
    return $countries;
  }

  /**
   * @return \League\Csv\Writer
   */
  public function generate_csv(){
    $countries = [];
    foreach($this->parse_csv_data() as $code => $country){
      $countries[$country] = [$country, $code];
    }

    ksort($countries);

    // Use League/CSV because CSV is a boring subject to write yet another handler for.

    $writer = Writer::createFromFileObject(new \SplTempFileObject()); //the CSV file will be created into a temporary File
    $writer->setDelimiter(","); //the delimiter will be the tab character
    $writer->setNewline("\r\n"); //use windows line endings for compatibility with some csv libraries
    $writer->setEncodingFrom("utf-8");
    $headers = ["CountryName" , "CountryCode"];
    $writer->insertOne($headers);
    $writer->insertAll($countries);

    return $writer;
  }
}

