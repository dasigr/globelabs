<?php

namespace Drupal\globelabs_invite\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Globe Labs Invite routes.
 */
class GlobelabsInviteController extends ControllerBase {

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
