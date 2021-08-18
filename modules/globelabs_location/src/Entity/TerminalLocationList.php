<?php
/**
 * Created by PhpStorm.
 * User=>das
 * Date=>8/18/21
 * Time=>9:28 AM
 */

namespace Drupal\globelabs_sms\Entity;


class TerminalLocationList {

  protected $terminalLocation = array(
    "address" => "",
    "currentLocation" => array(
      "accuracy" => 100,
      "latitude" => "",
      "longitude" => "",
      "map_url" => "",
      "timestamp" => ""
    ),
    "locationRetrievalStatus" => ""
  );
  
}
