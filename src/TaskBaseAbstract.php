<?php

namespace Nuntius;
use Slack\RealTimeClient;

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
   * The client object.
   *
   * @var \Slack\RealTimeClient
   */
  protected $client;

  /**
   * The string of the last action.
   *
   * @var string
   */
  protected $data;

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
   * Set the client object.
   *
   * @param \Slack\RealTimeClient $client
   *   The client object.
   *
   * @return $this
   *   The current instance.
   */
  public function setClient(RealTimeClient $client) {
    $this->client = $client;

    return $this;
  }

  /**
   * Set the data form the RTM event.
   *
   * @param array $data
   *   The data of the RTM event.
   *
   * @return $this
   *   The current instance.
   */
  public function setData(array $data) {
    $this->data = $data;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function actOnPresenceChange() {
    // Do nothing by default.
  }

}
