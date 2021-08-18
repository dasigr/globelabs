<?php
/**
 * Created by PhpStorm.
 * User: das
 * Date: 8/18/21
 * Time: 3:58 AM
 */

namespace Drupal\globelabs\Service;


class AuthService {

  /**
   * Redirect to Globe Labs API Authorization Dialog.
   * 
   * @return string
   */
  public function get_connect_link() {
    $app_id = \Drupal::config('globelabs.settings')->get('app_id');
    $link = "https://developer.globelabs.com.ph/dialog/oauth/" . $app_id;
    
    return $link;
  }

  /**
   * Save the authorization code.
   * 
   * @param $code
   */
  public function save_authorization_code($authorization_code) {
    \Drupal::service('config.factory')->getEditable('globelabs.settings')
           ->set('authorization_code', $authorization_code)
           ->save();
  }

  /**
   * Get the authorization code.
   * 
   * @return string
   */
  public function get_authorization_code() {
    $authorization_code = \Drupal::config('globelabs.settings')
                                 ->get('authorization_code');
    
    return $authorization_code;
  }

  /**
   * Revoke access to Globe Labs API.
   */
  public function revoke_authorization_code() {
    \Drupal::service('config.factory')->getEditable('globelabs.settings')
           ->set('authorization_code', '')
           ->save();
  }

  /**
   * Get access token.
   *
   * @param $code
   *
   * @return mixed
   */
  public function get_access_token($code) {
    $app_id = \Drupal::config('globelabs.settings')->get('app_id');
    $app_secret = \Drupal::config('globelabs.settings')->get('app_secret');

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
