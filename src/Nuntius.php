<?php

namespace Nuntius;

use Symfony\Component\Yaml\Yaml;

class Nuntius {

  /**
   * Getting the settings.
   *
   * @return array
   */
  public static function getSettings() {
    return Yaml::parse(file_get_contents('settings.yml'));
  }

  /**
   * Get the DB instance.
   *
   * @return NuntiusRethinkdb
   */
  public static function getRethinkDB() {
    return new NuntiusRethinkdb(self::getSettings()['rethinkdb']);
  }

  /**
   * Get the entity manager.
   *
   * @return EntityManager
   *   The entity manager.
   */
  public static function getEntityManager() {
    $entities = self::getSettings()['entities'];

    return new EntityManager($entities);
  }

  /**
   * Get the task manager.
   *
   * @return \Nuntius\TasksManager
   *   The task manager object.
   */
  public static function getTasksManager() {
    $tasks = self::getSettings()['tasks'];

    return new TasksManager($tasks);
  }

}
