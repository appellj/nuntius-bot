<?php

namespace Nuntius;

/**
 * Manage updates.
 */
class UpdateManager {

  /**
   * List of updates.
   *
   * @var UpdateBaseInterface[]
   */
  protected $updates;

  /**
   * Constructing the update manager.
   *
   * @param array $updates
   *   List of all the updates.
   */
  function __construct($updates) {
    $db = Nuntius::getRethinkDB();
    $entity_manager = Nuntius::getEntityManager();

    foreach ($updates as $update => $namespace) {
      $this->updates[$update] = new $namespace($db, $update, $entity_manager);
    }
  }

  /**
   * Return the update object.
   *
   * @param $update
   *   The update ID.
   *
   * @return UpdateBaseInterface
   *   Update.
   */
  public function get($update) {
    return $this->updates[$update];
  }

  /**
   * Get all the tasks.
   *
   * @return UpdateBaseInterface[]
   *   All the teaks.
   */
  public function getUpdates() {
    return $this->updates;
  }

}
