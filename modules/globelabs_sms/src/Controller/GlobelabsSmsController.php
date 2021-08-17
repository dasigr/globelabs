<?php

namespace Drupal\globelabs_sms\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\globelabs\Service\AuthService;
use Drupal\globelabs_sms\Service\SmsService;

/**
 * Returns responses for &#039;Globe Labs SMS&#039; routes.
 */
class GlobelabsSmsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $authService = new AuthService();
    $smsService = new SmsService();

    $code = $authService->get_code();

    // Get access token.
    $token = $authService->get_access_token($code);
    $access_token = $token->access_token;
    $address = $token->subscriber_number;

    // Send SMS.
    $shortcode = "";
    $clientCorrelator = "";
    $message = "";
    $smsService->send_sms($access_token, $address, $shortcode, $message, $clientCorrelator);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('SMS sent!'),
    ];

    return $build;
  }

}
