<?php

namespace Drupal\globelabs_voice\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "globelabs_voice_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("Globe Labs Voice")
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
