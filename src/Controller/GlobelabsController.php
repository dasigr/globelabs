<?php

namespace Drupal\globelabs\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\globelabs\Service\AuthService;

/**
 * Returns responses for globelabs routes.
 */
class GlobelabsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {
    $authService = new AuthService();

    if (empty($authService->get_authorization_code())) {
      $link = '<a href="' . $authService->get_connect_link() . '" target="_self">' . $this->t('Connect') . '</a>';
    } else {
      $link = '<a href="https://finance-api.ddev.site/globelabs/revoke" target="_self">' . $this->t('Revoke') . '</a>';
    }

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $link,
    ];

    return $build;
  }

  /**
   * Globe Labs callback url.
   * 
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function callback() {
    $authService = new AuthService();
    
    // Get authorization code.
    $authorization_code = \Drupal::request()->get('code');
    $authService->save_authorization_code($authorization_code);

    \Drupal::messenger()->addStatus(t('Thanks for authorizing us to send you SMS messages and get your location.'));
    
    return $this->redirect('globelabs.index');
  }

  /**
   * Revoke authorization code.
   * 
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function revoke() {
    $authService = new AuthService();
    
    // Revoke authorization code.
    $authService->revoke_authorization_code();

    $short_code = \Drupal::config('globelabs.settings')
                                 ->get('short_code');
    \Drupal::messenger()->addStatus(t('Text STOP to ' . $short_code));

    return $this->redirect('globelabs.index');
  }

}
