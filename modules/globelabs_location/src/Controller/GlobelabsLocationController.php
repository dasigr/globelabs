<?php

namespace Drupal\globelabs_location\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Globe Labs Location routes.
 */
class GlobelabsLocationController extends ControllerBase {

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
