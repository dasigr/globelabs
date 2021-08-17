<?php
/**
 * Created by PhpStorm.
 * User: das
 * Date: 8/18/21
 * Time: 3:58 AM
 */

namespace Drupal\globelabs_sms\Service;


class SmsService {

  /**
   * Send an SMS message to a subscriber.
   *
   * @param $shortcode
   * @param $address
   * @param $access_token
   * @param $message
   * @param $clientCorrelator
   *
   * @return mixed
   */
  public function send_sms($access_token, $address, $shortcode, $message, $clientCorrelator) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://devapi.globelabs.com.ph/smsmessaging/v1/outbound/".$shortcode."/requests?access_token=".$access_token ,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\"outboundSMSMessageRequest\": { \"clientCorrelator\": \"".$clientCorrelator."\", \"senderAddress\": \"".$shortcode."\", \"outboundSMSTextMessage\": {\"message\": \"".$message."\"}, \"address\": \"".$address."\" } }",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json"
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
