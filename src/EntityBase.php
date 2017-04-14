<?php

namespace Nuntius;

/**
 * Abstract class for entities.
 */
abstract class EntityBase implements EntityBaseInterface {

  /**
   * The RethinkDB connection.
   *
   * @var \Nuntius\NuntiusRethinkdb
   */
  protected $db;

  /**
   * The entity ID.
   *
   * @var string
   */
  protected $entityID;

  /**
   * EntityBase constructor.
   * @param \Nuntius\NuntiusRethinkdb $db
   *   The RethinkDB connection.
   * @param string $entity_id
   *   The entity ID.
   */
  function __construct(NuntiusRethinkdb $db, $entity_id) {
    $this->db = $db;
    $this->entityID = $entity_id;
  }

  /**
   * {@inheritdoc}
   */
  public function describe() {
    return [
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function loadAll() {
    return $this->db->getTable($this->entityID)->run($this->db->getConnection())->toArray();
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    return $this->db->getTable($this->entityID)->get($id)->run($this->db->getConnection())->getArrayCopy();
  }

  /**
   * {@inheritdoc}
   */
  public function insert(array $item) {
  }

}
