<?php

require_once 'vendor/autoload.php';

$container = \Nuntius\Nuntius::container();

\Nuntius\Nuntius::getEntityManager()->get('logger')->insert(['a' => 'b']);
