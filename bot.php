<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory;

// Bootstrapping.
$token = \Nuntius\Nuntius::getSettings()['bot_id'];

// Adding plugins.
$plugin_manager = \Nuntius\Nuntius::getPluginManager();
$plugin_manager->addPlugin('presence_change', 'Nuntius\Plugin\PresenceChanged');

// Set up stuff.
$client_loop = React\EventLoop\Factory::create();
$client = new Slack\RealTimeClient($client_loop);
$client->setToken($token);

foreach ($plugin_manager->getPlugins() as $event => $namespace) {
  $plugin = new $namespace($client);

  $client->on($event, function ($data) use ($plugin) {
    $plugin->data = $data;
  });
}


$client->connect()->then(function () {
  echo "Connected!\n";
});

$client_loop->run();
