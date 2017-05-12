<?php

require_once 'vendor/autoload.php';

$settings = \Nuntius\Nuntius::getSettings();

$slack_http = new \SlackHttpService\SlackHttpService();
$slack = $slack_http->setAccessToken($settings->getSetting('access_token'));

$im_room = $slack->Im()->getImForUser($slack->Users()->getUserByName('roysegall'));

$attachment = new \SlackHttpService\Payloads\SlackHttpPayloadServiceAttachments();

$attachment
  ->setColor('#36a64f')
  ->setTitle('testing')
  ->setText('body')
  ->setToken('')
  ->setResponseUrl('')
  ->setActions([
    [
      "name" => "game",
      "text" => "Chess",
      "type" => "button",
      "value" => "chess",
    ],
    [
      "name" => "game",
      "text" => "Falken's Maze",
      "type" => "button",
      "value" => "maze",
    ],
    [
      "name" => "game",
      "text" => "Thermonuclear War",
      "style" => "danger",
      "type" => "button",
      "value" => "war",
      "confirm" => [
        "title" => "Are you sure?",
        "text" => "Wouldn't you prefer a good game of chess?",
        "ok_text" => "Yes",
        "dismiss_text" => "No",
      ]
    ]
  ]);

$attachments[] = $attachment;

// Build the payload of the message.
$message = new \SlackHttpService\Payloads\SlackHttpPayloadServicePostMessage();
$message
  ->setChannel($im_room)
  ->setAttachments($attachments)
  ->setText('foo')
  ->setToken('')
  ->setResponseUrl('');

// Posting the message.
$slack->Chat()->postMessage($message);

