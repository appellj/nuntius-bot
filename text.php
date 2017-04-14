<?php

require_once 'vendor/autoload.php';

$entityManager = \Nuntius\Nuntius::getEntityManager();

$reminder = $entityManager->get('reminders');

Kint::dump($reminder);