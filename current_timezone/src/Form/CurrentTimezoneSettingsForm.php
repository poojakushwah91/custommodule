<?php

namespace Drupal\current_timezone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class CurrentTimezoneSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'current_timezone_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'currenttimezone.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('currenttimezone.settings');

    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config->get('country'),
    ];

    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config->get('city'),
    ];

    $options = [
      '' => 'Select',
      'America/Chicago' => 'America/Chicago',
      'America/New_York' => 'America/New_York',
      'Asia/Tokyo' => 'Asia/Tokyo',
      'Asia/Dubai' => 'Asia/Dubai',
      'Asia/Kolkata' => 'Asia/Kolkata',
      'Europe/Amsterdam' => 'Europe/Amsterdam',
      'Europe/Oslo' => 'Europe/Oslo',
      'Europe/London' => 'Europe/London',
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => t('Timezone:'),
      '#options' => $options,
      '#default_value' => !empty($config->get('timezone')) ? $config->get('timezone') : '',
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form validate.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    if ($form_state->getValue('country') == '') {
      $form_state->setErrorByName('country', $this->t('Country is Required'));
    }
    if ($form_state->getValue('city') == '') {
      $form_state->setErrorByName('city', $this->t('City is Required'));
    }
    if ($form_state->getValue('timezone') == '') {
      $form_state->setErrorByName('timezone', $this->t('Timezone is Required'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->configFactory->getEditable('currenttimezone.settings')
      ->set('country', $form_state->getValue('country'))
      ->set('city', $form_state->getValue('city'))
      ->set('timezone', $form_state->getValue('timezone'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
