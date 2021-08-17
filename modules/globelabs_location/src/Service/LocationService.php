<?php
/**
 * Created by PhpStorm.
 * User: das
 * Date: 8/18/21
 * Time: 3:58 AM
 */

namespace Drupal\globelabs_location\Service;


class LocationService {

  /**
   * Get location.
   *
   * @param $access_token
   * @param $address
   * @param int $requestedAccuracy
   *
   * @return mixed
   */
  public function get_location($access_token, $address, $requestedAccuracy=100) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://devapi.globelabs.com.ph/location/v1/queries/location?access_token=".$access_token."&address=".$address."&requestedAccuracy=".$requestedAccuracy ,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Host: devapi.globelabs.com.ph"
      ),
    ));

    $json_response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      echo "cURL Error #:" . $err;
      return null;
    } else {
      $response = \GuzzleHttp\json_decode($json_response);
      return $response;
    }
  }

}
