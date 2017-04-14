<?php

namespace Nuntius\Plugin;

use Nuntius\NuntiusPluginAbstract;
use Slack\DirectMessageChannel;
use Slack\User;

class PresenceChange extends NuntiusPluginAbstract {

  /**
   * {@inheritdoc}
   */
  protected function action() {

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
