<?php

namespace Drupal\globelabs_ussd\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Globe Labs USSD routes.
 */
class GlobelabsUssdController extends ControllerBase {

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
