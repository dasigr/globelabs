<?php

namespace Drupal\globelabs_rewards\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "globelabs_rewards_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("Globe Labs Rewards")
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
