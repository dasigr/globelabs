<?php
/**
 * Created by PhpStorm.
 * User: das
 * Date: 8/18/21
 * Time: 3:58 AM
 */

namespace Drupal\globelabs\Service;


class AuthService {
  
  public function get_connect_link() {
    $app_id = "kodMIEqyoGhRdcEnyeTyMXhR9oBjIxGy";
    $link = "https://developer.globelabs.com.ph/dialog/oauth/" . $app_id;
    
    return $link;
  }

  /**
   * Save the authorization code.
   * 
   * @param $code
   */
  public function save_code($code) {
    // Save code.
  }

  /**
   * Get the authorization code.
   * 
   * @return string
   */
  public function get_code() {
    $code = '9sgo7kaSGqkbyFrKk65H5kqAxuqejerugdB8LfzgkqLhbdbyAUgr9yrtk9kGgUgny8bI5Boj8Han67xInAgBAsLdaLgH9ayo4unx597Ik5rj8hBeB9Lt5zX4XH9dTMp5B6EcXAeH4EBzyt97r9RhgA5dbInGybgudjaRdHa9g9MsMy6MKIykob9H8qyn4IyrkybUzX9Gnt8dbLMUk8k45hGLBk5fRej7ku6qq8nubMkqxHMpkoEF4B7MeSyqLq6s';
    
    return $code;
  }

  /**
   * Get access token.
   *
   * @param $code
   *
   * @return mixed
   */
  public function get_access_token($code) {
    $app_id = "";
    $app_secret = "";

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://developer.globelabs.com.ph/oauth/access_token?app_id=".$app_id."&app_secret=".$app_secret."&code=".$code,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "",
      CURLOPT_HTTPHEADER => array( "cache-control: no-cache" ),
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
