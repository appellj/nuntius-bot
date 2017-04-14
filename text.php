<?php

require_once 'vendor/autoload.php';

$entityManager = \Nuntius\Nuntius::getEntityManager();

$reminder = $entityManager->get('reminders');

$id = '5aa82684-7aba-4ecb-9b8e-6ed50760159e';
$item = $reminder->load($id);
Kint::dump($item);
