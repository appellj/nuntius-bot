<?php

namespace Nuntius;

class NuntiusPluginManager {

  protected $plugins;

  public function addPlugin($plugin, $namespace) {
    $this->plugins[$plugin] = new $namespace;
  }

  public function getPlugin($action) {
    return $this->plugins[$action];
  }
}
