<?php

namespace Nuntius;
use r\Queries\Tables\Table;

/**
 * Abstract class for the tasks conversation plugins.
 */
abstract class TaskConversationAbstract extends TaskBaseAbstract implements TaskConversationInterface {

  /**
   * {@inheritdoc}
   */
  public function startTalking() {
    $methods = get_class_methods($this);

    // Setting up the context.
    $context = [
      'user' => $this->data['user'],
      'task' => $this->task_id,
    ];

    // Check if we have a running context for the user.
    if (!$this->checkForContext($this->db->getTable('running_context'))) {
      // Create a running context.
      $this->entityManager->get('running_context')->insert($context);
    }

    // Check if we have a context in the DB.
    if (!$db_context = $this->checkForContext($this->db->getTable('context'))) {
      // Get the questions methods.
      foreach ($methods as $method) {
        if (strpos($method, 'question') === 0) {
          $context['questions'][$method] = FALSE;
        }
      }

      // Insert it into the DB.
      $this->entityManager->get('context')->insert($context);
    }
    else {
      $context = reset($db_context)->getArrayCopy();

      // Converting the answers to normal array.
      $context['questions'] = $context['questions']->getArrayCopy();
    }

    // Fire the question.
    foreach ($context['questions'] as $question => $answer) {
      if ($answer === FALSE) {
        return $this->{$question}();
        break;
      }
    }
  }

  /**
   * Checking the we have a context in the given table.
   *
   * @param Table $table
   *   The table object.
   *
   * @return array
   *   The array copy of the results.
   */
  protected function checkForContext(Table $table) {
    $results = $table
      ->filter(\r\row('user')->eq($this->data['user']))
      ->filter(\r\row('task')->eq($this->task_id))
      ->run($this->db->getConnection());

    return $results->toArray();
  }

}
