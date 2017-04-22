<?php

namespace tests;

/**
 * Testing entity.
 */
class GithubWebhooksTest extends GithubWebhooksTestsAbstract {

  /**
   * Testing failed requests.
   */
  public function testFailRequest() {
    $foo = $this->client->post('github.php', [
      'json' => []
    ]);

    var_dump($foo->getBody()->getContents());

    $failed_success = $this->rethinkdb->getTable('logger')
      ->filter(\r\row('type')->eq('error'))
      ->filter(\r\row('error')->eq('There is no matching webhook controller for  webhook.'))
      ->run($this->rethinkdb->getConnection())
      ->toArray();

    // Making sure a request without payload failed.
    $this->assertNotEmpty($failed_success);
  }

}
