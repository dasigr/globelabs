<?php

namespace Drupal\globelabs_sms\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\globelabs\Service\AuthService;
use Drupal\globelabs_sms\Service\SmsService;

/**
 * Returns responses for Globe Labs SMS routes.
 */
class GlobelabsSmsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $url = Url::fromRoute('globelabs_sms.send');
    $link = Link::fromTextAndUrl('Send SMS', $url)->toString();

    $build['content'] = [
      '#type'   => 'item',
      '#markup' => $link,
    ];

    return $build;
  }

  /**
   * Send an SMS message.
   */
  public function send() {
    $authService = new AuthService();
    $smsService = new SmsService();

    $code = $authService->get_authorization_code();

    // Get access token.
    $token = $authService->get_access_token($code);
    $access_token = $token->access_token;
    $address = $token->subscriber_number;

    // Send SMS.
    $shortcode = \Drupal::config('globelabs.settings')->get('short_code');
    $clientCorrelator = "";
    $message = "PHP SMS Test";
    $smsService->send_sms($access_token, $address, $shortcode, $message, $clientCorrelator);

    \Drupal::messenger()->addStatus(t('SMS message sent!'));

    return $this->redirect('globelabs_sms.index');
  }

}
