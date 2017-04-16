<?php

require_once 'vendor/autoload.php';

$plugin = \Nuntius\Nuntius::getTasksManager()->getMatchingTask('nice to meet you');

Kint::dump($plugin);
