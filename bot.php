<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory;

$token = \Nuntius\Nuntius::getSettings()['bot_id'];

$client_loop = React\EventLoop\Factory::create();
$client = new Slack\RealTimeClient($client_loop);
$client->setToken($token);

// disconnect after first message
$client->on('presence_change', function ($data) use ($client) {

  if ($data['presence'] == 'away') {
    return;
  }

  $client->getUserById($data['user'])->then(function (Slack\User $user) use ($client) {

    if ($user->getUsername() != 'roysegall') {
      return;
    }

    $client->getDMByUserId($user->getId())->then(function (\Slack\DirectMessageChannel $channel) use ($client) {
      $client->send('Welcome back creator!', $channel);
    });
  });

});

$client->on('message',  function($data) use ($client) {

});

$client->connect()->then(function () {
  echo "Connected!\n";
});

$client_loop->run();
