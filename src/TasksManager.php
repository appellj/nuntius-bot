<?php

namespace Nuntius;

/**
 * Get te correct task which matches to the user input.
 */
class TasksManager {

  /**
   * List of tasks.
   *
   * @var TaskBaseInterface[]
   */
  protected $tasks;

  /**
   * Constructing the tasks manager.
   *
   * @param array $tasks
   *   List of all the tasks.
   */
  function __construct($tasks) {
    $db = Nuntius::getRethinkDB();
    $entity_manager = Nuntius::getEntityManager();

    foreach ($tasks as $task => $namespace) {
      $this->tasks[$task] = new $namespace($db, $task, $entity_manager);
    }
  }

  /**
   * Return the task object.
   *
   * @param $task
   *   The task ID.
   *
   * @return TaskBaseInterface
   *   Task.
   */
  public function get($task) {
    return $this->tasks[$task];
  }

}
