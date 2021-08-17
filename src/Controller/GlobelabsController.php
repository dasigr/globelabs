<?php

namespace Drupal\globelabs\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for globelabs routes.
 */
class GlobelabsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => '<a href="https://developer.globelabs.com.ph/dialog/oauth/B4AMuqnMMeCb5cp5pnTMnGC8k4XqupXA" target="_self">' . $this->t('Connect to Globe Labs API') . '</a>',
    ];

    return $build;
  }

  /**
   * Callback page.
   * 
   * @return mixed
   */
  public function callback() {

    $app_id = "";
    $app_secret = "";
    
    // Get authorization code.
    $code = \Drupal::request()->get('code');
    
    // Get access token.
     $token = $this->get_access_token($app_id, $app_secret, $code);
     $access_token = $token->access_token;
     $address = $token->subscriber_number;

    // Get location.
    $location = $this->get_location($access_token, $address);
    
    $build['content'] = [
      '#type' => 'item',
      '#markup' => isset($location->error) ? $this->t('Error: ' . $location->error) : $this->t('Location: ' . $location->terminalLocationList->terminalLocation->currentLocation->map_url),
    ];

    return $build;
  }

  /**
   * Get access token.
   * 
   * @param $app_id
   * @param $app_secret
   * @param $code
   *
   * @return mixed
   */
  private function get_access_token($app_id, $app_secret, $code) {
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

  /**
   * Get location.
   * 
   * @param $access_token
   * @param $address
   * @param int $requestedAccuracy
   *
   * @return mixed
   */
  private function get_location($access_token, $address, $requestedAccuracy=100) {
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
