<?php

namespace Drupal\globelabs_voice\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Globe Labs Voice routes.
 */
class GlobelabsVoiceController extends ControllerBase {

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
