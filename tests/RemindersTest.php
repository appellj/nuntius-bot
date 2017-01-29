<?php

namespace tests;

class RemindersTest extends TestsAbstract {

  /**
   * Reminders when the user log in.
   */
  public function testRemindWhenUserLogIn() {
    $results = $this
      ->nuntius
      ->setAuthor('john')
      ->getPlugin('remind me next time I log in to do burpee');

    $this->assertEquals($results, 'OK! I will remind you next you\'ll log in.');

    $results = $this->rethinkdb
      ->getTable('reminders')
      ->filter(\r\row('to')->eq('john'))
      ->run($this->rethinkdb->getConnection());

    $this->assertTrue(!empty($results), 'There are no reminders in the DB.');
  }

  /**
   * Test reminders.
   */
  public function testDeleteAlReminders() {
    $results = $this->nuntius->getPlugin('@nuntius delete all the reminders I asked from you');
    $this->assertEquals($results, 'What reminder? :wink:');

    $results = $this->nuntius->getPlugin('@nuntius asdasdasd');
    $this->assertEquals($results, NULL);

    // todo: check something happens in the DB.
  }

}
