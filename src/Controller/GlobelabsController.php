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
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
