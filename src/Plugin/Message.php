<?php

namespace Nuntius\Plugin;

use Nuntius\NuntiusPluginAbstract;
use Slack\Payload;
use Slack\User;

/**
 * Class Message.
 *
 * Triggered when a message eas sent.
 */
class Message extends NuntiusPluginAbstract {

  /**
   * {@inheritdoc}
   */
  public function action() {
    /** @var Payload $data */
    $data = $this->data->jsonSerialize();

    var_dump($data);
  }

  /**
   * Determine if the message is DM.
   */
  protected function isDirectMessage() {
    return strpos($this->data['channel'], 'D') === 0;
  }

  /**
   * Checking if the given user ID is a bot ID.
   *
   * @param string $user_id
   *   The user ID.
   *
   * @return bool
   *   True or False.
   */
  protected function isBot($user_id) {
    $result = '';

    $this->client->getUserById($user_id)->then(function(User $user) use (&$result) {
      $result = $user->data['is_bot'];
    });

    return $result;
  }

}
