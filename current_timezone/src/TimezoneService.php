<?php

namespace Drupal\current_timezone;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class of TimezoneService.
 *
 * @package Drupal\current_timezone\Services
 */
class TimezoneService {

  /**
   * TimezoneService constructor.
   */
  public function __construct() {

  }

  /**
   * Implement get time zone details.
   *
   * @return \Drupal\Component\Render\MarkupInterface|string
   *   A array containing a value that used for time and location details.
   */
  public function getTimezoneDetails() {

    $config = \Drupal::config('currenttimezone.settings');

    $country = $config->get('country');
    $city = $config->get('city');
    $timezone = $config->get('timezone');

    $date_formatter = \Drupal::service('date.formatter');

    $date_time = new DrupalDateTime('Now', $timezone);
    $timestamp = $date_time->getTimestamp();
    $type = 'custom';

    $format = 'jS M Y -  g:i a';

    $langcode = NULL;

    $formatted = $date_formatter->format($timestamp, $type, $format, $timezone, $langcode);
    return ['timezone' => $formatted , 'country' => $country, 'city' => $city];
  }

}
