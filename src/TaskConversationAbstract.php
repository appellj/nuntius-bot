<?php

namespace Nuntius;

/**
 * Abstract class for the tasks conversation plugins.
 */
abstract class TaskConversationAbstract extends TaskBaseAbstract implements TaskConversationInterface {

  /**
   * {@inheritdoc}
   */
  public function startTalking() {
    var_dump('a');

  }

}
