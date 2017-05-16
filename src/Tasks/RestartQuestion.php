<?php

namespace Nuntius\Tasks;

use Nuntius\TaskConversationAbstract;
use Nuntius\TaskConversationInterface;

/**
 * Delete un-temporary context of question thus give the option to restart
 * again.
 */
class RestartQuestion extends TaskConversationAbstract implements TaskConversationInterface {

  /**
   * {@inheritdoc}
   */
  public function scope() {
    return [
      '/delete information/' => [
        'human_command' => 'delete information',
        'description' => 'Delete an information ',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function conversationScope() {
    return 'temp';
  }

  /**
   * Get the user first name.
   */
  public function questionFirstName() {
    return 'So... You want to delete information of a question. For which question?';
  }


  /**
   * {@inheritdoc}
   */
  public function collectAllAnswers() {
    return 'I deleted for you the information. Let\'s start again';
  }

}
