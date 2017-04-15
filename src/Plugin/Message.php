<?php

namespace Nuntius\Plugin;

use Nuntius\NuntiusPluginAbstract;
use Slack\Channel;
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

    if (!$this->botWasMentioned($data['text'])) {
      return;
    }

    $this->client->getChannelById($data['channel'])->then(function (Channel $channel) {
      $this->client->send("I'm to your command!", $channel);
    });
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
      // @todo add another method to check if nuntius was mentioned and not any
      // bot.
      $result = $user->data['is_bot'];
    });

    return $result;
  }

  /**
   * Checking if the bot was mentioned in the conversation.
   *
   * @param $text
   *   The text to check.
   *
   * @return bool
   *   T
   */
  protected function botWasMentioned($text) {
    $words = explode(' ', $text);

    foreach ($words as $word) {
      if (!$matches = $this->matchTemplate($word, '/<@(.*)>/')) {
        continue;
      }

      if ($this->isBot(reset($matches))) {
        // We got it! the bot was mentioned.
        return TRUE;
      }
    }

    // No bot was mentioned.
    return FALSE;
  }

}
