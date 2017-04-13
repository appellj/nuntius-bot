<?php

require_once 'vendor/autoload.php';

$loop = React\EventLoop\Factory::create();

$client = new Slack\RealTimeClient($loop);
$client->setToken(\Nuntius\Nuntius::getSettings()['bot_id']);

// disconnect after first message
$client->on('message', function ($data) use ($client) {
  var_dump($data);
  $client->getDMByUserId($data['user'])->then(function (\Slack\DirectMessageChannel $channel) use ($client) {
    $client->send('Hello from PHP!', $channel);
  });
});

$client->on('user_typing', function ($data) use ($client) {
//  var_dump($data);
});

$client->on('user_typing', function ($data) use ($client) {
//  var_dump($data);
});

$client->connect()->then(function () {
  echo "Connected!\n";
});

$loop->run();
