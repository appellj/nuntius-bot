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
    $payload = json_decode($request->request->get('payload'));
    if ($payload->callback_id == 'foo') {
      $actions = reset($payload->actions);



    }
    return new Response('');
  }

}
