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
   * Get the plugin manager.
   *
   * @return NuntiusPluginManager
   */
  public static function getPluginManager() {
    return new NuntiusPluginManager(self::getSettings()['path']);
  }

}
