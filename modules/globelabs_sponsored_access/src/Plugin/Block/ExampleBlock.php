<?php

namespace Drupal\globelabs_sponsored_access\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "globelabs_sponsored_access_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("Globe Labs Sponsored Access")
 * )
 */
class ExampleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
