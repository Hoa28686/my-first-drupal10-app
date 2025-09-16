<?php

declare(strict_types=1);

namespace Drupal\my_generated_controller\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for My generated controller routes.
 */
final class MyGeneratedControllerController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
