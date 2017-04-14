<?php

namespace Nuntius\Plugin;

use Nuntius\NuntiusPluginAbstract;
use Slack\Channel;
use Slack\DirectMessageChannel;
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
  }

  /**
   * Determine if the message is DM.
   */
  protected function isDirectMessage() {
    return strpos($this->data['channel'], 'D') === 0;
  }

}
