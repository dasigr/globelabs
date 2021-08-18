<?php
/**
 * Created by PhpStorm.
 * User: das
 * Date: 8/18/21
 * Time: 9:14 AM
 */

namespace Drupal\globelabs_sms\Entity;


/**
 * Class outboundSMSMessageRequest
 * 
 * @package Drupal\globelabs_sms\Entity
 */
class OutboundSMSMessageRequest {
  
  protected $address;
  
  protected $deliveryInfoList = array(
    "deliveryInfo" => [],
    "resourceURL" => ""
  );
  
  protected $senderAddress;
  
  protected $outboundSMSTextMessage = array(
    "message" => ""
  );
  
  protected $clientCorrelator;

  protected $receiptRequest = array(
    "notifyURL" => "",
    "callbackData" => null,
    "senderName" => null
  );
  
  protected $resourceURL;
  
  protected $numberOfMessagesInThisBatch;
}
