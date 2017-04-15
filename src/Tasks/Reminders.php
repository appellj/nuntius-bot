<?php

namespace Nuntius\Tasks;

use Nuntius\TaskBaseAbstract;
use Nuntius\TaskBaseInterface;

/**
 * Remind to the user something to do.
 */
class Reminders extends TaskBaseAbstract implements TaskBaseInterface {

  /**
   * {@inheritdoc}
   */
  public function info() {
    return [
      '/remind me (.*)/' => [
        'human_command' => 'remind me REMINDER',
        'description' => 'Next time you log in I will remind you what you '
        . ' wrote in the REMINDER',
        'callback' => 'addReminder',
      ],
    ];
  }

  /**
   * Adding a reminder to the DB.
   *
   * @param string $reminder
   *   The reminder of the user.
   */
  public function addReminder($reminder) {

  }

}