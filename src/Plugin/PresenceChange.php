<?php

namespace Nuntius\Plugin;

use Nuntius\NuntiusPluginAbstract;
use Slack\DirectMessageChannel;
use Slack\User;

/**
 * Class PresenceChange.
 *
 * Triggered when the user's status has changed.
 */
class PresenceChange extends NuntiusPluginAbstract {

  /**
   * {@inheritdoc}
   */
  public function action() {

    if ($this->data['presence'] == 'away') {
      return;
    }

    $this->client->getUserById($this->data['user'])->then(function (User $user) {

      if ($user->getUsername() != 'roysegall') {
        return;
      }

      $this->client->getDMByUserId($user->getId())->then(function (DirectMessageChannel $channel) {
        $this->client->send('Welcome back creator!', $channel);
      });
    });
  }

}
