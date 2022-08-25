<?php

namespace Drupal\current_timezone\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block with current timezone set.
 *
 * @Block(
 *   id = "current_timezone_block",
 *   admin_label = @Translation("Show site Current location and time"),
 *   category = @Translation("Custom Module"),
 * )
 */
class CurrentTimezoneBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $data = \Drupal::service('current_timezone.timezone')->getTimezoneDetails();

    return [
      '#theme' => 'current_timezone',
      '#country' => $data['country'],
      '#city' => $data['city'],
      '#timezone' => $data['timezone'],
    ];
  }

  /**
   * Enable cache.
   *
   * @return int
   *   cache value return.
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
