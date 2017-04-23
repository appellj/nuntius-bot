<?php

namespace Nuntius;

use Slack\RealTimeClient;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Yaml\Yaml;
use React\EventLoop\Factory;

class Nuntius {

  /**
   * Bootstrapping the slack bot.
   *
   * @return RealTimeClient
   *   The client obect.
   *
   * @throws \Exception
   */
  public static function bootstrap() {
    // Bootstrapping.
    $settings = self::getSettings();
    $token = $settings['access_token'];

    if (empty($token)) {
      throw new \Exception('The access token is missing');
    }

    // Set up stuff.
    $client_loop = Factory::create();
    $client = new RealTimeClient($client_loop);
    $client->setToken($token);

    return $client;
  }

  /**
   * Getting the settings.
   *
   * @return array
   */
  public static function getSettings() {
    $main_settings = Yaml::parse(file_get_contents('settings.yml'));

    $local_settings = [];
    if (file_exists('settings.local.yml')) {
      $local_settings = Yaml::parse(file_get_contents('settings.local.yml'));
    }

    $settings = [];
    foreach ($main_settings as $key => $value) {
      // Getting settings from the main default settings.
      $settings[$key] = $main_settings[$key];

      if (is_array($settings[$key])) {
        // The setting is defined as settings. Merge the local settings with the
        // main settings.
        if (isset($local_settings[$key])) {
          $settings[$key] = $local_settings[$key] + $main_settings[$key];
        }
      }
      else {
        // The setting is not an array(bot access token) - the local settings
        // call the shot for the value of the setting.
        $settings[$key] = isset($local_settings[$key]) ? $local_settings[$key] : '';
      }

    }

    return $settings;
  }

  /**
   * Get the container.
   *
   * @return ContainerBuilder
   *   The container object.
   */
  public static function container() {
    static $container;

    if ($container) {
      // We already got the container, return that.
      return $container;
    }

    $container = new ContainerBuilder();
    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../'));

    // Load all the services files.
    foreach (self::getSettings()['services'] as $service) {
      $loader->load($service);
    }

    return $container;
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
    return self::container()->get('manager.entity')->setEntities(self::getSettings()['entities']);
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

  /**
   * Get the update manager.
   *
   * @return \Nuntius\UpdateManager
   */
  public static function getUpdateManager() {
    $updates = self::getSettings()['updates'];

    return new UpdateManager($updates);
  }

  /**
   * Return nuntius dispatcher object..
   *
   * @return \Nuntius\NuntiusDispatcher
   *   Nuntius dispatcher manager.
   */
  public static function getDispatcher() {
    $dispatcher = new NuntiusDispatcher(self::getSettings()['dispatchers']);

    return $dispatcher->buildDispatcher();
  }

}
