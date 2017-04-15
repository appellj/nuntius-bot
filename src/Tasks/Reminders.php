<?php

namespace Nuntius\Tasks;

use Nuntius\TaskBaseAbstract;
use Nuntius\TaskBaseInterface;

class Reminders extends TaskBaseAbstract implements TaskBaseInterface {

  /**
   * {@inheritdoc}
   */
  public function info() {
    return [
      '' => [
        'description' => '',
        'handler' => '',
      ],
    ];
  }

}