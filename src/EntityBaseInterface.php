<?php

namespace Nuntius;

/**
 * Interface EntityBaseInterface.
 */
interface EntityBaseInterface {

  /**
   * Describing the entities properties and parameters.
   *
   * @return array
   */
  public function describe();

  /**
   * Loading all the entities.
   *
   * @return array
   *   List of entities.
   */
  public function loadAll();

  /**
   * Load a single entities.
   *
   * @param $id
   *   Entity ID.
   *
   * @return array
   *   The entity.
   */
  public function load($id);

  /**
   * Inert an entry to the DB.
   *
   * @param array $item
   *   The item to insert into the DB.
   */
  public function insert(array $item);


}
