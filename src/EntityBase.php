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
   * Get the table handler.
   *
   * @return \r\Queries\Tables\Table
   */
  public function getTable() {
    return $this->db->getTable($this->entityID);
  }

  /**
   * {@inheritdoc}
   */
  public function loadAll() {
    return $this->getTable()->run($this->db->getConnection())->toArray();
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    return $this->getTable()->get($id)->run($this->db->getConnection())->getArrayCopy();
  }

  /**
   * {@inheritdoc}
   */
  public function insert(array $item) {
    $result = $this->getTable()->insert($item)->run($this->db->getConnection())->getArrayCopy();

    return $this->load(reset($result['generated_keys']));
  }

  /**
   * {@inheritdoc}
   */
  public function delete($id) {
    $this->getTable()->get($id)->delete()->run($this->db->getConnection());
  }

  /**
   * {@inheritdoc}
   */
  public function update($id, $data) {
    $this->getTable()->get($id)->update($data)->run($this->db->getConnection());
  }

}
