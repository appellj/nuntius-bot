<?php

require_once 'vendor/autoload.php';

$tasks = \Nuntius\Nuntius::getTasksManager();

Kint::dump($tasks->get('reminders'));