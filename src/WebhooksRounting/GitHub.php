<?php

namespace Nuntius\WebhooksRounting;

use Nuntius\WebhooksRoutingControllerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GitHub implements WebhooksRoutingControllerInterface {

  /**
   * {@inheritdoc}
   */
  public function response(Request $request) {
    return new Response(
      sprintf("Hello %s", $request->get('handler'))
    );
  }

}
