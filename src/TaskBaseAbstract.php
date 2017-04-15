<?php

namespace Nuntius;

/**
 * Abstract class for the tasks plugins.
 */
abstract class TaskBaseAbstract implements TaskBaseInterface {

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
   * The entity manager.
   *
   * @var \Nuntius\EntityManager
   */
  protected $entityManager;

  /**
   * Constructor.
   *
   * @param \Nuntius\NuntiusRethinkdb $db
   *   The RethinkDB connection.
   * @param string $task_id
   *   The task ID.
   * @param \Nuntius\EntityManager $entity_manager
   *   The entity manager.
   */
  function __construct(NuntiusRethinkdb $db, $task_id, EntityManager $entity_manager) {
    $this->db = $db;
    $this->task_id = $task_id;
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function actOnPresenceChange($presence) {
    // Do nothing by default.
  }

}
