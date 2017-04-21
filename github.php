<?php

require_once 'vendor/autoload.php';

use React\EventLoop\Factory;

// Bootstrapping.
$settings = \Nuntius\Nuntius::getSettings();
$token = $settings['access_token'];

if (empty($token)) {
  throw new Exception('The access token is missing');
}

// Set up stuff.
$client_loop = React\EventLoop\Factory::create();
$client = new Slack\RealTimeClient($client_loop);
$client->setToken($token);

$_POST['payload'] = empty($_POST['payload']) ? file_get_contents("php://input") : $_POST['payload'];

if (empty($_POST['payload'])) {
  return;
}

$payload = json_decode($_POST['payload']);

$event = $payload->action;

if ($event == 'opened') {

  $key = !empty($event->pull_request) ? 'pull_request' : 'issue';

  $payload = [
    'event' => 'open',
    'type' => $key,
    'user' => $payload->{$key}->user->login,
    'title' => $payload->{$key}->title,
    'body' => $payload->{$key}->body,
  ];
}


\Nuntius\Nuntius::getRethinkDB()->getTable('logger')->insert($payload)->run(\Nuntius\Nuntius::getRethinkDB()->getConnection());
