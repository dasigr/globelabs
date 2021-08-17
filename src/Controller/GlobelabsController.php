<?php

namespace Drupal\globelabs\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\globelabs\Service\AuthService;

/**
 * Returns responses for globelabs routes.
 */
class GlobelabsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $authService = new AuthService();

    $connect_link = $authService->get_connect_link();

    $build['content'] = [
      '#type' => 'item',
      '#markup' => '<a href="' . $connect_link . '" target="_self">' . $this->t('Connect to Globe Labs API') . '</a>',
    ];

    return $build;
  }

  /**
   * Callback page.
   * 
   * @return mixed
   */
  public function callback() {
    $authService = new AuthService();
    
    // Get authorization code.
    $code = \Drupal::request()->get('code');
    $authService->save_code($code);

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('App is now authorized to perform actions on behalf of the subscriber!'),
    ];

    return $build;
  }

}
