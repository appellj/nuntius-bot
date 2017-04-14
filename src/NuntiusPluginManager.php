<?php

namespace Nuntius;

class NuntiusPluginManager {

  /**
   * List of all the plugins.
   *
   * @var NuntiusPluginAbstract[]
   */
  protected $plugins;

  /**
   * Adding a plugin.
   *
   * @param $plugin
   *   The plugin ID.
   * @param $namespace
   *   The namespace of the plugin. Will be use to init the plugin.
   *
   * @return $this
   */
  public function addPlugin($plugin, $namespace) {
    $this->plugins[$plugin] = $namespace;

    return $this;
  }

  /**
   * Get all the plugins.
   *
   * @return NuntiusPluginAbstract[]
   *   The plugin instance.
   */
  public function getPlugins() {
    return $this->plugins;
  }

}
