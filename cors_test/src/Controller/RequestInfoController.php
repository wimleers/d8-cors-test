<?php

namespace Drupal\cors_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class RequestInfoController.
 *
 * @package Drupal\cors_test\Controller
 */
class RequestInfoController extends ControllerBase {

  /**
   * Drupal\Core\Routing\CurrentRouteMatch definition.
   *
   * @var \Drupal\Core\Routing\CurrentRouteMatch
   */
  protected $currentRouteMatch;

  /**
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * {@inheritdoc}
   */
  public function __construct(RequestStack $current_route_match) {
    $this->requestStack = $current_route_match;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('request_stack')
    );
  }

  /**
   * Requestinfo.
   *
   * @return string
   *   Return Hello string.
   */
  public function requestInfo() {
    drupal_set_message(print_r(\Drupal::request()->headers->all(), 1));
    return [
      '#type' => 'markup',
      '#mark' => '<pre>'. debug(\Drupal::request()->headers->all()) .'</pre>',
    ];
  }

}
