<?php

namespace Nuntius;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface WebhooksRoutingControllerInterface {

  /**
   * @param Request $request
   *
   * @return Response
   */
  public function response(Request $request);

}
