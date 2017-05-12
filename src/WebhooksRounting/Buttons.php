<?php

namespace Nuntius\WebhooksRounting;

use Nuntius\WebhooksRoutingControllerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Handling incoming webhooks from GitHub.
 */
class Buttons implements WebhooksRoutingControllerInterface {

  /**
   * {@inheritdoc}
   */
  public function response(Request $request) {
    return new Response();
  }

}
