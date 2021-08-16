<?php

namespace Drupal\globelabs_sms\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "globelabs_sms_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("&#039;Globe Labs SMS&#039;")
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
