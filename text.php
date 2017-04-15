<?php

require_once 'vendor/autoload.php';

$tasks = \Nuntius\Nuntius::getTasksManager();

$reminders = $tasks->get('reminders');
$reminders->actOnPresenceChange();