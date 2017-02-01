# Nuntius slack bot
Gizra became a company when a lot of the employees are remote: USA, 
Canada, Spain and the list goes on. That status required from us to start using 
Slack. But the problem is that we wanted Slack to be cool. The obvious idea is 
to have a bot. The bot will interact with us and might improve the way we 
communicates.

## Origin
Like any awesome super hero, Nuntius have an origin story. It's not a tragic 
origin story when his uncle-CPU died due to lack of understanding that with 
great power comes great responsibility.

Nuntius in Latin means messages. That was the original project - a chat based on
any backend technology: Drupal, Wordpress, NodeJS, etc., etc. that could connect
to any front end technology(React, Elm, Angular, etc., etc.) and using any 
websocket service(Socket.IO, Pusher, FireBase). The project was too much for a 
single man but the name lived on.

## Set up.
You'll need PHP 5.6 and above, [Composer](http://getcomposer.org) and 
[RethinkDB](http://rethinkdb.com).

Go to [slack custom integration](https://gizrateam.slack.com/apps/A0F7YS25R-bots)
to get the bot access token(it will change any day so keep that in mind when 
updating Nuntius).

```bash
cp settings.example.yml settings.yml
composer install
rethinkdb
```

Open the settings file you created and set the token you copied, and run:
```bash
php install.php
php bot.php
```

That's it. Nuntius is up and running.

## Adding reactions
The main idea of Nuntius is reacting with people. Each reaction belongs to a 
category. A category bundled into a class which located in the `src/Plugins`
directory.

Have a look:
```php

namespace Nuntius\Plugins;

class Reminder extends NuntiusPluginAbstract {

  /**
   * @inheritdoc
   */
  protected $category = 'Reminders';

  public $formats = [
    '/Command with argument (.*) that will be passed as an argument/' => [
      'callback' => 'CommandWithArguments',
      'human_command' => 'Command with argument ARGUMENT that will be passed as an argument',
      'description' => 'This is description',
    ],
    'known text 1,known text 2' => [
      'callback' => 'KnownText',
      'human_command' => 'when USERNAME is logged in tell him STUFF',
      'description' => 'known text 1,known text 2',
    ],
  ];

  /**
   * Adding a reminder for some one.
   *
   * @param $to
   *   The user we need to remind.
   * @param $remind
   *   The reminder.
   *
   * @return string
   *   The text to return after the action was done.
   */
  public function RemindTo($to, $remind) {
    Nuntius::getRethinkDB()->addEntry('table', [
      'key' => 'value',
    ]);

    return "Don't worry! I got your back. I'll send him a reminder.";
  }

}
```

After creating the new class we need to register it. The registration happens in
`\Nuntius\Nuntius::__construct`:

```php
$this->addPlugins(New \Nuntius\Plugins\Reminder());
```

## Updating Nuntius
You wrote a new command, awesome! Go and get a fresh token 
(Remember `slack custom integration`?), stop the current process of Nuntius, 
pull the last changes, update the token in the settings and re-run Nuntius.

## Tests
We love tests. The tests based on PHPUnit. I don't think mocking an object is 
the correct way to do tests in our case since we need to see that something
affected the DB.

The tests, for now, are not setting up new tables so **don't run in on live**
(Dah!).

The tests need to see how Nuntius handles the text. We can have a look on the
reminder tests:
```php

namespace tests;

class RemindersTest extends TestsAbstract {

  /**
   * Reminders when the user log in.
   *
   * @covers Reminder::RemindMe()
   */
  public function testRemindWhenUserLogIn() {
    $results = $this
      ->nuntius
      ->setAuthor('Hal2000')
      ->getPlugin('@nuntius remind me next time I log in to do burpee');

    $this->assertEquals($results, 'OK! I will remind you next you\'ll log in.');

    $results = $this->rethinkdb
      ->getTable('reminders')
      ->filter(\r\row('to')->eq('Hal2000'))
      ->run($this->rethinkdb->getConnection());

    $this->assertTrue(!empty($results->toArray()), 'There are no reminders in the DB.');
  }
  
}
```
