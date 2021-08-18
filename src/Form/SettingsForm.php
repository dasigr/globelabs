<?php

namespace Drupal\globelabs\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure globelabs settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'globelabs_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['globelabs.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['short_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Short Code'),
      '#default_value' => $this->config('globelabs.settings')->get('short_code'),
    ];
    $form['short_code_cross_telco'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Short Code (Cross-telco)'),
      '#default_value' => $this->config('globelabs.settings')->get('short_code_cross_telco'),
    ];
    $form['app_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('App ID'),
      '#default_value' => $this->config('globelabs.settings')->get('app_id'),
    ];
    $form['app_secret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('App Secret'),
      '#default_value' => $this->config('globelabs.settings')->get('app_secret'),
    ];
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (empty($form_state->getValue('short_code'))) {
      $form_state->setErrorByName('short_code', $this->t('The value is not correct.'));
    }
    
    if (empty($form_state->getValue('short_code_cross_telco'))) {
      $form_state->setErrorByName('short_code_cross_telco', $this->t('The value is not correct.'));
    }
    
    if (empty($form_state->getValue('app_id'))) {
      $form_state->setErrorByName('app_id', $this->t('The value is not correct.'));
    }
    
    if (empty($form_state->getValue('app_secret'))) {
      $form_state->setErrorByName('app_secret', $this->t('The value is not correct.'));
    }
    
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('globelabs.settings')
         ->set('short_code', $form_state->getValue('short_code'))
         ->save();
    
    $this->config('globelabs.settings')
         ->set('short_code_cross_telco', $form_state->getValue('short_code_cross_telco'))
         ->save();
    
    $this->config('globelabs.settings')
         ->set('app_id', $form_state->getValue('app_id'))
         ->save();
    
    $this->config('globelabs.settings')
         ->set('app_secret', $form_state->getValue('app_secret'))
         ->save();
    
    parent::submitForm($form, $form_state);
  }

}
