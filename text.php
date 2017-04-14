<?php

require_once 'vendor/autoload.php';

$entityManager = \Nuntius\Nuntius::getEntityManager();

$reminder = $entityManager->get('reminders');

Kint::dump($reminder->load("0a5ba217-51c5-4687-b76b-ae27833f70b1"));
