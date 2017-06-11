<?php

namespace Nuntius\Tasks;

use Nuntius\Nuntius;
use Nuntius\TaskBaseAbstract;
use Nuntius\TaskBaseInterface;
use pimax\FbBotApp;
use pimax\Menu\LocalizedMenu;
use pimax\Menu\MenuItem;

/**
 * Remind to the user something to do.
 */
class Help extends TaskBaseAbstract implements TaskBaseInterface {

  /**
   * {@inheritdoc}
   */
  public function scope() {
    return [
      '/help/' => [
        'human_command' => 'help',
        'description' => 'Giving you help',
        'callback' => [
          'slack' => 'slackListOfScopes',
          'facebook' => 'facebookListOfScopes',
        ],
      ],
    ];
  }

  /**
   * Get all the tasks and their scope(except for this one).
   */
  public function slackListOfScopes() {
    $task_manager = Nuntius::getTasksManager();

    $text = [];

    foreach ($task_manager->getTasks() as $task_id => $task) {
      if ($task_id == 'help') {
        continue;
      }

      foreach ($task->scope() as $scope) {
        $text[] = '`' . $scope['human_command'] . '`: ' . $scope['description'];
      }
    }

    return implode("\n", $text);
  }

  /**
   * A Facebook only text.
   */
  public function facebookListOfScopes() {
    $task_manager = Nuntius::getTasksManager();

    $buttons = [];

    foreach ($task_manager->getTasks() as $task_id => $task) {
      if ($task_id == 'help') {
        continue;
      }

      foreach ($task->scope() as $scope) {
        $buttons[] = [
          'type' => 'postback',
          'title' => $scope['human_command'],
          'payload' => $scope['human_command'],
        ];
      }
    }

    return [
      'attachment' => [
        'type' => 'template',
        'payload' => [
          'template_type' => 'button',
          'text' => 'What do you want to do next?',
          'buttons' => array_slice($buttons, 0, 3),
        ],
      ],
    ];
  }

}
