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
        'description' => 'Delete an information',
        'constraint' => '\Nuntius\TasksConstraint\RestartQuestionConstraint',
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
  public function questionGetTaskId() {
    // Get all the un-temp context question.
    $task = '';
    return 'So... You want to delete information of a question. For which question?';
  }

  /**
   * Check if we need to restart the questions.
   */
  public function questionStartingAgain() {
    return 'Do you want to start the process again or should I restart the question?';
  }

  /**
   * {@inheritdoc}
   */
  public function collectAllAnswers() {
    // Delete the context of that question.

    //
    return 'I deleted for you the information. Let\'s start again';
  }

}
