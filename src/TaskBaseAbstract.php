<?php

namespace Nuntius;

/**
 * Abstract class for the tasks plugins.
 */
abstract class TaskBaseAbstract {

  /**
   * The RethinkDB connection.
   *
   * @var \Nuntius\NuntiusRethinkdb
   */
  protected $db;

  /**
   * The task ID.
   *
   * @var string
   */
  protected $task_id;

  /**
   * Constructor.
   *
   * @param \Nuntius\NuntiusRethinkdb $db
   *   The RethinkDB connection.
   * @param string $task_id
   *   The task ID.
   */
  function __construct(NuntiusRethinkdb $db, $task_id) {
    $this->db = $db;
    $this->task_id = $task_id;
  }

}
