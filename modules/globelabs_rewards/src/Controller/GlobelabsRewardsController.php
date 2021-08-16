<?php

namespace Drupal\globelabs_rewards\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Globe Labs Rewards routes.
 */
class GlobelabsRewardsController extends ControllerBase {

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
