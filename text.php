<?php

require_once 'vendor/autoload.php';

$plugin = \Nuntius\Nuntius::getPluginManager();

$plugin->addPlugin('presence_changed', '\Nuntius\Plugin\PresenceChanged');
Kint::dump($plugin->getPlugin('presence_changed'));