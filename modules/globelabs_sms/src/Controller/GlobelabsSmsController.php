<?php

namespace Drupal\globelabs_sms\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for &#039;Globe Labs SMS&#039; routes.
 */
class GlobelabsSmsController extends ControllerBase {

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
