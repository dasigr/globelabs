<?php

namespace Drupal\globelabs_charging\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Globe Labs Charging routes.
 */
class GlobelabsChargingController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
