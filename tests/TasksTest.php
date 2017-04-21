<?php

namespace tests;
use Nuntius\Nuntius;
use Nuntius\Tasks\Reminders;
use Nuntius\TasksManager;

/**
 * Testing tasks.
 */
class TasksTest extends TestsAbstract {

  /**
   * List of events.
   *
   * @var \Nuntius\TasksManager
   */
  protected $tasks;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->tasks = Nuntius::getTasksManager();
  }

  /**
   * Testing matching tasks from text.
   *
   * @covers TasksManager::getMatchingTask()
   * @covers TasksManager::get()
   */
  public function testGetMatchingTask() {
    $this->assertEquals($this->tasks->getMatchingTask('help'), [
      $this->tasks->get('help'),
      'listOfScopes',
      []
    ]);

    $this->assertEquals($this->tasks->getMatchingTask('remind me to help you'), [
      $this->tasks->get('reminders'),
      'addReminder',
      [1 => 'to help you'],
    ]);

    $this->assertEquals($this->tasks->getMatchingTask('nice to meet you'), [
      $this->tasks->get('introduction'),
      '',
      [],
    ]);
  }

  /**
   * Testing return of all tasks.
   *
   * @covers TasksManager::getTasks()
   */
  public function testGetTasks() {
    $this->assertEquals($this->tasks->getTasks(), [
      'reminders' => $this->tasks->get('reminders'),
      'help' => $this->tasks->get('help'),
      'introduction' => $this->tasks->get('introduction'),
    ]);
  }

  /**
   * Testing reminder set up.
   */
  public function testReminders() {
    /** @var Reminders $reminders */
    $reminders = $this->tasks->get('reminders');
    $reminders
      ->setData(['user' => 'Major. Tom'])
      ->addReminder('foo bar is my best stuff!');

    $results = $this->rethinkdb
      ->getTable('reminders')
      ->filter(\r\row('user')->eq('Major. Tom'))
      ->filter(\r\row('reminder')->eq('foo bar is my best stuff!'))
      ->run($this->rethinkdb->getConnection());

    $this->assertEquals(count($results->toArray()), 21);
  }

}
