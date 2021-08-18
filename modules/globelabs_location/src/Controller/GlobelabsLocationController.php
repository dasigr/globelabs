<?php

namespace Drupal\globelabs_location\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\globelabs\Service\AuthService;
use Drupal\globelabs_location\Service\LocationService;

/**
 * Returns responses for Globe Labs Location routes.
 */
class GlobelabsLocationController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $authService = new AuthService();
    $locationService = new LocationService();

    $code = $authService->get_authorization_code();

    // Get access token.
    $token = $authService->get_access_token($code);
    $access_token = $token->access_token;
    $address = $token->subscriber_number;

    // Get location.
    $location = $locationService->get_location($access_token, $address);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => isset($location->error) ? $this->t('Error: ' . $location->error) : $this->t('Location: ' . $location->terminalLocationList->terminalLocation->currentLocation->map_url),
    ];

    return $build;
  }

}
